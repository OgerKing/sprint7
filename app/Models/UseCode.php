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
 * Class UseCode
 *
 * @property int $id
 * @property string $use_code
 * @property string $use_description
 * @property int $domestic
 * @property int $acres
 * @property int $use_type_nbr
 * @property int|null $old_only
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 */
class UseCode extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'use_codes';

    protected $casts = [
        'domestic' => 'int',
        'acres' => 'int',
        'use_type_nbr' => 'int',
        'old_only' => 'int',
    ];

    protected $fillable = [
        'use_code',
        'use_description',
        'domestic',
        'acres',
        'use_type_nbr',
        'old_only',
        'created_by',
        'updated_by',
    ];
}
