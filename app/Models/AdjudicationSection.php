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
 * Class AdjudicationSection
 *
 * @property int $id
 * @property int $adjudication_id
 * @property string $adjudication_section_name
 * @property string|null $prefix
 * @property int $adjudication_section_type_id
 * @property string|null $boundary_name
 * @property int $adjudication_section_status_id
 * @property int|null $water_source_id
 * @property string|null $basin_section
 * @property bool|null $extra_sub_file_tab
 * @property bool|null $show_estate
 * @property string|null $program
 * @property Carbon|null $is_deleted
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property Adjudication $adjudication
 * @property AdjudicationSectionType $adjudication_section_type
 * @property AdjudicationSectionStatus $adjudication_section_status
 * @property Collection|AdjudicationDocumentProgram[] $adjudication_document_programs
 * @property Collection|ArcgisProcessing[] $arcgis_processings
 * @property Collection|Condition[] $conditions
 * @property Collection|CourtCase[] $court_cases
 * @property Collection|QuarterReportSortOrder[] $quarter_report_sort_orders
 * @property Collection|Subfile[] $subfiles
 */
class AdjudicationSection extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'adjudication_sections';

    protected $casts = [
        'adjudication_id' => 'int',
        'adjudication_section_type_id' => 'int',
        'adjudication_section_status_id' => 'int',
        'water_source_id' => 'int',
        'extra_sub_file_tab' => 'bool',
        'show_estate' => 'bool',
        'is_deleted' => 'datetime',
    ];

    protected $fillable = [
        'adjudication_id',
        'adjudication_section_name',
        'prefix',
        'adjudication_section_type_id',
        'boundary_name',
        'adjudication_section_status_id',
        'water_source_id',
        'basin_section',
        'extra_sub_file_tab',
        'show_estate',
        'program',
        'is_deleted',
        'created_by',
        'updated_by',
    ];

    public function adjudication()
    {
        return $this->belongsTo(Adjudication::class);
    }

    public function adjudication_section_type()
    {
        return $this->belongsTo(AdjudicationSectionType::class);
    }

    public function adjudication_section_status()
    {
        return $this->belongsTo(AdjudicationSectionStatus::class);
    }

    public function adjudication_document_programs()
    {
        return $this->hasMany(AdjudicationDocumentProgram::class, 'adjudication_sections_id');
    }

    public function arcgis_processings()
    {
        return $this->hasMany(ArcgisProcessing::class);
    }

    public function conditions()
    {
        return $this->hasMany(Condition::class);
    }

    public function court_cases()
    {
        return $this->belongsToMany(CourtCase::class, 'court_case_adjudication_sections')
            ->withPivot('id', 'created_by', 'updated_by')
            ->withTimestamps();
    }

    public function quarter_report_sort_orders()
    {
        return $this->hasMany(QuarterReportSortOrder::class, 'adjudications_section_id');
    }

    public function subfiles()
    {
        return $this->hasMany(Subfile::class);
    }

    public function water_source()
    {
        return $this->belongsTo(WaterSource::class);
    }

    public function subsections()
    {
        return $this->hasMany(AdjudicationSubsection::class, 'parent_adjudication_subsection_id');
    }

    public function parentSubsection()
    {
        return $this->hasOne(AdjudicationSubsection::class, 'child_adjudication_subsection_id');
    }

    public function associateWithParent($parentSectionId, $userId)
    {

        $now = Carbon::now()->format('Y-m-d H:i:s'); //get current date and time

        // Check if an existing specific parent-child section relationship exists.

        //we can use $this->id without explicitly naming it because in the form we have created the section and this associateWithParent relationship is within that section's scope

        $subsection = AdjudicationSubsection::where('child_adjudication_subsection_id', $this->id)->first();

        if ($parentSectionId) {
            //if a parent ID is provided, either update or create the relationship
            if ($subsection) {
                //update existing relationship
                $subsection->update([
                    'parent_adjudication_subsection_id' => $parentSectionId,
                    'updated_by' => $userId,
                    'updated_at' => $now,
                ]);
            } else {
                // Create a new relationship
                $this->parentSubsection()->create([
                    'parent_adjudication_subsection_id' => $parentSectionId,
                    'child_adjudication_subsection_id' => $this->id,
                    'created_by' => $userId,
                    'updated_by' => $userId,
                ]);
            }
        } else {
            // If the parent ID is null, delete the existing relationship
            if ($subsection) {
                //Note: Soft deletes were keeping this relationshp in the adjudication_subsections table, using forceDelete to remove the relationship. With the row still in the db, it was not allowing the section to reappear as a normal section in the table.
                $subsection->forceDelete();
            }
        }
    }

    public function isParent()
    {
        return $this->subsections()->exists();
    }

    public function isChild()
    {
        return $this->parentSubsection()->exists();
    }
}
