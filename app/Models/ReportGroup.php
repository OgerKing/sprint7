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
 * Class ReportGroup
 *
 * @property int $id
 * @property string $group_name
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|Report[] $reports
 */
class ReportGroup extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'report_groups';

    protected $fillable = [
        'group_name',
        'created_by',
        'updated_by',
    ];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
