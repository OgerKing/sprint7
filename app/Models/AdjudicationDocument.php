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
 * Class AdjudicationDocument
 *
 * @property int $id
 * @property int $subfile_id
 * @property string $adjudication_document_code
 * @property string $adjudication_document_title
 * @property int $document_type_id
 * @property Carbon|null $document_filing_date
 * @property string|null $attachment_URL
 * @property string|null $attachment_file_path
 * @property Carbon|null $is_deleted
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property DocumentType $document_type
 * @property Subfile $subfile
 * @property Collection|AdjudicationDocumentProgram[] $adjudication_document_programs
 */
class AdjudicationDocument extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'adjudication_documents';

    protected $casts = [
        'subfile_id' => 'int',
        'document_type_id' => 'int',
        'document_filing_date' => 'datetime',
        'is_deleted' => 'datetime',
    ];

    protected $fillable = [
        'subfile_id',
        'adjudication_document_code',
        'adjudication_document_title',
        'document_type_id',
        'document_filing_date',
        'attachment_URL',
        'attachment_file_path',
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

    public function adjudication_document_programs()
    {
        return $this->hasMany(AdjudicationDocumentProgram::class);
    }
}
