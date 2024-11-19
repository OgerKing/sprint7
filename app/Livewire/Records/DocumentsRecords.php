<?php

namespace App\Livewire\Records;

use App\Models\AdjudicationDocument;
use App\Models\DefendantDocument;
use App\Models\GlobalDocument;
use App\Models\HydrographicDocument;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use ZipArchive;

class DocumentsRecords extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $selectedRows = [];

    public $selectAll = false;

    public function render()
    {
        return view('livewire.records.documents-records', [
            'documents' => $this->getDocuments(),
        ]);
    }

    /**
     * Toggle selection of all visible rows.
     *
     * @return void
     */
    public function toggleSelectAllManual()
    {
        $this->selectedRows = $this->selectAll ? [] : $this->getVisibleDocumentIds();
        $this->selectAll = ! $this->selectAll;
    }

    /**
     * Get IDs of all visible Documents.Because the documents query is a union from a bunch of different tables, the return doesnt have unique iterated ids. In order to make sure we are grabbing the correct document,we need to format a custom identifying string using the document_id and the document_category. Instead of selectedRows being an array of ids, it is an array of strings with id and category.
     *
     * @return array
     */
    protected function getVisibleDocumentIds()
    {
        // Fetch the documents from the combined query
        $documents = $this->queryDocuments()->get();

        // Pluck the formatted `document_id` and `category` string
        $formattedIds = $documents->map(function ($document) {
            // Format the category by converting to lowercase and removing spaces
            $formattedCategory = strtolower(str_replace(' ', '', $document->category));

            // Return the concatenated string
            return $document->document_id.$formattedCategory;
        });

        return $formattedIds->toArray(); // Convert the collection to an array
    }

    /**
     * Fetch paginated Documents.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    protected function getDocuments()
    {
        return $this->queryDocuments()->paginate(10);
    }

    /**
     * Fetch all documents from various tables, transforming the columns to a unified structure.
     *
     * This method combines documents from the global_documents, hydrographic_documents,
     * defendant_documents, and adjudication_documents tables. The selected columns are
     * mapped to a common set of names: document_name, category, type, status, document_date,
     * and updated.
     *
     * @return \Illuminate\Support\Collection
     */
    protected function queryDocuments()
    {
        // Query for Global Documents with mapped column names
        $globalDocuments = GlobalDocument::select([
            'global_document_title as document_name',
            'id as document_id', // Original document ID from the Global Documents table
            DB::raw("'Global Documents' as category"),
            'global_document_type_id as type',
            DB::raw("IF(is_deleted IS NULL, 'Active', 'Inactive') as status"),
            'document_filing_date as document_date',
            'updated_at as updated',
            'attachment_URL',
            'attachment_file_path',
        ])->whereNotNull('attachment_URL')
            ->whereNotNull('attachment_file_path');

        // Query for Hydrographic Documents with mapped column names
        $hydrographicDocuments = HydrographicDocument::select([
            'hydrographic_document_title as document_name',
            'id as document_id', // Original document ID from the Hydrographic Documents table
            DB::raw("'Hydrographic Documents' as category"),
            'document_type_id as type',
            DB::raw("IF(is_deleted IS NULL, 'Active', 'Inactive') as status"),
            'hydrographic_document_filing_date as document_date',
            'updated_at as updated',
            'attachment_URL',
            'attachment_file_path',
        ])->whereNotNull('attachment_URL')
            ->whereNotNull('attachment_file_path');

        // Query for Defendant Documents with mapped column names
        $defendantDocuments = DefendantDocument::select([
            'document_title as document_name',
            'id as document_id', // Original document ID from the Defendant Documents table
            DB::raw("'Defendant' as category"),
            'document_type_id as type',
            DB::raw("IF(is_deleted IS NULL, 'Active', 'Inactive') as status"),
            'document_filing_date as document_date',
            'updated_at as updated',
            'attachment_URL',
            'attachment_file_path',
        ])->whereNotNull('attachment_URL')
            ->whereNotNull('attachment_file_path');

        // Query for Adjudication Documents with mapped column names
        $adjudicationDocuments = AdjudicationDocument::select([
            'adjudication_document_title as document_name',
            'id as document_id', // Original document ID from the Adjudication Documents table
            DB::raw("'Adjudication' as category"),
            'document_type_id as type',
            DB::raw("IF(is_deleted IS NULL, 'Active', 'Inactive') as status"),
            'document_filing_date as document_date',
            'updated_at as updated',
            'attachment_URL',
            'attachment_file_path',
        ])->whereNotNull('attachment_URL')
            ->whereNotNull('attachment_file_path');

        // Combine all queries using unionAll
        $combinedQuery = $globalDocuments
            ->unionAll($hydrographicDocuments)
            ->unionAll($defendantDocuments)
            ->unionAll($adjudicationDocuments);

        return $combinedQuery;
    }

    /**
     * Format the Updated date.
     */
    public function formatUpdatedDate($document): string
    {
        return optional($document->updated_at)->format('m/d/Y') ?? '--';
    }

    /**
     * Download attachments for selected documents.
     *
     * @return void
     */
    public function downloadSelectedDocuments()
    {

        // Ensure there are selected documents
        if (empty($this->selectedRows)) {
            session()->flash('message', 'No documents selected for download.');

            return null;
        }

        // Retrieve all documents as a collection
        $documents = collect($this->queryDocuments()->get());

        // Filter only selected documents by the concatenated id and formatted category
        $documents = $documents->filter(function ($document) {
            // Format the category by converting to lowercase and removing spaces
            $formattedCategory = strtolower(str_replace(
                ' ',
                '',
                $document->category
            ));

            // Create the concatenated string
            $formattedId = $document->document_id.$formattedCategory;

            // Check if the concatenated string is in the selectedRows array
            return in_array($formattedId, $this->selectedRows);
        });

        // Check if documents have attachments
        if ($documents->isEmpty()) {
            session()->flash('message', 'Selected documents have no attachments.');

            return null;
        }

        // Create a temporary file for the ZIP
        $zipFileName = 'documents_attachments.zip';
        $zipFilePath = storage_path("app/public/{$zipFileName}");

        $zip = new ZipArchive;
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            session()->flash('message', 'Failed to create ZIP file.');

            return null;
        }

        // Add each document attachment to the ZIP file
        foreach ($documents as $document) {
            $fileName = $document->attachment_URL; //returns the relative path
            $fullPath = storage_path("app/{$fileName}"); // Full path to the file

            // Check if the file exists
            if (file_exists($fullPath)) {
                $zip->addFile($fullPath, basename($fileName)); // Add file to ZIP
            } else {
                dump("File does not exist at: {$fullPath}");
            }
        }

        // Close the ZIP archive after adding all files
        $zip->close();

        // Return the ZIP file as a download response
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }
}
