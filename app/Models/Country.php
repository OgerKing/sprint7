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
 * Class Country
 *
 * @property int $id
 * @property string $country_name
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|State[] $states
 */
class Country extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'countries';

    protected $fillable = [
        'country_name',
        'created_by',
        'updated_by',
    ];

    public function states()
    {
        return $this->hasMany(State::class);
    }
}
