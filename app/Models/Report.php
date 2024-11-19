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
 * Class Report
 *
 * @property int $id
 * @property int $report_group_id
 * @property string $report_name
 * @property string $report_description
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property ReportGroup $report_group
 * @property Collection|ReportCriteria[] $report_criterias
 */
class Report extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'reports';

    public $incrementing = false;

    protected $casts = [
        'id' => 'int',
        'report_group_id' => 'int',
    ];

    protected $fillable = [
        'report_group_id',
        'report_name',
        'report_description',
        'created_by',
        'updated_by',
    ];

    public function report_group()
    {
        return $this->belongsTo(ReportGroup::class);
    }

    public function report_criterias()
    {
        return $this->hasMany(ReportCriteria::class);
    }
}
