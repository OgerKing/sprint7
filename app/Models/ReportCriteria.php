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
 * Class ReportCriteria
 *
 * @property int $id
 * @property int $report_id
 * @property bool $is_required
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Report $report
 */
class ReportCriteria extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'report_criterias';

    protected $casts = [
        'report_id' => 'int',
        'is_required' => 'bool',
    ];

    protected $fillable = [
        'report_id',
        'is_required',
        'created_by',
        'updated_by',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}
