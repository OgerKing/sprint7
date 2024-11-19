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
 * Class DocumentCategory
 *
 * @property int $id
 * @property string $document_category_code
 * @property string $document_category_description
 * @property int $sort
 * @property Carbon|null $is_deleted
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|DocumentType[] $document_types
 */
class DocumentCategory extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'document_categories';

    protected $casts = [
        'sort' => 'int',
        'is_deleted' => 'datetime',
    ];

    protected $fillable = [
        'document_category_code',
        'document_category_description',
        'sort',
        'is_deleted',
        'created_by',
        'updated_by',
    ];

    public function document_types()
    {
        return $this->hasMany(DocumentType::class);
    }
}
