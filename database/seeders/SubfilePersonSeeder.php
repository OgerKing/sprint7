<?php

namespace Database\Seeders;

use App\Models\PersonStatus;
use App\Models\PersonType;
use App\Models\PersonTypeSubtype;
use App\Models\Subfile;
use App\Models\SubfilePerson;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class SubfilePersonSeeder extends Seeder
{
    public function run(): void
    {
        $factory = SubfilePerson::factory()
            ->recycle(PersonType::all())
            ->recycle(PersonTypeSubtype::all())
            ->recycle(PersonStatus::all());

        $factory->count(9)->create();

        $subfiles = Subfile::all();
        $factory
            ->count($subfiles->count())
            ->sequence(fn (Sequence $sequence) => [
                'subfile_id' => $subfiles[$sequence->index]->id,
            ])
            ->create();
    }
}
