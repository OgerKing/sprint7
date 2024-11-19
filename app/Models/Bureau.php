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
 * Class Bureau
 *
 * @property int $id
 * @property string $bureau_name
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|AdjudicationDocumentProgram[] $adjudication_document_programs
 * @property Collection|Adjudication[] $adjudications
 * @property Collection|User[] $users
 * @property Collection|MissingPouirr[] $missing_pouirrs
 * @property Collection|PouIrrigation[] $pou_irrigations
 */
class Bureau extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'bureaus';

    protected $fillable = [
        'bureau_name',
        'created_by',
        'updated_by',
    ];

    public function adjudication_document_programs()
    {
        return $this->hasMany(AdjudicationDocumentProgram::class);
    }

    public function adjudications()
    {
        return $this->hasMany(Adjudication::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'bureau_users')
            ->withPivot('id', 'gis_duplicate_id', 'login_name', 'created_by', 'updated_by')
            ->withTimestamps();
    }

    public function missing_pouirrs()
    {
        return $this->hasMany(MissingPouirr::class);
    }

    public function pou_irrigations()
    {
        return $this->hasMany(PouIrrigation::class);
    }
}
