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
 * Class SubfileAttorneyNote
 *
 * @property int $id
 * @property int $subfile_id
 * @property string $subfile_attorney_note
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Subfile $subfile
 */
class SubfileAttorneyNote extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'subfile_attorney_notes';

    protected $casts = [
        'subfile_id' => 'int',
    ];

    protected $fillable = [
        'subfile_id',
        'subfile_attorney_note',
        'created_by',
        'updated_by',
    ];

    public function subfile()
    {
        return $this->belongsTo(Subfile::class);
    }
}
