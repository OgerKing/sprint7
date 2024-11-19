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
 * Class Pou
 *
 * @property int $id
 * @property int|null $arcgis_processing_id
 * @property int|null $pou_status_id
 * @property string|null $subsec_txt
 * @property string|null $pou_map_txt
 * @property string|null $pou_tract_txt
 * @property int|null $x
 * @property int|null $y
 * @property string|null $xy_unit_of_measure
 * @property string|null $alt_location_hl
 * @property int|null $no_right
 * @property string|null $pla_qtr_4th
 * @property string|null $pla_qtr_16th
 * @property string|null $pla_qtr_64th
 * @property string|null $pla_sec
 * @property string|null $pla_tws
 * @property string|null $pla_rng
 * @property float|null $rev_hs_acres
 * @property string|null $plss_description
 * @property string|null $lot
 * @property int|null $outside_adjudication_section
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property ArcgisProcessing|null $arcgis_processing
 * @property PouStatus|null $pou_status
 * @property Collection|GlobalDocumentPOU[] $global_document_p_o_us
 * @property Collection|PouComment[] $pou_comments
 * @property Collection|PouIrrigation[] $pou_irrigations
 */
class Pou extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'pous';

    protected $casts = [
        'arcgis_processing_id' => 'int',
        'pou_status_id' => 'int',
        'x' => 'int',
        'y' => 'int',
        'no_right' => 'int',
        'rev_hs_acres' => 'float',
        'outside_adjudication_section' => 'int',
        'updated_at' => 'datetime',
    ];

    protected $fillable = [
        'arcgis_processing_id',
        'pou_status_id',
        'subsec_txt',
        'pou_map_txt',
        'pou_tract_txt',
        'x',
        'y',
        'xy_unit_of_measure',
        'alt_location_hl',
        'no_right',
        'pla_qtr_4th',
        'pla_qtr_16th',
        'pla_qtr_64th',
        'pla_sec',
        'pla_tws',
        'pla_rng',
        'rev_hs_acres',
        'plss_description',
        'lot',
        'outside_adjudication_section',
        'created_by',
        'updated_by',
    ];

    public function arcgis_processing()
    {
        return $this->belongsTo(ArcgisProcessing::class);
    }

    public function pou_status()
    {
        return $this->belongsTo(PouStatus::class);
    }

    public function global_document_p_o_us()
    {
        return $this->hasMany(GlobalDocumentPOU::class, 'POU_id');
    }

    public function pou_comments()
    {
        return $this->hasMany(PouComment::class);
    }

    public function pou_irrigations()
    {
        return $this->hasMany(PouIrrigation::class);
    }

    public function pou_non_irrigations()
    {
        return $this->hasMany(PouNonIrrigation::class);
    }

    public function water_rights()
    {
        return $this->belongsToMany(WaterRight::class, 'pou_water_rights', 'pou_id', 'water_right_id');
    }
}
