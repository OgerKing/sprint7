<?php

namespace App\Models;

use App\Enums\DeceasedStatus;
use App\Enums\PersonStatus;
use App\Helpers\TooltipHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class WaterRight
 *
 * Represents a water right and its associated relationships and logic.
 *
 * @property int $id
 * @property int $subfile_id
 * @property int $surf_zone_id
 * @property int $water_right_use_id
 * @property int $amount_category_id
 * @property int $water_source_id
 * @property int $hs_recommendation_id
 * @property int $water_right_status_id
 * @property int $right_status_id
 * @property int $purpose_of_use_category_id
 * @property int $specific_purpose_of_use_id
 * @property int $detailed_purpose_of_use_id
 * @property string $hs_recommend
 * @property string $hs_doc_heading
 * @property string $purpose_txt
 * @property string $ose_file
 * @property float $water_duty
 * @property float $div_rt_hl
 * @property float $cfs
 * @property float $con_water_use
 * @property float $surface_area
 * @property float $depth
 * @property float $volume
 * @property string $work_notes
 * @property string $hs_pou_notes
 * @property int|null $no_right
 * @property string $cond
 * @property float $tot_rt_acr
 * @property float $cid_rt_acr
 * @property float $off_rt_acr
 * @property float $off_nr_acr
 * @property int|null $rev_hs_acr
 * @property string $ebid_txt
 * @property int $map_nbr
 * @property float $tx_acres
 * @property float $rt_fdr
 * @property float $rt_prim_gw
 * @property float $annual_evaporative_loss
 * @property string $other_amount_restrictions
 * @property string $offset_indicator
 * @property int $accounting_period_duration
 * @property string $accounting_period_date
 * @property string $right_description
 * @property int $r_id_access
 * @property Carbon|null $created_at
 * @property string $created_by
 * @property Carbon|null $updated_at
 * @property string $updated_by
 * @property string|null $deleted_at
 * @property Subfile $subfile
 * @property AmountCategory $amount_category
 * @property HsRecommendation $hs_recommendation
 * @property WaterRightUse $water_right_us
 * @property WaterSource $water_source
 * @property Collection|GlobalDocument[] $global_documents
 * @property Collection|Pod[] $pods
 * @property Collection|Pou[] $pous
 * @property Collection|WaterRightComment[] $water_right_comments
 */
class WaterRight extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $table = 'water_rights';

    protected $casts = [
        'subfile_id' => 'int',
        'surf_zone_id' => 'int',
        'water_right_use_id' => 'int',
        'amount_category_id' => 'int',
        'water_source_id' => 'int',
        'hs_recommendation_id' => 'int',
        'water_right_status_id' => 'int',
        'right_status_id' => 'int',
        'water_duty' => 'float',
        'div_rt_hl' => 'float',
        'cfs' => 'float',
        'con_water_use' => 'float',
        'surface_area' => 'float',
        'depth' => 'float',
        'volume' => 'float',
        'no_right' => 'int',
        'tot_rt_acr' => 'float',
        'cid_rt_acr' => 'float',
        'off_rt_acr' => 'float',
        'off_nr_acr' => 'float',
        'rev_hs_acr' => 'int',
        'map_nbr' => 'int',
        'tx_acres' => 'float',
        'rt_fdr' => 'float',
        'rt_prim_gw' => 'float',
        'annual_evaporative_loss' => 'float',
        'accounting_period_duration' => 'int',
        'r_id_access' => 'int',
        'updated_at' => 'datetime',
    ];

    protected $fillable = [
        'subfile_id',
        'surf_zone_id',
        'water_right_use_id',
        'amount_category_id',
        'water_source_id',
        'hs_recommendation_id',
        'water_right_status_id',
        'right_status_id',
        'purpose_of_use_category_id',
        'specific_purpose_of_use_id',
        'detailed_purpose_of_use_id',
        'hs_recommend',
        'hs_doc_heading',
        'purpose_txt',
        'ose_file',
        'water_duty',
        'amount_txt',
        'div_rt_hl',
        'cfs',
        'con_water_use',
        'surface_area',
        'depth',
        'volume',
        'work_notes',
        'hs_pou_notes',
        'no_right',
        'cond',
        'tot_rt_acr',
        'cid_rt_acr',
        'off_rt_acr',
        'off_nr_acr',
        'rev_hs_acr',
        'ebid_txt',
        'map_nbr',
        'tx_acres',
        'rt_fdr',
        'rt_prim_gw',
        'annual_evaporative_loss',
        'other_amount_restrictions',
        'offset_indicator',
        'accounting_period_duration',
        'accounting_period_date',
        'right_description',
        'r_id_access',
        'created_by',
        'updated_by',
    ];

    /**
     * Defines the relationship to the subfile model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function subfile()
    {
        return $this->belongsTo(Subfile::class);
    }

    /**
     * Defines the relationship to the amount category model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function amount_category()
    {
        return $this->belongsTo(AmountCategory::class);
    }

    /**
     * Defines the relationship to the recommendation model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hs_recommendation()
    {
        return $this->belongsTo(HsRecommendation::class);
    }

    /**
     * Defines the relationship to the water right use model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function water_right_us()
    {
        return $this->belongsTo(WaterRightUse::class, 'water_right_use_id');
    }

    /**
     * Defines the relationship to the water source model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function water_source()
    {
        return $this->belongsTo(WaterSource::class);
    }

    /**
     * Defines the relationship to the global documents associated with the water right.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function global_documents()
    {
        return $this->belongsToMany(GlobalDocument::class, 'global_document_water_rights')
            ->withPivot('id', 'is_deleted', 'created_by', 'updated_by', 'deleted_at')
            ->withTimestamps();
    }

    /**
     * Defines the relationship to the PODs associated with the water right.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pods()
    {
        return $this->belongsToMany(Pod::class, 'pod_water_rights')
            ->withPivot('id', 'acres_pri', 'acre_ft_pri', 'percent_cfs', 'created_by', 'updated_by')
            ->withTimestamps();
    }

    /**
     * Defines the relationship to the POUs associated with the water right.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function pous()
    {
        return $this->belongsToMany(Pou::class, 'pou_water_rights')
            ->withPivot('id', 'priority_date', 'priority_date_text', 'created_by', 'updated_by', 'deleted_at')
            ->withTimestamps();
    }

    /**
     * Defines the relationship to the pod water rights.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pod_water_rights()
    {
        return $this->hasMany(PodWaterRight::class);
    }

    /**
     * Defines the relationship to the POU water rights.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pou_water_rights()
    {
        return $this->hasMany(PouWaterRight::class);
    }

    /**
     * Defines the relationship to the comments on the water right.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function water_right_comments()
    {
        return $this->hasMany(WaterRightComment::class);
    }

    public function waters_status(): BelongsTo
    {
        return $this->belongsTo(WatersStatus::class, 'right_status_id');
    }

    /**
     * Defines the relationship to the active persons associated with this water right.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function activePersons()
    {
        return $this->hasManyThrough(Person::class, SubfilePerson::class, 'subfile_id', 'id', 'subfile_id', 'person_id')
            ->where('persons.person_status_id', PersonStatus::ACTIVE->value)
            ->where('persons.is_deceased', DeceasedStatus::NO->value);
    }

    /**
     * Format the Water Right ID based on associated PODs and POUs.
     */
    public function formatRightID(): string
    {
        $pod = $this->pods->first();

        if ($pod) {
            $suffix = $pod->pod_suffix ? '/'.$pod->pod_suffix : '';

            return "{$pod->pod_basin}/{$pod->pod_nbr}{$suffix}";
        }

        if ($this->pou_water_rights->isNotEmpty()) {
            return '(POU - No Basin/Nbr/Suffix)';
        }

        return 'N/A';
    }

    /**
     * Truncate the purpose text for display.
     */
    public function truncatePurpose(int $limit = 24): string
    {
        return Str::limit($this->purpose_txt, $limit);
    }

    /**
     * Format subfile details for the water right.
     */
    public function formatSubfileDetails(): string
    {
        if (! $this->subfile) {
            return 'N/A';
        }

        return strtoupper(
            $this->subfile->basin_section_hl.'-'.
            $this->subfile->sub_file_hl_txt.'-'.
            $this->subfile->subfile_hl_suffix.'/'.
            ($this->hs_doc_heading ?? 'N/A')
        );
    }

    /**
     * Format active persons for display with a tooltip for multiple persons.
     */
    public function formatActivePersons(): string
    {
        $activePersons = $this->activePersons()->get();
        $firstPerson = $activePersons->first();
        $personCount = $activePersons->count();

        if (! $firstPerson) {
            return 'N/A';
        }

        $personDisplay = $firstPerson->first_name.' '.$firstPerson->last_name;

        if ($personCount > 1) {
            $remainingPersons = $activePersons->slice(1)
                ->map(fn ($person) => $person->first_name.' '.$person->last_name)
                ->toArray();

            return TooltipHelper::generateTooltip($personDisplay, $remainingPersons);
        }

        return $personDisplay;
    }
}
