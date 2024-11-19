<?php

namespace Database\Factories;

use App\Models\County;
use App\Models\PouComment;
use App\Models\PouGlobalDocument;
use App\Models\PouStatus;
use App\Models\PouWaterRight;
use App\Models\WaterRight;
use App\Models\WaterRightGlobalDocument;
use Illuminate\Database\Eloquent\Factories\Factory;

class PouWaterRightFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PouWaterRight::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'county_id' => County::factory(),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'pou_comments_id' => PouComment::factory(),
            'pou_global_documents_id' => PouGlobalDocument::factory(),
            'pou_status_id' => PouStatus::factory(),
            'priority_date_id' => $this->faker->randomNumber(),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'water_right_global_documents_id' => WaterRightGlobalDocument::factory(),
            'water_right_id' => WaterRight::factory(),
        ];
    }
}
