<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class AdjudicationDocumentProgram
 *
 * @property int $id
 * @property int $court_case_id
 * @property int $adjudication_document_id
 * @property int $document_type_id
 * @property int $adjudication_id
 * @property int $adjudication_section_status_id
 * @property int $adjudication_section_type_id
 * @property int $adjudication_sections_id
 * @property int $adjudication_status_id
 * @property int $bureau_id
 * @property int $court_id
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Adjudication $adjudication
 * @property Bureau $bureau
 * @property Court $court
 * @property DocumentType $document_type
 * @property AdjudicationStatus $adjudication_status
 * @property AdjudicationDocument $adjudication_document
 * @property CourtCase $court_case
 * @property AdjudicationSection $adjudication_section
 * @property AdjudicationSectionStatus $adjudication_section_status
 * @property AdjudicationSectionType $adjudication_section_type
 */
class AdjudicationDocumentProgram extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'adjudication_document_programs';

    protected $casts = [
        'court_case_id' => 'int',
        'adjudication_document_id' => 'int',
        'document_type_id' => 'int',
        'adjudication_id' => 'int',
        'adjudication_section_status_id' => 'int',
        'adjudication_section_type_id' => 'int',
        'adjudication_sections_id' => 'int',
        'adjudication_status_id' => 'int',
        'bureau_id' => 'int',
        'court_id' => 'int',
    ];

    protected $fillable = [
        'court_case_id',
        'adjudication_document_id',
        'document_type_id',
        'adjudication_id',
        'adjudication_section_status_id',
        'adjudication_section_type_id',
        'adjudication_sections_id',
        'adjudication_status_id',
        'bureau_id',
        'court_id',
        'created_by',
        'updated_by',
    ];

    public function adjudication()
    {
        return $this->belongsTo(Adjudication::class);
    }

    public function bureau()
    {
        return $this->belongsTo(Bureau::class);
    }

    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    public function document_type()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function adjudication_status()
    {
        return $this->belongsTo(AdjudicationStatus::class);
    }

    public function adjudication_document()
    {
        return $this->belongsTo(AdjudicationDocument::class);
    }

    public function court_case()
    {
        return $this->belongsTo(CourtCase::class);
    }

    public function adjudication_section()
    {
        return $this->belongsTo(AdjudicationSection::class, 'adjudication_sections_id');
    }

    public function adjudication_section_status()
    {
        return $this->belongsTo(AdjudicationSectionStatus::class);
    }

    public function adjudication_section_type()
    {
        return $this->belongsTo(AdjudicationSectionType::class);
    }
}
