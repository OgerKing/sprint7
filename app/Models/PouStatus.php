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
 * Class PouStatus
 *
 * @property int $id
 * @property string $pou_status_code
 * @property string $pou_status_description
 * @property int|null $display_line
 * @property int|null $display_summary
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|MissingPouirr[] $missing_pouirrs
 * @property Collection|PouIrrigation[] $pou_irrigations
 * @property Collection|Pou[] $pous
 */
class PouStatus extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'pou_statuses';

    protected $casts = [
        'display_line' => 'int',
        'display_summary' => 'int',
    ];

    protected $fillable = [
        'pou_status_code',
        'pou_status_description',
        'display_line',
        'display_summary',
        'created_by',
        'updated_by',
    ];

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
