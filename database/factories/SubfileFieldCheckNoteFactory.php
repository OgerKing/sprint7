<?php

namespace Database\Factories;

use App\Models\Subfile;
use App\Models\SubfileFieldCheckNote;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubfileFieldCheckNoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubfileFieldCheckNote::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'subfile_id' => Subfile::factory(),
            'subfile_field_check_note' => $this->faker->regexify('[A-Za-z0-9]{8000}'),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
