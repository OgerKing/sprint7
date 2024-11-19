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
 * Class SurfaceZone
 *
 * @property int $id
 * @property float $cir
 * @property float $cir_star
 * @property float $pdr
 * @property float $pdr_star
 * @property float $fdr
 * @property float $fdr_star
 * @property string $surf_zone_description
 * @property float $evap_loss
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 */
class SurfaceZone extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'surface_zones';

    protected $casts = [
        'cir' => 'float',
        'cir_star' => 'float',
        'pdr' => 'float',
        'pdr_star' => 'float',
        'fdr' => 'float',
        'fdr_star' => 'float',
        'evap_loss' => 'float',
    ];

    protected $fillable = [
        'cir',
        'cir_star',
        'pdr',
        'pdr_star',
        'fdr',
        'fdr_star',
        'surf_zone_description',
        'evap_loss',
        'created_by',
        'updated_by',
    ];
}
