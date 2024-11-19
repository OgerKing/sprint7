<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class CacheLock
 *
 * @property string $key
 * @property string $owner
 * @property int $expiration
 */
class CacheLock extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'cache_locks';

    protected $primaryKey = 'key';

    public $incrementing = false;

    public $timestamps = false;

    protected $casts = [
        'expiration' => 'int',
    ];

    protected $fillable = [
        'owner',
        'expiration',
    ];
}
