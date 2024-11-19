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
 * Class State
 *
 * @property int $id
 * @property int $country_id
 * @property string $state_abbreviation
 * @property string $state_name
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Country $country
 */
class State extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'states';

    protected $fillable = [
        'country_id',
        'state_abbreviation',
        'state_name',
        'created_by',
        'updated_by',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function cities()
    {
        return $this->hasMany(City::class, 'state_id', 'state_abbreviation');
    }
}
