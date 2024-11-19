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
 * Class Xydatum
 *
 * @property int $id
 * @property string $xydatum_description
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 */
class Xydatum extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'xydatums';

    public $incrementing = false;

    protected $casts = [
        'id' => 'int',
    ];

    protected $fillable = [
        'xydatum_description',
        'created_by',
        'updated_by',
    ];
}
