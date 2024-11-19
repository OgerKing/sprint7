<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class CourtCaseAdjudicationSection
 *
 * @property int $id
 * @property int $court_case_id
 * @property int $adjudication_section_id
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property AdjudicationSection $adjudication_section
 * @property CourtCase $court_case
 */
class CourtCaseAdjudicationSection extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'court_case_adjudication_sections';

    protected $casts = [
        'court_case_id' => 'int',
        'adjudication_section_id' => 'int',
    ];

    protected $fillable = [
        'court_case_id',
        'adjudication_section_id',
        'created_by',
        'updated_by',
    ];

    public function adjudication_section()
    {
        return $this->belongsTo(AdjudicationSection::class);
    }

    public function court_case()
    {
        return $this->belongsTo(CourtCase::class);
    }
}
