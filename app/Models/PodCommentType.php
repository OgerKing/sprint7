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
 * Class PodCommentType
 *
 * @property int $id
 * @property string $pod_comment_type
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|PodComment[] $pod_comments
 */
class PodCommentType extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'pod_comment_types';

    protected $fillable = [
        'pod_comment_type',
        'created_by',
        'updated_by',
    ];

    public function pod_comments()
    {
        return $this->hasMany(PodComment::class);
    }
}
