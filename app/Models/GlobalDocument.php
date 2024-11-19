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
 * Class GlobalDocument
 *
 * @property int $id
 * @property int|null $adjudication_id
 * @property string|null $global_document_title
 * @property Carbon|null $document_filing_date
 * @property string|null $attachment_URL
 * @property string|null $attachment_file_path
 * @property int|null $global_document_type_id
 * @property string|null $docket_id
 * @property string|null $global_desc
 * @property int|null $global_id_access
 * @property Carbon|null $is_deleted
 * @property Carbon|null $created_at
 * @property string|null $created_by
 * @property Carbon|null $updated_at
 * @property string|null $updated_by
 * @property string|null $deleted_at
 * @property DocumentType|null $document_type
 * @property Collection|Person[] $people
 * @property Collection|GlobalDocumentPOD[] $global_document_p_o_ds
 * @property Collection|GlobalDocumentPOU[] $global_document_p_o_us
 * @property Collection|Subfile[] $subfiles
 * @property Collection|WaterRight[] $water_rights
 */
class GlobalDocument extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'global_documents';

    protected $casts = [
        'adjudication_id' => 'int',
        'document_filing_date' => 'datetime',
        'global_document_type_id' => 'int',
        'global_id_access' => 'int',
        'is_deleted' => 'datetime',
    ];

    protected $fillable = [
        'adjudication_id',
        'global_document_title',
        'document_filing_date',
        'attachment_URL',
        'attachment_file_path',
        'global_document_type_id',
        'docket_id',
        'global_desc',
        'global_id_access',
        'is_deleted',
        'created_by',
        'updated_by',
    ];

    public function adjudication()
    {
        return $this->belongsTo(Adjudication::class);
    }

    public function document_type()
    {
        return $this->belongsTo(DocumentType::class, 'global_document_type_id');
    }

    public function people()
    {
        return $this->belongsToMany(Person::class, 'global_document_persons')
            ->withPivot('id', 'is_deleted', 'created_by', 'updated_by', 'deleted_at')
            ->withTimestamps();
    }

    public function global_document_p_o_ds()
    {
        return $this->hasMany(GlobalDocumentPOD::class);
    }

    public function global_document_p_o_us()
    {
        return $this->hasMany(GlobalDocumentPOU::class);
    }

    public function points_of_diversion()
    {
        return $this->belongsToMany(POD::class, 'global_document_pods')
            ->withPivot('id', 'is_deleted', 'created_by', 'updated_by', 'deleted_at')
            ->withTimestamps();
    }

    public function places_of_use()
    {
        return $this->belongsToMany(POU::class, 'global_document_pous')
            ->withPivot('id', 'is_deleted', 'created_by', 'updated_by', 'deleted_at')
            ->withTimestamps();
    }

    public function subfiles()
    {
        return $this->belongsToMany(Subfile::class, 'global_document_subfiles')
            ->withPivot('id', 'is_deleted', 'created_by', 'updated_by', 'deleted_at')
            ->withTimestamps();
    }

    public function water_rights()
    {
        return $this->belongsToMany(WaterRight::class, 'global_document_water_rights')
            ->withPivot('id', 'is_deleted', 'created_by', 'updated_by', 'deleted_at')
            ->withTimestamps();
    }
}
