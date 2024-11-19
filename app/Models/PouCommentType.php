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
 * Class PouCommentType
 *
 * @property int $id
 * @property string $pou_comment_type
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 */
class PouCommentType extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'pou_comment_types';

    public $incrementing = false;

    protected $casts = [
        'id' => 'int',
    ];

    protected $fillable = [
        'pou_comment_type',
        'created_by',
        'updated_by',
    ];
}
