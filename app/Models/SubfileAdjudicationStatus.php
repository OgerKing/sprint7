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
 * Class SubfileAdjudicationStatus
 *
 * @property int $id
 * @property string $subfile_adjudication_status_code
 * @property string $subfile_adjudication_status_description
 * @property int $sort
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|Subfile[] $subfiles
 */
class SubfileAdjudicationStatus extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'subfile_adjudication_statuses';

    protected $casts = [
        'sort' => 'int',
    ];

    protected $fillable = [
        'subfile_adjudication_status_code',
        'subfile_adjudication_status_description',
        'sort',
        'created_by',
        'updated_by',
    ];

    public function subfiles()
    {
        return $this->hasMany(Subfile::class);
    }
}
