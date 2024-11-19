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
 * Class Adjudication
 *
 * @property int $id
 * @property string $adjudication_name
 * @property string|null $adjudication_nickname
 * @property int $bureau_id
 * @property int $adjudication_status_id
 * @property int $adjudication_district_id
 * @property string|null $coordinate_system
 * @property string|null $adjudication_boundary_map_link
 * @property string|null $hydrographic_survey_description
 * @property string|null $prefix
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property AdjudicationStatus $adjudication_status
 * @property Bureau $bureau
 * @property AdjudicationDistrict $adjudication_district
 * @property Collection|AdjudicationDocumentProgram[] $adjudication_document_programs
 * @property Collection|AdjudicationSection[] $adjudication_sections
 * @property Collection|GlobalDocument[] $global_documents
 */
class Adjudication extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    protected $table = 'adjudications';

    protected $casts = [
        'bureau_id' => 'int',
        'adjudication_status_id' => 'int',
        'adjudication_district_id' => 'int',
    ];

    protected $fillable = [
        'adjudication_name',
        'adjudication_nickname',
        'bureau_id',
        'adjudication_status_id',
        'adjudication_district_id',
        'coordinate_system',
        'adjudication_boundary_map_link',
        'hydrographic_survey_description',
        'prefix',
        'created_by',
        'updated_by',
        'mapping_zone_central',
        'mapping_zone_west',
        'mapping_zone_east',
    ];

    public function adjudication_status()
    {
        return $this->belongsTo(AdjudicationStatus::class);
    }

    public function bureau()
    {
        return $this->belongsTo(Bureau::class);
    }

    public function adjudication_district()
    {
        return $this->belongsTo(AdjudicationDistrict::class);
    }

    public function adjudication_document_programs()
    {
        return $this->hasMany(AdjudicationDocumentProgram::class);
    }

    public function adjudication_sections()
    {
        return $this->hasMany(AdjudicationSection::class);
    }

    public function global_documents()
    {
        return $this->hasMany(GlobalDocument::class);
    }

    public function getChangelogByDate($date)
    {
        $changelog = $this->getChangelog();

        // Filter the changelog entries by the provided date
        return $changelog->filter(function ($changes, $groupedDate) use ($date) {
            return Carbon::parse($groupedDate)->isSameDay($date);
        });
    }

    public function getChangelog()
    {
        $changelog = [];
        // Get audit records for the Adjudication model
        $adjudicationAudits = $this->audits()->with('user')->get();
        foreach ($adjudicationAudits as $audit) {
            $changelog[] = [
                'description' => 'Adjudication '.$audit->event,
                'changed_by' => $audit->user->name ?? 'System',
                'created_at' => $audit->created_at,
            ];
        }

        // Get audit records for the AdjudicationStatus relationship
        if ($this->adjudication_status) {
            $statusAudits = $this->adjudication_status->audits()->with('user')->get();
            foreach ($statusAudits as $audit) {
                $changelog[] = [
                    'description' => 'Adjudication status '.$audit->event,
                    'changed_by' => $audit->user->name ?? 'System',
                    'created_at' => $audit->created_at,
                ];
            }
        }

        // Get audit records for the Bureau relationship
        if ($this->bureau) {
            $bureauAudits = $this->bureau->audits()->with('user')->get();
            foreach ($bureauAudits as $audit) {
                $changelog[] = [
                    'description' => 'Bureau info updated: '.json_encode($audit->new_values),
                    'changed_by' => $audit->user->name ?? 'System',
                    'created_at' => $audit->created_at,
                ];
            }
        }

        // Get audit records for AdjudicationDocumentProgram relationship
        foreach ($this->adjudication_document_programs as $program) {
            if ($program) { // Ensure the program exists
                $programAudits = $program->audits()->with('user')->get();
                foreach ($programAudits as $audit) {
                    $changelog[] = [
                        'description' => 'Document program '.$audit->event,
                        'changed_by' => $audit->user->name ?? 'System',
                        'created_at' => $audit->created_at,
                    ];
                }
            }
        }

        // Get audit records for AdjudicationSection relationship
        foreach ($this->adjudication_sections as $section) {
            if ($section) {
                $sectionAudits = $section->audits()->with('user')->get();
                foreach ($sectionAudits as $audit) {
                    $changelog[] = [
                        'description' => 'Adjudication Section '.$audit->event,
                        'changed_by' => $audit->user->name ?? 'System',
                        'created_at' => $audit->created_at,
                    ];
                }

                // Include changes from the related CourtCases
                foreach ($section->court_cases as $courtCase) {
                    $courtCaseAudits = $courtCase->audits()->with('user')->get();
                    foreach ($courtCaseAudits as $audit) {
                        $changelog[] = [
                            'description' => 'Court case '.$audit->event,
                            'changed_by' => $audit->user->name ?? 'System',
                            'created_at' => $audit->created_at,
                        ];
                    }
                }
            }
        }

        // Get audit records for GlobalDocument relationship
        foreach ($this->global_documents as $document) {
            if ($document) { // Ensure the document exists
                $documentAudits = $document->audits()->with('user')->get();
                foreach ($documentAudits as $audit) {
                    $changelog[] = [
                        'description' => 'Global document '.$audit->event,
                        'changed_by' => $audit->user->name ?? 'System',
                        'created_at' => $audit->created_at,
                    ];
                }
            }
        }

        $changelog = collect($changelog)->sortByDesc('created_at');

        // Sort and group by date
        // usort($changelog, function ($a, $b) {
        //     return strtotime($b['created_at']) - strtotime($a['created_at']);
        // });

        return collect($changelog)->groupBy(function ($item) {
            return Carbon::parse($item['created_at'])->format('F j');
        });
    }
}
