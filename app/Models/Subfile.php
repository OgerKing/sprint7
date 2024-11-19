<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use App\Enums\DeceasedStatus;
use App\Enums\PersonStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Subfile
 *
 * @property int $id
 * @property int $adjudication_section_id
 * @property int|null $subfile_adjudication_note_id
 * @property int|null $ose_work_summary_note_id
 * @property int|null $basin_nbr_hl
 * @property string|null $basin_section_hl
 * @property float|null $batch
 * @property int|null $file_location_id
 * @property int|null $prev_sub_id
 * @property Carbon|null $print_file
 * @property bool|null $selected
 * @property int|null $sub_file_assigned_ose_attorney_person_id
 * @property Carbon|null $sub_file_end_date
 * @property string|null $sub_file_group
 * @property string|null $sub_file_hl_sfx
 * @property string|null $sub_file_hl_txt
 * @property int|null $sub_file_map_nbr
 * @property int|null $sub_file_parent_id
 * @property float|null $sub_file_sort
 * @property Carbon|null $sub_file_start_date
 * @property int|null $sub_file_type_nbr
 * @property string|null $sub_file_var_sort
 * @property int|null $sub_id_access
 * @property string|null $sub_unk_own
 * @property int|null $subfile_adjudication_status_id
 * @property int|null $verified
 * @property Carbon|null $wrats_status_date
 * @property string|null $wrats_status_doc
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property SubfileAdjudicationNote|null $subfile_adjudication_note
 * @property AdjudicationSection $adjudication_section
 * @property SubfileAdjudicationStatus|null $subfile_adjudication_status
 * @property FileLocation|null $file_location
 * @property SubfileOseWorkSummaryNote|null $subfile_ose_work_summary_note
 * @property Collection|AdjudicationDocument[] $adjudication_documents
 * @property Collection|DefendantDocument[] $defendant_documents
 * @property Collection|GlobalDocument[] $global_documents
 * @property Collection|HydrographicDocument[] $hydrographic_documents
 * @property Collection|SubfileAdjudicationNote[] $subfile_adjudication_notes
 * @property Collection|SubfileAttorneyNote[] $subfile_attorney_notes
 * @property Collection|SubfileClaim[] $subfile_claims
 * @property Collection|CourtCase[] $court_cases
 * @property Collection|SubfileOseWorkSummaryNote[] $subfile_ose_work_summary_notes
 * @property Collection|SubfileUserWatch[] $subfile_user_watches
 * @property Collection|WaterRight[] $water_rights
 * @property Collection|WratsUser[] $wrats_users
 */
class Subfile extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'subfiles';

    protected $casts = [
        'adjudication_section_id' => 'int',
        'subfile_adjudication_note_id' => 'int',
        'ose_work_summary_note_id' => 'int',
        'basin_nbr_hl' => 'int',
        'batch' => 'float',
        'file_location_id' => 'int',
        'prev_sub_id' => 'int',
        'print_file' => 'datetime',
        'selected' => 'bool',
        'sub_file_assigned_ose_attorney_person_id' => 'int',
        'sub_file_end_date' => 'datetime',
        'sub_file_map_nbr' => 'int',
        'sub_file_parent_id' => 'int',
        'sub_file_sort' => 'float',
        'sub_file_start_date' => 'datetime',
        'sub_file_type_nbr' => 'int',
        'sub_id_access' => 'int',
        'subfile_adjudication_status_id' => 'int',
        'verified' => 'int',
        'wrats_status_date' => 'datetime',
    ];

    protected $fillable = [
        'adjudication_section_id',
        'subfile_adjudication_note_id',
        'ose_work_summary_note_id',
        'basin_nbr_hl',
        'basin_section_hl',
        'batch',
        'file_location_id',
        'prev_sub_id',
        'print_file',
        'selected',
        'sub_file_assigned_ose_attorney_person_id',
        'sub_file_end_date',
        'sub_file_group',
        'sub_file_hl_sfx',
        'sub_file_hl_txt',
        'sub_file_map_nbr',
        'sub_file_parent_id',
        'sub_file_sort',
        'sub_file_start_date',
        'sub_file_type_nbr',
        'sub_file_var_sort',
        'sub_id_access',
        'sub_unk_own',
        'subfile_adjudication_status_id',
        'verified',
        'wrats_status_date',
        'wrats_status_doc',
        'created_by',
        'updated_by',
    ];

    public function subfile_adjudication_note()
    {
        return $this->belongsTo(SubfileAdjudicationNote::class);
    }

    public function adjudication_section()
    {
        return $this->belongsTo(AdjudicationSection::class);
    }

    public function subfile_adjudication_status()
    {
        return $this->belongsTo(SubfileAdjudicationStatus::class);
    }

    public function file_location()
    {
        return $this->belongsTo(FileLocation::class);
    }

    public function subfile_ose_work_summary_note()
    {
        return $this->belongsTo(SubfileOseWorkSummaryNote::class, 'ose_work_summary_note_id');
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
        return $this->belongsToMany(GlobalDocument::class, 'global_document_subfiles')
            ->withPivot('id', 'is_deleted', 'created_by', 'updated_by', 'deleted_at')
            ->withTimestamps();
    }

    public function hydrographic_documents()
    {
        return $this->hasMany(HydrographicDocument::class);
    }

    public function subfile_adjudication_notes()
    {
        return $this->hasMany(SubfileAdjudicationNote::class);
    }

    public function subfile_attorney_notes()
    {
        return $this->hasMany(SubfileAttorneyNote::class);
    }

    public function subfile_claims()
    {
        return $this->hasMany(SubfileClaim::class);
    }

    public function court_cases()
    {
        return $this->belongsToMany(CourtCase::class, 'subfile_court_cases')
            ->withPivot('id', 'parent_court_case_id', 'case_number', 'court_case_open_date', 'court_case_close_date', 'created_by', 'updated_by', 'deleted_at')
            ->withTimestamps();
    }

    public function subfile_field_check_notes()
    {
        return $this->hasMany(SubfileFieldCheckNote::class);
    }

    public function subfile_ose_work_summary_notes()
    {
        return $this->hasMany(SubfileOseWorkSummaryNote::class);
    }

    public function people()
    {
        return $this->belongsToMany(Person::class, 'subfile_persons')
            ->withPivot('id', 'person_open_date', 'person_close_date', 'person_status', 'person_type', 'category', 'cert_mail', 'cid_no', 'person_email', 'person_telephone', 'mailing_address_address1', 'mailing_address_address2', 'mailing_address_city', 'mailing_address_county', 'mailing_address_postal_code', 'mailing_address_state', 'attorney_last_name', 'attorney_first_name', 'attorney_middle_initial', 'attorney_title', 'attorney_firm', 'is_authorized_agent', 'is_permittee', 'is_defendant', 'defendant_type_id', 'owner_set', 'person_interest_type_id', 'person_legal_interest_type_id', 'created_by', 'updated_by', 'deleted_at')
            ->withTimestamps();
    }

    public function attorney()
    {
        return $this->belongsTo(Attorney::class, 'sub_file_assigned_ose_attorney_person_id');
    }

    public function subfile_user_watches()
    {
        return $this->hasMany(SubfileUserWatch::class);
    }

    public function water_rights()
    {
        return $this->hasMany(WaterRight::class);
    }

    public function wrats_users()
    {
        return $this->belongsToMany(WratsUser::class, 'wrats_user_subfile_notifications')
            ->withPivot('id', 'file_location_id', 'created_by', 'updated_by')
            ->withTimestamps();
    }

    public function get_appropriate_file_name($subfile_id)
    {
        //subfiles subfile.basin_section_hl - subfile.sub_file_hl_txt (parsed)  - subfile_hl_suffix
        $subfile = Subfile::findOrFail($subfile_id);
        $filename = $subfile->basin_section_hl.'_'.$subfile->sub_file_hl_txt.'_'.$subfile->sub_file_hl_sfx;

        return $filename;
    }

    public function getFormattedSubfileNameAttribute()
    {
        return "{$this->basin_section_hl}_{$this->sub_file_hl_txt}_{$this->sub_file_hl_sfx}";
    }

    /**
     * Defines a one-to-many relationship with SubfileCourtCase.
     *
     * A subfile can have many related court cases.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subfile_court_cases()
    {
        return $this->hasMany(SubfileCourtCase::class);
    }

    /**
     * Defines a many-to-many relationship with Person, filtered for active and non-deceased persons.
     *
     * This returns only persons who are active and not deceased, using the 'subfile_persons' pivot table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function activePersons()
    {
        return $this->belongsToMany(Person::class, 'subfile_persons')
            ->withPivot(
                'person_open_date',
                'person_close_date',
                'person_status',
                'person_type',
                'mailing_address_city',
                'mailing_address_state'
            )
            ->where('person_status_id', PersonStatus::ACTIVE->value)
            ->where('is_deceased', DeceasedStatus::NO->value);
    }

    /**
     * Get all subfile_people associated with the subfile.
     */
    public function subfile_people()
    {
        return $this->hasMany(SubfilePerson::class, 'subfile_id', 'id');
    }
}
