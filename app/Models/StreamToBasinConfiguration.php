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
 * Class StreamToBasinConfiguration
 *
 * @property int $id
 * @property int $stream_system_id
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property string $basin_code
 */
class StreamToBasinConfiguration extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'stream_to_basin_configurations';

    protected $casts = [
        'stream_system_id' => 'int',
    ];

    protected $fillable = [
        'stream_system_id',
        'created_by',
        'updated_by',
        'basin_code',
    ];

    public function stream_system()
    {
        return $this->belongsTo(StreamSystem::class);
    }
}
