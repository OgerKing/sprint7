<?php

namespace Database\Factories;

use App\Models\Subfile;
use App\Models\SubfileOseWorkSummaryNote;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubfileOseWorkSummaryNoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubfileOseWorkSummaryNote::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'subfile_id' => Subfile::factory(),
            'subfile_ose_work_summary_note' => $this->faker->regexify('[A-Za-z0-9]{2000}'),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
