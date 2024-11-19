<?php

namespace Database\Factories;

use App\Models\WratsUserApplicationHistory;
use Illuminate\Database\Eloquent\Factories\Factory;

class WratsUserApplicationHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = WratsUserApplicationHistory::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        //TODO: we do need created_at and updated_at for the grouping to work on the history page
        //List of record_types matching dropdown in My History frontend.
        $recordTypes = ['Subfiles', 'Parties', 'Authorized Agents', 'Water Rights', 'Sources (POD)', 'Places (POU)', 'Documents'];

        $fakerLabel = $this->faker->word;

        return [
            'label' => 'Example Label '.$fakerLabel,
            'parameters' => $this->faker->word,
            'path' => '/example/path/'.$fakerLabel,
            'record_type' => $this->faker->randomElement($recordTypes),
            'users_id' => 1,
            'created_at' => $this->faker->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d H:i:s'),
            'updated_at' => $this->faker->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d H:i:s'),
        ];
    }
}
