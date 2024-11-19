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
 * Class ArcgisProcessing
 *
 * @property int $id
 * @property int $adjudication_section_id
 * @property int|null $access_gis
 * @property int|null $gis
 * @property string|null $gis_dir
 * @property Carbon|null $last_import
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property AdjudicationSection $adjudication_section
 * @property Collection|GroundPod[] $ground_pods
 * @property Collection|ImportError[] $import_errors
 * @property Collection|MissingPouirr[] $missing_pouirrs
 * @property Collection|Pod[] $pods
 * @property Collection|PouIrrigation[] $pou_irrigations
 * @property Collection|PouNonIrrigation[] $pou_non_irrigations
 * @property Collection|Pou[] $pous
 * @property Collection|SurfacePod[] $surface_pods
 */
class ArcgisProcessing extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'arcgis_processing';

    protected $casts = [
        'adjudication_section_id' => 'int',
        'access_gis' => 'int',
        'gis' => 'int',
        'last_import' => 'datetime',
    ];

    protected $fillable = [
        'adjudication_section_id',
        'access_gis',
        'gis',
        'gis_dir',
        'last_import',
        'created_by',
        'updated_by',
    ];

    public function adjudication_section()
    {
        return $this->belongsTo(AdjudicationSection::class);
    }

    public function import_errors()
    {
        return $this->hasMany(ImportError::class);
    }

    public function missing_pouirrs()
    {
        return $this->hasMany(MissingPouirr::class);
    }

    public function pou_irrigations()
    {
        return $this->hasMany(PouIrrigation::class);
    }

    public function pous()
    {
        return $this->hasMany(Pou::class);
    }
}
