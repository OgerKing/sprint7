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
 * Class HydrographicDocument
 *
 * @property int $id
 * @property int $subfile_id
 * @property string $hydrographic_document_title
 * @property Carbon|null $hydrographic_document_filing_date
 * @property string|null $attachment_URL
 * @property string|null $attachment_file_path
 * @property int $document_type_id
 * @property string|null $hydrographic_document_owner
 * @property string|null $hydrographic_document_owner_status
 * @property string|null $hydrographic_document_owner_type
 * @property Carbon|null $is_deleted
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property DocumentType $document_type
 * @property Subfile $subfile
 * @property Collection|Person[] $people
 */
class HydrographicDocument extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'hydrographic_documents';

    protected $casts = [
        'subfile_id' => 'int',
        'hydrographic_document_filing_date' => 'datetime',
        'document_type_id' => 'int',
        'is_deleted' => 'datetime',
    ];

    protected $fillable = [
        'subfile_id',
        'hydrographic_document_title',
        'hydrographic_document_filing_date',
        'attachment_URL',
        'attachment_file_path',
        'document_type_id',
        'hydrographic_document_owner',
        'hydrographic_document_owner_status',
        'hydrographic_document_owner_type',
        'is_deleted',
        'created_by',
        'updated_by',
    ];

    public function document_type()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function subfile()
    {
        return $this->belongsTo(Subfile::class);
    }

    public function people()
    {
        return $this->belongsToMany(Person::class, 'hydrographic_document_persons')
            ->withPivot('id', 'created_by', 'updated_by', 'deleted_at')
            ->withTimestamps();
    }
}
