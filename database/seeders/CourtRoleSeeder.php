<?php

namespace Database\Seeders;

use App\Models\CourtRole;
use Illuminate\Database\Seeder;

class CourtRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courtRoleTypes = ['UNITED STATES DISTRICT JUDGE', 'UNITED STATES MAGISTRATE JUDGE', 'SPECIAL MASTER', 'DISTRICT COURT JUDGE', 'DISTRICT JUDGE, PRO TEMPORE', 'PRESIDING JUDGE'];
        foreach ($courtRoleTypes as $role) {
            CourtRole::factory()->create(['court_role' => $role]);
        }
    }
}
