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
 * Class PodComment
 *
 * @property int $id
 * @property int $pod_id
 * @property Carbon $pod_comment_date
 * @property string $pod_comment_description
 * @property string $pod_comment_resource
 * @property int $pod_comment_type_id
 * @property string $work_notes
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property PodCommentType $pod_comment_type
 * @property Pod $pod
 */
class PodComment extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'pod_comments';

    protected $casts = [
        'pod_id' => 'int',
        'pod_comment_date' => 'datetime',
        'pod_comment_type_id' => 'int',
    ];

    protected $fillable = [
        'pod_id',
        'pod_comment_date',
        'pod_comment_description',
        'pod_comment_resource',
        'pod_comment_type_id',
        'work_notes',
        'created_by',
        'updated_by',
    ];

    public function pod_comment_type()
    {
        return $this->belongsTo(PodCommentType::class);
    }

    public function pod()
    {
        return $this->belongsTo(Pod::class);
    }
}
