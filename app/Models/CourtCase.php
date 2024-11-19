<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class CourtCase
 *
 * @property int $id
 * @property int $court_id
 * @property string|null $case_number
 * @property string|null $case_name
 * @property string|null $court_docket_link
 * @property string|null $docket_number
 * @property int|null $court_judge_id
 * @property int|null $court_master_id
 * @property Carbon|null $court_case_open_date
 * @property Carbon|null $court_case_close_date
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property string|null $deleted_at
 * @property string|null $court_judge_signature
 * @property string|null $court_master_signature
 * @property Court $court
 * @property CourtPersonnel|null $court_personnel
 * @property Collection|AdjudicationDocumentProgram[] $adjudication_document_programs
 * @property Collection|AdjudicationSection[] $adjudication_sections
 * @property Collection|Subfile[] $subfiles
 */
class CourtCase extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'court_cases';

    protected $casts = [
        'court_id' => 'int',
        'court_judge_id' => 'int',
        'court_master_id' => 'int',
        'court_case_open_date' => 'datetime',
        'court_case_close_date' => 'datetime',
    ];

    protected $fillable = [
        'court_id',
        'case_number',
        'case_name',
        'court_docket_link',
        'docket_number',
        'court_judge_id',
        'court_master_id',
        'court_case_open_date',
        'court_case_close_date',
        'created_by',
        'updated_by',
        'court_judge_signature',
        'court_master_signature',
    ];

    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    public function court_personnel()
    {
        return $this->belongsTo(CourtPersonnel::class, 'court_master_id');
    }

    public function adjudication_document_programs()
    {
        return $this->hasMany(AdjudicationDocumentProgram::class);
    }

    public function adjudication_sections()
    {
        return $this->belongsToMany(AdjudicationSection::class, 'court_case_adjudication_sections')
            ->withPivot('id', 'created_by', 'updated_by')
            ->withTimestamps();
    }

    public function subfiles()
    {
        return $this->belongsToMany(Subfile::class, 'subfile_court_cases')
            ->withPivot('id', 'parent_court_case_id', 'case_number', 'court_case_open_date', 'court_case_close_date', 'created_by', 'updated_by')
            ->withTimestamps();
    }
}
