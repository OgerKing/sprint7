<?php

namespace Database\Factories;

use App\Models\Pod;
use App\Models\PodComment;
use Illuminate\Database\Eloquent\Factories\Factory;

class PodCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PodComment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'pod_comment_date' => $this->faker->date(),
            'pod_comment_description' => $this->faker->regexify('[A-Za-z0-9]{250}'),
            'pod_comment_resource' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'pod_comment_type' => $this->faker->regexify('[A-Za-z0-9]{36}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'work_notes' => $this->faker->regexify('[A-Za-z0-9]{100}'),
            'pod_id' => Pod::factory(),
        ];
    }
}
