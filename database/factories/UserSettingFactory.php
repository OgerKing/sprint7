<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserSettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserSetting::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        // grab all existing user IDs
        $userIds = User::pluck('id')->toArray();
        $frequencyOptions = ['None', 'Daily', 'Weekly'];

        return [
            'created_by' => $this->faker->name,
            'display_name' => $this->faker->firstName,
            'initials' => $this->faker->stateAbbr, //using stateAbbr just bc it gives us two characters
            'updated_by' => 1, //needs to be a user id at some point
            'watch_subfile_changes_frequency' => $this->faker->randomElement($frequencyOptions),
            'user_id' => $this->faker->randomElement($userIds),
        ];
    }
}
