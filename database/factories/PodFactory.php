<?php

namespace Database\Factories;

use App\Models\Pod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Pod>
 */
final class PodFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Pod::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            's_type_cat' => fake()->randomLetter(),
            'pod_name' => fake()->word,
            'pod_subfile' => fake()->word,
            'pod_map_txt' => fake()->word,
            'pod_tract_txt' => fake()->word,
            'qtr_4th' => fake()->randomLetter(),
            'qtr_16th' => fake()->randomLetter(),
            'qtr_64th' => fake()->randomLetter(),
            'sub_sec_txt' => fake()->word,
            'sec' => fake()->randomLetter(),
            'tws' => fake()->randomLetter(),
            'rng' => fake()->randomLetter(),
            'x' => fake()->randomFloat(),
            'y' => fake()->randomFloat(),
            'xy_datum' => fake()->randomLetter(),
            'xy_unit_of_measure' => fake()->randomLetter(),
            'zone' => fake()->randomLetter(),
            'map_id_desc' => fake()->word,
            'f_photo_nbr' => fake()->word,
            'well_define' => 2,
            'pod_loc_date' => fake()->dateTime(),
            'pod_loc_time' => fake()->dateTime(),
            'plss_description' => fake()->word,
            'crew_nbr' => 2,
            'point_qual' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'std_dev' => fake()->randomFloat(),
            'pod_basin' => fake()->randomLetter(),
            'pod_nbr' => '12345',
            'pod_suffix' => 'lkjl',
            'ose_file' => fake()->word,
            'pod_hl_txt' => fake()->word,
            'pod_field_no' => substr(fake()->word, 0, 10),
            'lot' => fake()->word,
            'pod_location_description' => fake()->word,
            'waters_pod_id' => fake()->word,
            's_id_access' => fake()->randomNumber(),
            'selected' => fake()->optional()->randomNumber(1),
            'map_qtr' => fake()->randomLetter(),
            'lat_deg' => fake()->randomFloat(4, 0, 9999),
            'lat_min' => fake()->randomFloat(4, 0, 9999),
            'lat_sec' => fake()->randomFloat(4, 0, 9999),
            'lon_deg' => fake()->randomFloat(4, 0, 9999),
            'lon_min' => fake()->randomFloat(4, 0, 9999),
            'lon_sec' => fake()->randomFloat(4, 0, 9999),
            'location_data_source' => fake()->word,
            'arcgis_processing_id' => \App\Models\ArcgisProcessing::factory(),
            'pod_type_id' => 1, //\App\Models\PodType::factory(),
            'created_by' => fake()->word,
            'updated_by' => fake()->word,
        ];
    }
}
