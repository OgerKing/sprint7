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
 * Class GlobalDocumentType
 *
 * @property int $id
 * @property string $global_document_type_description
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|GlobalDocument[] $global_documents
 */
class GlobalDocumentType extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'global_document_types';

    protected $fillable = [
        'global_document_type_description',
        'created_by',
        'updated_by',
    ];

    public function global_documents()
    {
        return $this->hasMany(GlobalDocument::class);
    }
}
