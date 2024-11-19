<?php

namespace Database\Factories;

use App\Models\Attorney;
use App\Models\ClaimResolution;
use App\Models\ClaimStatus;
use App\Models\ClaimType;
use App\Models\Resource;
use App\Models\Subfile;
use App\Models\SubfileClaim;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubfileClaimFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SubfileClaim::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'subfile_id' => Subfile::factory(),
            'claim_title' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'claim_type_id' => ClaimType::factory(),
            'claim_status_id' => ClaimStatus::factory(),
            'claim_person' => $this->faker->numberBetween(-100000, 100000),
            'claim_open_date' => $this->faker->dateTime(),
            'claim_close_date' => $this->faker->dateTime(),
            'claim_resolution_id' => ClaimResolution::factory(),
            'court_eo' => $this->faker->numberBetween(-8, 8),
            'resources_id' => Resource::factory(),
            'attorney_id' => Attorney::factory(),
            'subfile_claim_explanation' => $this->faker->regexify('[A-Za-z0-9]{8000}'),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
