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
 * Class PouComment
 *
 * @property int $id
 * @property int $pou_id
 * @property string|null $comment
 * @property Carbon $pou_comment_date
 * @property string $pou_comment_resource
 * @property string $pou_comment_description
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Pou $pou
 * @property Collection|MissingPouirr[] $missing_pouirrs
 */
class PouComment extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'pou_comments';

    protected $casts = [
        'pou_id' => 'int',
        'pou_comment_date' => 'datetime',
    ];

    protected $fillable = [
        'pou_id',
        'comment',
        'pou_comment_date',
        'pou_comment_resource',
        'pou_comment_description',
        'created_by',
        'updated_by',
    ];

    public function pou()
    {
        return $this->belongsTo(Pou::class);
    }

    public function missing_pouirrs()
    {
        return $this->hasMany(MissingPouirr::class, 'pou_comments_id');
    }
}
