<?php

namespace Database\Factories;

use App\Models\Subfile;
use App\Models\SubfileAdjudicationNote;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubfileAdjudicationNoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubfileAdjudicationNote::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'subfile_id' => Subfile::factory(),
            'subfile_adjudication_note' => $this->faker->regexify('[A-Za-z0-9]{4000}'),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
