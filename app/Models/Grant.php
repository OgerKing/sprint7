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
 * Class Grant
 *
 * @property int $id
 * @property string $grant_code
 * @property string $grant_name
 * @property int|null $proj
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|MissingPouirr[] $missing_pouirrs
 * @property Collection|PouIrrigation[] $pou_irrigations
 */
class Grant extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'grants';

    protected $casts = [
        'proj' => 'int',
    ];

    protected $fillable = [
        'grant_code',
        'grant_name',
        'proj',
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
}
