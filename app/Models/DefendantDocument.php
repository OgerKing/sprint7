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
 * Class DefendantDocument
 *
 * @property int $id
 * @property string $document_title
 * @property int $subfile_id
 * @property int|null $person_id
 * @property Carbon|null $document_filing_date
 * @property string|null $attachment_URL
 * @property string|null $attachment_file_path
 * @property int $document_type_id
 * @property int|null $defendant
 * @property string|null $docket_id
 * @property Carbon|null $is_deleted
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property string|null $deleted_at
 * @property DocumentType $document_type
 * @property Subfile $subfile
 * @property Collection|Person[] $people
 */
class DefendantDocument extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'defendant_documents';

    protected $casts = [
        'subfile_id' => 'int',
        'person_id' => 'int',
        'document_filing_date' => 'datetime',
        'document_type_id' => 'int',
        'defendant' => 'int',
        'is_deleted' => 'datetime',
    ];

    protected $fillable = [
        'document_title',
        'subfile_id',
        'person_id',
        'document_filing_date',
        'attachment_URL',
        'attachment_file_path',
        'document_type_id',
        'defendant',
        'docket_id',
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
        return $this->belongsToMany(Person::class, 'defendant_document_persons')
            ->withPivot('id', 'created_by', 'updated_by')
            ->withTimestamps();
    }
}
