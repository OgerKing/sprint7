<?php

namespace App\Livewire\Forms;

use App\Models\AdjudicationDocument;
use Livewire\Form;

class AdjudicationRecordsFormComponent extends Form
{
    public ?AdjudicationDocument $adjudicationDocument;

    public $subfile_id;

    public $adjudication_document_code;

    public $adjudication_document_title;

    public $document_filing_date;

    public $attachment_link;

    public $adjudication_document_type_id;
}
