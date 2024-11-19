<?php

namespace Database\Factories;

use App\Models\Attorney;
use App\Models\AttorneyList;
use App\Models\AttorneyListing;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttorneyListingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AttorneyListing::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'attorney_id' => Attorney::factory(),
            'attorney_list_id' => AttorneyList::factory(),
        ];
    }
}
