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
 * Class Court
 *
 * @property int $id
 * @property string $court_name
 * @property string $court_jurisdiction
 * @property string $court_type
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|AdjudicationDocumentProgram[] $adjudication_document_programs
 * @property Collection|CourtCase[] $court_cases
 * @property Collection|CourtPersonnel[] $court_personnels
 * @property Collection|MissingPouirr[] $missing_pouirrs
 */
class Court extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'courts';

    protected $fillable = [
        'court_name',
        'court_jurisdiction',
        'court_type',
        'created_by',
        'updated_by',
    ];

    public function adjudication_document_programs()
    {
        return $this->hasMany(AdjudicationDocumentProgram::class);
    }

    public function court_cases()
    {
        return $this->hasMany(CourtCase::class);
    }

    public function court_personnels()
    {
        return $this->hasMany(CourtPersonnel::class);
    }

    public function missing_pouirrs()
    {
        return $this->hasMany(MissingPouirr::class);
    }
}
