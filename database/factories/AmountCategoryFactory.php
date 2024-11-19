<?php

namespace Database\Factories;

use App\Models\AmountCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class AmountCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AmountCategory::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'amt_cfs' => $this->faker->numberBetween(-8, 8),
            'amt_cir' => $this->faker->numberBetween(-8, 8),
            'amt_con_use' => $this->faker->numberBetween(-8, 8),
            'amt_depth' => $this->faker->numberBetween(-8, 8),
            'amt_div_rt_hl' => $this->faker->numberBetween(-8, 8),
            'amt_fdr' => $this->faker->numberBetween(-8, 8),
            'amt_pdr' => $this->faker->numberBetween(-8, 8),
            'amt_surf_area' => $this->faker->numberBetween(-8, 8),
            'amt_txt' => $this->faker->numberBetween(-8, 8),
            'amt_type_desc' => $this->faker->regexify('[A-Za-z0-9]{50}'),
            'amt_type_id' => $this->faker->regexify('[A-Za-z0-9]{5}'),
            'amt_volume' => $this->faker->numberBetween(-8, 8),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
