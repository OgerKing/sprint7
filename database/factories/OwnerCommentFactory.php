<?php

namespace Database\Factories;

use App\Models\OwnerComment;
use App\Models\Person;
use App\Models\PersonEmail;
use App\Models\PersonStatus;
use App\Models\PersonTelephone;
use App\Models\PersonType;
use Illuminate\Database\Eloquent\Factories\Factory;

class OwnerCommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OwnerComment::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'comment' => $this->faker->regexify('[A-Za-z0-9]{4000}'),
            'contact_email_id' => PersonEmail::factory(),
            'person_telephone_id' => PersonTelephone::factory(),
            'person_id' => Person::factory(),
            'person_status_id' => PersonStatus::factory(),
            'person_type_id' => PersonType::factory(),
            'created_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'updated_by' => $this->faker->regexify('[A-Za-z0-9]{64}'),
        ];
    }
}
