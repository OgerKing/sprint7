<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class AdjudicationSubsection
 *
 * @property int $id
 * @property int $parent_adjudication_subsection_id
 * @property int $child_adjudication_subsection_id
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 */
class AdjudicationSubsection extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'adjudication_subsections';

    protected $casts = [
        'parent_adjudication_subsection_id' => 'int',
        'child_adjudication_subsection_id' => 'int',
    ];

    protected $fillable = [
        'parent_adjudication_subsection_id',
        'child_adjudication_subsection_id',
        'created_by',
        'updated_by',
    ];

    public function parentSection()
    {
        return $this->belongsTo(AdjudicationSection::class, 'parent_adjudication_subsection_id');
    }

    public function childSection()
    {
        return $this->belongsTo(AdjudicationSection::class, 'child_adjudication_subsection_id');
    }

    public function safe_subsection_parent_list($adjudicationId)
    {
        //Use the adjudicationID to get all adjduication sections associated with that ID. then return only those sections that are either a PARENT or NEITHER A PARENT NOR CHILD. This will populate the dropdown list in a form where we create subsections.
        //Use DISTINCT to make sure each parent section only returns once, even if it has multiple children.

        $safeList = DB::select('
			SELECT DISTINCT adjudication_sections.*
			FROM adjudication_sections
			LEFT JOIN adjudication_subsections AS parent_relation ON adjudication_sections.id = parent_relation.parent_adjudication_subsection_id
			LEFT JOIN adjudication_subsections AS child_relation ON adjudication_sections.id = child_relation.child_adjudication_subsection_id
			WHERE adjudication_sections.adjudication_id = :adjudicationId
			AND child_relation.id IS NULL;
		', ['adjudicationId' => $adjudicationId]);

        return json_encode($safeList);
    }
}
