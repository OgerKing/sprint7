<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultipleSheetsImport implements WithMultipleSheets
{
    /**
     * @param  Collection  $collection
     */
    public function sheets(): array
    {
        return [
            'global_documents' => new GlobalDocumentsImport,
            'document_categories' => new DocumentCategoriesImport,
            'document_types' => new DocumentTypesImport,
            'Adjudication Section Statuses' => new AdjudicationSectionStatusImport,
            'Adjudication Section Types' => new AdjudicationSectionTypeImport,
            'Adjudication Statuses' => new AdjudicationStatusImport,
            'Adjudication Districts' => new AdjudicationDistrictImport,
            'global_document_PODs' => new GlobalDocumentPODImport,
            'global_document_persons' => new GlobalDocumentPersonsImport,
            'global_document_water_rights' => new GlobalDocumentWaterRightsImport,
            'subfile_adjudication_statuses' => new SubfileAdjudicationStatusesImport,
            'attorneys' => new AttorneysImport,
            'states' => new StatesImport,
            'countries' => new CountriesImport,
            'person_aliases' => new PersonAliasTypesImport,
            'Counties' => new CountiesImport,

            // 'Cities' => new CitiesImport,//TODO: not loading for some reason
            // 'pods' => new PodImport //TODO: too many rows. use Spout?

            // 'persons' => new PersonsImport //TODO: too many rows
            // 'subfiles' => new SubfilesImport
            // 'Defendant Documents' => new DefendantDocumentImport //TODO: too many rows.
            // 'Adjudication Sections' => new AdjudicationSectionImport()
            // Add additional sheets (by tab name) and their import classes here
        ];
    }
}
