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
 * Class BureauUser
 *
 * @property int $id
 * @property int $bureau_id
 * @property int $user_id
 * @property int $gis_duplicate_id
 * @property string $login_name
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Bureau $bureau
 * @property GisDuplicate $gis_duplicate
 * @property User $user
 */
class BureauUser extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'bureau_users';

    protected $casts = [
        'bureau_id' => 'int',
        'user_id' => 'int',
        'gis_duplicate_id' => 'int',
    ];

    protected $fillable = [
        'bureau_id',
        'user_id',
        'gis_duplicate_id',
        'login_name',
        'created_by',
        'updated_by',
    ];

    public function bureau()
    {
        return $this->belongsTo(Bureau::class);
    }

    public function gis_duplicate()
    {
        return $this->belongsTo(GisDuplicate::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
