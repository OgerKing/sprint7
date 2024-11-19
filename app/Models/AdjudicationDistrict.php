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
 * Class AdjudicationDistrict
 *
 * @property int $id
 * @property string $adjudication_district
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|Adjudication[] $adjudications
 */
class AdjudicationDistrict extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'adjudication_districts';

    protected $fillable = [
        'adjudication_district',
        'created_by',
        'updated_by',
    ];

    public function adjudications()
    {
        return $this->hasMany(Adjudication::class);
    }
}
