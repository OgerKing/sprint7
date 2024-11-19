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
 * Class MissingPouirr
 *
 * @property int $id
 * @property float $acres
 * @property float $area
 * @property int $basin_nbr_hl
 * @property int $bureau_id
 * @property int $city_id
 * @property string $comments
 * @property int $county_id
 * @property int $court_id
 * @property string $created_by
 * @property float $crop_code
 * @property float $crop_field
 * @property int $grant_id
 * @property string $ia_id
 * @property float $ia_no
 * @property string $irr_sys_type
 * @property string $lo_code
 * @property string $map_nr_acr
 * @property string $map_qtr
 * @property string $mult
 * @property int $no_right
 * @property string $o_photo_no
 * @property float $perimeter
 * @property int $pl_id
 * @property int $pl_idaccess
 * @property string $pla_qtr16th
 * @property string $pla_qtr_4th
 * @property string $pla_qtr_64th
 * @property string $pla_rng
 * @property string $pla_sec
 * @property string $pla_tws
 * @property int $pou_comments_id
 * @property string $pou_hl_txt
 * @property int $pou_irrigation_id
 * @property string $pou_map_txt
 * @property int $pou_status_id
 * @property string $pou_tract_txt
 * @property int $arcgis_processing_id
 * @property string $subsec_txt
 * @property string $updated_by
 * @property string $work_notes
 * @property float $x
 * @property float $y
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property PouIrrigation $pou_irrigation
 * @property ArcgisProcessing $arcgis_processing
 * @property Bureau $bureau
 * @property City $city
 * @property County $county
 * @property Court $court
 * @property Grant $grant
 * @property PouComment $pou_comment
 * @property PouStatus $pou_status
 */
class MissingPouirr extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'missing_pouirrs';

    protected $casts = [
        'acres' => 'float',
        'area' => 'float',
        'basin_nbr_hl' => 'int',
        'bureau_id' => 'int',
        'city_id' => 'int',
        'county_id' => 'int',
        'court_id' => 'int',
        'crop_code' => 'float',
        'crop_field' => 'float',
        'grant_id' => 'int',
        'ia_no' => 'float',
        'no_right' => 'int',
        'perimeter' => 'float',
        'pl_id' => 'int',
        'pl_idaccess' => 'int',
        'pou_comments_id' => 'int',
        'pou_irrigation_id' => 'int',
        'pou_status_id' => 'int',
        'arcgis_processing_id' => 'int',
        'x' => 'float',
        'y' => 'float',
    ];

    protected $fillable = [
        'acres',
        'area',
        'basin_nbr_hl',
        'bureau_id',
        'city_id',
        'comments',
        'county_id',
        'court_id',
        'created_by',
        'crop_code',
        'crop_field',
        'grant_id',
        'ia_id',
        'ia_no',
        'irr_sys_type',
        'lo_code',
        'map_nr_acr',
        'map_qtr',
        'mult',
        'no_right',
        'o_photo_no',
        'perimeter',
        'pl_id',
        'pl_idaccess',
        'pla_qtr16th',
        'pla_qtr_4th',
        'pla_qtr_64th',
        'pla_rng',
        'pla_sec',
        'pla_tws',
        'pou_comments_id',
        'pou_hl_txt',
        'pou_irrigation_id',
        'pou_map_txt',
        'pou_status_id',
        'pou_tract_txt',
        'arcgis_processing_id',
        'subsec_txt',
        'updated_by',
        'work_notes',
        'x',
        'y',
    ];

    public function pou_irrigation()
    {
        return $this->belongsTo(PouIrrigation::class);
    }

    public function arcgis_processing()
    {
        return $this->belongsTo(ArcgisProcessing::class);
    }

    public function bureau()
    {
        return $this->belongsTo(Bureau::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function county()
    {
        return $this->belongsTo(County::class);
    }

    public function court()
    {
        return $this->belongsTo(Court::class);
    }

    public function grant()
    {
        return $this->belongsTo(Grant::class);
    }

    public function pou_comment()
    {
        return $this->belongsTo(PouComment::class, 'pou_comments_id');
    }

    public function pou_status()
    {
        return $this->belongsTo(PouStatus::class);
    }
}
