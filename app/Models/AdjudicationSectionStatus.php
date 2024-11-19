<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class AdjudicationSectionStatus
 *
 * @property int $id
 * @property string $adjudication_section_status_description
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|AdjudicationDocumentProgram[] $adjudication_document_programs
 * @property Collection|AdjudicationSection[] $adjudication_sections
 */
class AdjudicationSectionStatus extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'adjudication_section_statuses';

    protected $fillable = [
        'adjudication_section_status_description',
        'created_by',
        'updated_by',
    ];

    public function adjudication_document_programs()
    {
        return $this->hasMany(AdjudicationDocumentProgram::class);
    }

    public function adjudication_sections()
    {
        return $this->hasMany(AdjudicationSection::class);
    }
}
