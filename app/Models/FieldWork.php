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
 * Class FieldWork
 *
 * @property int $id
 * @property string $field_work_code
 * @property string $field_work_description
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Collection|ClaimFieldCheck[] $claim_field_checks
 */
class FieldWork extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'field_works';

    protected $fillable = [
        'field_work_code',
        'field_work_description',
        'created_by',
        'updated_by',
    ];

    public function claim_field_checks()
    {
        return $this->hasMany(ClaimFieldCheck::class);
    }
}
