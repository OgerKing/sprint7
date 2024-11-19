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
 * Class AttorneyAttorneyList
 *
 * @property int $id
 * @property int $attorney_id
 * @property int $attorney_list_id
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Attorney $attorney
 * @property AttorneyList $attorney_list
 */
class AttorneyAttorneyList extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'attorney_attorney_lists';

    public $incrementing = false;

    protected $casts = [
        'id' => 'int',
        'attorney_id' => 'int',
        'attorney_list_id' => 'int',
    ];

    protected $fillable = [
        'id',
        'attorney_id',
        'attorney_list_id',
        'created_by',
        'updated_by',
    ];

    public function attorney()
    {
        return $this->belongsTo(Attorney::class);
    }

    public function attorney_list()
    {
        return $this->belongsTo(AttorneyList::class);
    }
}
