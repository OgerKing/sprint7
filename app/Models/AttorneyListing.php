<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class AttorneyListing
 *
 * @property int $id
 * @property int $attorney_id
 * @property int $attorney_list_id
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Attorney $attorney
 */
class AttorneyListing extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'attorney_listings';

    protected $casts = [
        'attorney_id' => 'int',
        'attorney_list_id' => 'int',
    ];

    protected $fillable = [
        'attorney_id',
        'attorney_list_id',
        'created_by',
        'updated_by',
    ];

    public function attorney()
    {
        return $this->belongsTo(Attorney::class);
    }
}
