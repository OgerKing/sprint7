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
 * Class SubfileUserWatch
 *
 * @property int $id
 * @property int|null $subfile_id
 * @property int|null $wrats_user_id
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Subfile|null $subfile
 * @property WratsUser|null $wrats_user
 */
class SubfileUserWatch extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'subfile_user_watch';

    protected $casts = [
        'subfile_id' => 'int',
        'wrats_user_id' => 'int',
    ];

    protected $fillable = [
        'subfile_id',
        'wrats_user_id',
        'created_by',
        'updated_by',
    ];

    public function subfile()
    {
        return $this->belongsTo(Subfile::class);
    }

    public function wrats_user()
    {
        return $this->belongsTo(WratsUser::class);
    }
}
