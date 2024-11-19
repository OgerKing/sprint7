<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Pod
 *
 * @property int $id
 * @property string $s_type_cat
 * @property string|null $pod_name
 * @property string|null $pod_subfile
 * @property string|null $pod_map_txt
 * @property string|null $pod_tract_txt
 * @property string|null $qtr_4th
 * @property string|null $qtr_16th
 * @property string|null $qtr_64th
 * @property string|null $sub_sec_txt
 * @property string|null $sec
 * @property string|null $tws
 * @property string|null $rng
 * @property float|null $x
 * @property float|null $y
 * @property string|null $xy_datum
 * @property string|null $xy_unit_of_measure
 * @property string|null $zone
 * @property string|null $map_id_desc
 * @property string|null $f_photo_nbr
 * @property int|null $well_define
 * @property Carbon|null $pod_loc_date
 * @property Carbon|null $pod_loc_time
 * @property string|null $plss_description
 * @property int|null $crew_nbr
 * @property string|null $point_qual
 * @property float|null $std_dev
 * @property string|null $pod_basin
 * @property string|null $pod_nbr
 * @property string|null $pod_suffix
 * @property string|null $ose_file
 * @property string|null $pod_hl_txt
 * @property string|null $pod_field_no
 * @property string|null $lot
 * @property string|null $pod_location_description
 * @property string|null $waters_pod_id
 * @property int|null $s_id_access
 * @property int|null $selected
 * @property string|null $map_qtr
 * @property float|null $lat_deg
 * @property float|null $lat_min
 * @property float|null $lat_sec
 * @property float|null $lon_deg
 * @property float|null $lon_min
 * @property float|null $lon_sec
 * @property string|null $location_data_source
 * @property int|null $arcgis_processing_id
 * @property int|null $pod_type_id
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|GlobalDocumentPOD[] $global_document_p_o_ds
 * @property Collection|WaterRight[] $water_rights
 */
class Pod extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'pods';

    public $incrementing = false;

    protected $casts = [
        'id' => 'int',
        'x' => 'float',
        'y' => 'float',
        'well_define' => 'int',
        'pod_loc_date' => 'datetime',
        'pod_loc_time' => 'datetime',
        'crew_nbr' => 'int',
        'std_dev' => 'float',
        's_id_access' => 'int',
        'selected' => 'int',
        'lat_deg' => 'float',
        'lat_min' => 'float',
        'lat_sec' => 'float',
        'lon_deg' => 'float',
        'lon_min' => 'float',
        'lon_sec' => 'float',
        'arcgis_processing_id' => 'int',
        'pod_type_id' => 'int',
    ];

    protected $fillable = [
        's_type_cat',
        'pod_name',
        'pod_subfile',
        'pod_map_txt',
        'pod_tract_txt',
        'qtr_4th',
        'qtr_16th',
        'qtr_64th',
        'sub_sec_txt',
        'sec',
        'tws',
        'rng',
        'x',
        'y',
        'xy_datum',
        'xy_unit_of_measure',
        'zone',
        'map_id_desc',
        'f_photo_nbr',
        'well_define',
        'pod_loc_date',
        'pod_loc_time',
        'plss_description',
        'crew_nbr',
        'point_qual',
        'std_dev',
        'pod_basin',
        'pod_nbr',
        'pod_suffix',
        'ose_file',
        'pod_hl_txt',
        'pod_field_no',
        'lot',
        'pod_location_description',
        'waters_pod_id',
        's_id_access',
        'selected',
        'map_qtr',
        'lat_deg',
        'lat_min',
        'lat_sec',
        'lon_deg',
        'lon_min',
        'lon_sec',
        'location_data_source',
        'arcgis_processing_id',
        'pod_type_id',
        'created_by',
        'updated_by',
    ];

    public function global_document_p_o_ds()
    {
        return $this->hasMany(GlobalDocumentPOD::class, 'POD_id');
    }

    public function water_rights()
    {
        return $this->belongsToMany(WaterRight::class, 'pod_water_rights')
            ->withPivot('id', 'acres_pri', 'acre_ft_pri', 'percent_cfs', 'priority_date', 'priority_date_text', 'created_by', 'updated_by')
            ->withTimestamps();
    }

    public function ground_pods(): HasMany
    {
        return $this->hasMany(GroundPod::class);
    }

    public function surface_pods(): HasMany
    {
        return $this->hasMany(SurfacePod::class);
    }

    /**
     * Relationship to fetch subfiles associated with the POD via subfile_pod_right.
     */
    // public function subfile_pod_right()
    // {
    //     return $this->hasMany(SubfilePodRight::class, 'pod_id');
    // }

    /**
     * Relationship to fetch the county directly associated with the POD.
     */
    public function county()
    {
        return $this->belongsTo(County::class, 'county_id');
    }

    /**
     * Relationship to fetch related pou_irrigations, which contain county information.
     */
    public function pou_irrigations()
    {
        return $this->hasMany(PouIrrigation::class, 'pod_id');
    }

    /**
     * Relationship to fetch water source information through water rights.
     */
    public function water_source()
    {
        return $this->hasOneThrough(
            WaterSource::class,
            WaterRight::class,
            'id', // Foreign key on water_rights table...
            'id', // Foreign key on water_sources table...
            'id', // Local key on pods table...
            'water_source_id' // Local key on water_rights table...
        );
    }
}
