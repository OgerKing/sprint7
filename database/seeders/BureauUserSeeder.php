<?php

namespace Database\Seeders;

use App\Models\BureauUser;
use Illuminate\Database\Seeder;

class BureauUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BureauUser::factory()->create([
            'id' => 1,
            'bureau_id' => 1,
            'gis_duplicate_id' => 1,
            'user_id' => 3,
            'login_name' => 'WRATS_LawClerk_user',
            'created_by' => 'Rguidi',
        ]);
        BureauUser::factory()->create([
            'id' => 2,
            'bureau_id' => 2,
            'gis_duplicate_id' => 2,
            'user_id' => 11,
            'login_name' => 'Monica',
            'created_by' => 'Rguidi',
        ]);
    }
}
