<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class AttorneyList
 *
 * @property int $id
 * @property string $attorney_list_name
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|Attorney[] $attorneys
 */
class AttorneyList extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'attorney_lists';

    protected $fillable = [
        'attorney_list_name',
        'created_by',
        'updated_by',
    ];

    public function attorneys()
    {
        return $this->belongsToMany(Attorney::class, 'attorney_attorney_lists')
            ->withPivot('id', 'created_by', 'updated_by')
            ->withTimestamps();
    }
}
