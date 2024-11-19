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
 * Class SubfileEditType
 *
 * @property int $id
 * @property string $edit_desc
 * @property string $edit_type
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 */
class SubfileEditType extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'subfile_edit_types';

    protected $fillable = [
        'edit_desc',
        'edit_type',
        'created_by',
        'updated_by',
    ];
}
