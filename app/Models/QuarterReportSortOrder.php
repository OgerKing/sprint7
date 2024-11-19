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
 * Class QuarterReportSortOrder
 *
 * @property int $id
 * @property int $adjudications_section_id
 * @property int $row_order_id
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property AdjudicationSection $adjudication_section
 */
class QuarterReportSortOrder extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'quarter_report_sort_order';

    protected $casts = [
        'adjudications_section_id' => 'int',
        'row_order_id' => 'int',
    ];

    protected $fillable = [
        'adjudications_section_id',
        'row_order_id',
        'created_by',
        'updated_by',
    ];

    public function adjudication_section()
    {
        return $this->belongsTo(AdjudicationSection::class, 'adjudications_section_id');
    }
}
