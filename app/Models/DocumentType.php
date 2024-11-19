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
 * Class DocumentType
 *
 * @property int $id
 * @property int $document_category_id
 * @property string $document_type_code
 * @property string $document_type_description
 * @property int|null $sort
 * @property Carbon|null $is_deleted
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property DocumentCategory $document_category
 * @property Collection|AdjudicationDocumentProgram[] $adjudication_document_programs
 * @property Collection|AdjudicationDocument[] $adjudication_documents
 * @property Collection|DefendantDocument[] $defendant_documents
 * @property Collection|GlobalDocument[] $global_documents
 * @property Collection|HydrographicDocument[] $hydrographic_documents
 */
class DocumentType extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'document_types';

    protected $casts = [
        'document_category_id' => 'int',
        'sort' => 'int',
        'is_deleted' => 'datetime',
    ];

    protected $fillable = [
        'document_category_id',
        'document_type_code',
        'document_type_description',
        'sort',
        'is_deleted',
        'created_by',
        'updated_by',
    ];

    public function document_category()
    {
        return $this->belongsTo(DocumentCategory::class);
    }

    public function adjudication_document_programs()
    {
        return $this->hasMany(AdjudicationDocumentProgram::class);
    }

    public function adjudication_documents()
    {
        return $this->hasMany(AdjudicationDocument::class);
    }

    public function defendant_documents()
    {
        return $this->hasMany(DefendantDocument::class);
    }

    public function global_documents()
    {
        return $this->hasMany(GlobalDocument::class, 'global_document_type_id');
    }

    public function hydrographic_documents()
    {
        return $this->hasMany(HydrographicDocument::class);
    }
}
