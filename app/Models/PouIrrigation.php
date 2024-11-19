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
 * Class PouIrrigation
 *
 * @property int $id
 * @property int|null $pou_id
 * @property int|null $arcgis_processing_id
 * @property int|null $pou_status_id
 * @property int|null $bureau_id
 * @property string|null $county_id
 * @property int|null $grant_id
 * @property int|null $area
 * @property int|null $perimeter
 * @property string|null $mult
 * @property int|null $ia_no
 * @property string|null $ia_id
 * @property string|null $sub_sec_txt
 * @property string|null $pou_hl_txt
 * @property int|null $crop_field
 * @property int|null $crop_code
 * @property string|null $irr_sys_type
 * @property string|null $lo_code
 * @property string|null $o_photo_no
 * @property string|null $map_nr_acr
 * @property int|null $pl_id_access
 * @property int|null $basin_nbr_hl
 * @property string|null $map_qtr
 * @property string|null $crop_irrigation_requirement
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property ArcgisProcessing|null $arcgis_processing
 * @property Bureau|null $bureau
 * @property Grant|null $grant
 * @property Pou|null $pou
 * @property PouStatus|null $pou_status
 * @property Collection|MissingPouirr[] $missing_pouirrs
 */
class PouIrrigation extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'pou_irrigations';

    protected $casts = [
        'pou_id' => 'int',
        'arcgis_processing_id' => 'int',
        'pou_status_id' => 'int',
        'bureau_id' => 'int',
        'grant_id' => 'int',
        'area' => 'int',
        'perimeter' => 'int',
        'ia_no' => 'int',
        'crop_field' => 'int',
        'crop_code' => 'int',
        'pl_id_access' => 'int',
        'basin_nbr_hl' => 'int',
    ];

    protected $fillable = [
        'pou_id',
        'arcgis_processing_id',
        'pou_status_id',
        'bureau_id',
        'county_id',
        'grant_id',
        'area',
        'perimeter',
        'mult',
        'ia_no',
        'ia_id',
        'sub_sec_txt',
        'pou_hl_txt',
        'crop_field',
        'crop_code',
        'irr_sys_type',
        'lo_code',
        'o_photo_no',
        'map_nr_acr',
        'pl_id_access',
        'basin_nbr_hl',
        'map_qtr',
        'crop_irrigation_requirement',
        'created_by',
        'updated_by',
    ];

    public function arcgis_processing()
    {
        return $this->belongsTo(ArcgisProcessing::class);
    }

    public function bureau()
    {
        return $this->belongsTo(Bureau::class);
    }

    public function grant()
    {
        return $this->belongsTo(Grant::class);
    }

    public function pou()
    {
        return $this->belongsTo(Pou::class);
    }

    public function pou_status()
    {
        return $this->belongsTo(PouStatus::class);
    }

    public function missing_pouirrs()
    {
        return $this->hasMany(MissingPouirr::class);
    }

    public function county()
    {
        return $this->belongsTo(County::class, 'county_id');
    }
}
