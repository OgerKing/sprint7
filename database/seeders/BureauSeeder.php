<?php

namespace Database\Seeders;

use App\Models\Bureau;
use Illuminate\Database\Seeder;

class BureauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bureau::factory()->create([
            'id' => 1,
            'bureau_name' => 'Northern New Mexico/Pecos',
            'created_by' => 'Rguidi',
        ]);

        Bureau::factory()->create([
            'id' => 2,
            'bureau_name' => 'Lower Rio Grande',
            'created_by' => 'Rguidi',
        ]);

        Bureau::factory()->create([
            'id' => 3,
            'bureau_name' => 'Pueblos, Tribes & Nations',
            'created_by' => 'Rguidi',
        ]);
    }
}
