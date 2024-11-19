<?php

namespace Database\Factories;

use App\Models\AdjudicationSection;
use App\Models\FileLocation;
use App\Models\Subfile;
use App\Models\SubfileAdjudicationStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Subfile::class;

    public function definition()
    {
        return [
            'adjudication_section_id' => AdjudicationSection::factory(),
            'subfile_adjudication_note_id' => null,
            //'ose_work_summary_note_id' => \App\Models\SubfileOseWorkSummaryNote::factory(),
            'basin_nbr_hl' => $this->faker->numberBetween(1, 100),
            'basin_section_hl' => $this->faker->lexify('???'),
            'batch' => $this->faker->randomFloat(2, 0, 100),
            'file_location_id' => FileLocation::factory(),
            'prev_sub_id' => null,
            'print_file' => $this->faker->dateTimeThisYear(),
            'selected' => $this->faker->boolean,
            'sub_file_assigned_ose_attorney_person_id' => null,
            'sub_file_end_date' => $this->faker->dateTimeThisYear(),
            'sub_file_group' => $this->faker->word,
            'sub_file_hl_sfx' => $this->faker->lexify('??'),
            'sub_file_hl_txt' => $this->faker->word,
            'sub_file_map_nbr' => $this->faker->numberBetween(1, 1000),
            'sub_file_parent_id' => null,
            'sub_file_sort' => $this->faker->randomFloat(2, 0, 100),
            'sub_file_start_date' => $this->faker->dateTimeThisYear(),
            'sub_file_type_nbr' => $this->faker->numberBetween(1, 10),
            'sub_file_var_sort' => $this->faker->word,
            'sub_id_access' => $this->faker->numberBetween(1, 1000),
            'sub_unk_own' => $this->faker->text(5),
            'subfile_adjudication_status_id' => SubfileAdjudicationStatus::factory(),
            'verified' => $this->faker->numberBetween(0, 1),
            'wrats_status_date' => $this->faker->dateTimeThisYear(),
            'wrats_status_doc' => $this->faker->word,
            'created_by' => $this->faker->userName,
            'updated_by' => $this->faker->userName,
        ];
    }
}
