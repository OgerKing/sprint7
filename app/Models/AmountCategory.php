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
 * Class AmountCategory
 *
 * @property int $id
 * @property string $amt_type_id
 * @property string $amt_type_desc
 * @property int|null $amt_fdr
 * @property int|null $amt_cir
 * @property int|null $amt_pdr
 * @property int|null $amt_txt
 * @property int|null $amt_div_rt_hl
 * @property int|null $amt_cfs
 * @property int|null $amt_con_use
 * @property int|null $amt_surf_area
 * @property int|null $amt_depth
 * @property int|null $amt_volume
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|WaterRight[] $water_rights
 */
class AmountCategory extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'amount_categories';

    protected $casts = [
        'amt_fdr' => 'int',
        'amt_cir' => 'int',
        'amt_pdr' => 'int',
        'amt_txt' => 'int',
        'amt_div_rt_hl' => 'int',
        'amt_cfs' => 'int',
        'amt_con_use' => 'int',
        'amt_surf_area' => 'int',
        'amt_depth' => 'int',
        'amt_volume' => 'int',
    ];

    protected $fillable = [
        'amt_type_id',
        'amt_type_desc',
        'amt_fdr',
        'amt_cir',
        'amt_pdr',
        'amt_txt',
        'amt_div_rt_hl',
        'amt_cfs',
        'amt_con_use',
        'amt_surf_area',
        'amt_depth',
        'amt_volume',
        'created_by',
        'updated_by',
    ];

    public function water_rights()
    {
        return $this->hasMany(WaterRight::class);
    }
}
