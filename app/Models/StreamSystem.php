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
 * Class StreamSystem
 *
 * @property int $id
 * @property string $stream_system_name
 * @property bool $is_in_wrats
 * @property Carbon|null $updated_at
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property string $updated_by
 */
class StreamSystem extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'stream_systems';

    protected $casts = [
        'is_in_wrats' => 'bool',
    ];

    protected $fillable = [
        'stream_system_name',
        'is_in_wrats',
        'created_by',
        'updated_by',
    ];
}
