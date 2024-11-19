<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Cache
 *
 * @property string $key
 * @property string $value
 * @property int $expiration
 */
class Cache extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'cache';

    protected $primaryKey = 'key';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'expiration' => 'int',
    ];

    protected $fillable = [
        'value',
        'expiration',
    ];
}
