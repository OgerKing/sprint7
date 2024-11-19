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
 * Class SubfileCourtCase
 *
 * @property int $id
 * @property int $subfile_id
 * @property int $court_case_id
 * @property int $parent_court_case_id
 * @property string|null $case_number
 * @property Carbon|null $court_case_open_date
 * @property Carbon|null $court_case_close_date
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property CourtCase $court_case
 * @property Subfile $subfile
 */
class SubfileCourtCase extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'subfile_court_cases';

    protected $casts = [
        'subfile_id' => 'int',
        'court_case_id' => 'int',
        'parent_court_case_id' => 'int',
        'court_case_open_date' => 'datetime',
        'court_case_close_date' => 'datetime',
    ];

    protected $fillable = [
        'subfile_id',
        'court_case_id',
        'parent_court_case_id',
        'case_number',
        'court_case_open_date',
        'court_case_close_date',
        'created_by',
        'updated_by',
    ];

    public function court_case()
    {
        return $this->belongsTo(CourtCase::class);
    }

    public function subfile()
    {
        return $this->belongsTo(Subfile::class);
    }
}
