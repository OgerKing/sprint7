<?php

namespace Database\Seeders;

use App\Models\County;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CountySeeder extends Seeder
{
    public const NM_COUNTIES = [
        'AB' => 'Bernalillo',
        'CA' => 'Catron',
        'CH' => 'Chaves',
        'CI' => 'Cibola',
        'CO' => 'Colfax',
        'CU' => 'Curry',
        'DB' => 'De Baca',
        'DA' => 'Dona Ana',
        'ED' => 'Eddy',
        'GR' => 'Grant',
        'GU' => 'Guadalupe',
        'HA' => 'Harding',
        'HI' => 'Hidalgo',
        'LE' => 'Lea',
        'LI' => 'Lincoln',
        'LA' => 'Los Alamos',
        'LU' => 'Luna',
        'MK' => 'McKinley',
        'MO' => 'Mora',
        'OT' => 'Otero',
        'QU' => 'Quay',
        'RA' => 'Rio Arriba',
        'RO' => 'Roosevelt',
        'SA' => 'Sandoval',
        'SJ' => 'San Juan',
        'SM' => 'San Miguel',
        'SF' => 'Santa Fe',
        'SI' => 'Sierra',
        'SO' => 'Socorro',
        'TA' => 'Taos',
        'TO' => 'Torrance',
        'UN' => 'Union',
        'VA' => 'Valencia',
        'WA' => 'Warren',
    ];

    public function run(): void
    {
        $nm = State::query()->where('state_abbreviation', 'NM')->firstOrFail();

        County::factory()
            ->recycle($nm)
            ->count(count(self::NM_COUNTIES))
            ->sequence(fn (Sequence $sequence) => [
                'county' => collect(self::NM_COUNTIES)->keys()[$sequence->index],
                'county_name' => collect(self::NM_COUNTIES)->values()[$sequence->index],
            ])
            ->create();
    }
}
