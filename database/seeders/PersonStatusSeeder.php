<?php

namespace Database\Seeders;

use App\Models\PersonStatus;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class PersonStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = ['Unverified', 'Verified', 'Deceased', 'Removed', 'Represented'];

        PersonStatus::factory()
            ->state(new Sequence(
                ...collect($statuses)->map(fn (string $status) => ['person_status_description' => $status])
            ))
            ->count(count($statuses))
            ->create();
    }
}
