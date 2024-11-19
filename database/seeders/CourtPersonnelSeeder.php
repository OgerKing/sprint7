<?php

namespace Database\Seeders;

use App\Models\CourtPersonnel;
use Illuminate\Database\Seeder;

class CourtPersonnelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        CourtPersonnel::factory()->create([
            'court_role_id' => 1,
            'court_id' => 1,
            'first_name' => 'William',
            'last_name' => 'Johnson',
            'created_by' => 'Rguidi',
        ]);
        CourtPersonnel::factory()->create([
            'court_role_id' => 3,
            'court_id' => 1,
            'first_name' => 'Pierre',
            'last_name' => 'Levy',
            'created_by' => 'Rguidi',
        ]);
        CourtPersonnel::factory()->create([
            'court_role_id' => 1,
            'court_id' => 1,
            'first_name' => 'Bruce',
            'last_name' => 'Black',
            'created_by' => 'Rguidi',
        ]);
        CourtPersonnel::factory()->create([
            'court_role_id' => 3,
            'court_id' => 1,
            'first_name' => 'Vickie',
            'last_name' => 'Gabin',
            'created_by' => 'Rguidi',
        ]);
        CourtPersonnel::factory()->create([
            'court_role_id' => 1,
            'court_id' => 1,
            'first_name' => 'Kea',
            'last_name' => 'Riggs',
            'created_by' => 'Rguidi',
        ]);
        CourtPersonnel::factory()->create([
            'court_role_id' => 2,
            'court_id' => 1,
            'first_name' => 'Kirtan',
            'last_name' => 'Khalsa',
            'created_by' => 'Rguidi',
        ]);
        CourtPersonnel::factory()->create([
            'court_role_id' => 4,
            'court_id' => 7,
            'first_name' => 'James',
            'last_name' => 'Wechsler',
            'created_by' => 'Rguidi',
        ]);
        CourtPersonnel::factory()->create([
            'court_role_id' => 4,
            'court_id' => 7,
            'first_name' => 'Jarod',
            'last_name' => 'Hofacket',
            'created_by' => 'Rguidi',
        ]);
        CourtPersonnel::factory()->create([
            'court_role_id' => 4,
            'court_id' => 4,
            'first_name' => 'Jerald',
            'last_name' => 'Valentine',
            'created_by' => 'Rguidi',
        ]);
        CourtPersonnel::factory()->create([
            'court_role_id' => 5,
            'court_id' => 4,
            'first_name' => 'James',
            'last_name' => 'Wechsler',
            'created_by' => 'Rguidi',
        ]);
        CourtPersonnel::factory()->create([
            'court_role_id' => 5,
            'court_id' => 6,
            'first_name' => 'James',
            'last_name' => 'Wechsler',
            'created_by' => 'Rguidi',
        ]);
        CourtPersonnel::factory()->create([
            'court_role_id' => 4,
            'court_id' => 12,
            'first_name' => 'James',
            'last_name' => 'Wechsler',
            'created_by' => 'Rguidi',
        ]);
        CourtPersonnel::factory()->create([
            'court_role_id' => 1,
            'court_id' => 1,
            'first_name' => 'John',
            'last_name' => 'Conway',
            'created_by' => 'Rguidi',
        ]);
    }
}
