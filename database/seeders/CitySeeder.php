<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\State;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    public const NM_CITIES = [
        'Adelino',
        'Alamogordo',
        'Albuquerque',
        'Algodones',
        'Alma',
        'Angeles',
        'Artesia',
        'Aztec',
        'Belen',
        'Bernalillo',
        'Blanco',
        'Bluewater',
        'Bosque Farms',
        'Boyd',
        'Carlsbad',
        'Cedar Crest',
        'Chama',
        'Chavez',
        'Cimarron',
        'Clovis',
        'Cloudcroft',
        'Columbus',
        'Conchas',
        'Corona',
        'Cuba',
        'Deming',
        'Eagle Nest',
        'Edgewood',
        'Elida',
        'Espanola',
        'Estancia',
        'Farmington',
        'Folsom',
        'Gallup',
        'Grants',
        'Hagerman',
        'Hobbs',
        'Hondo',
        'Jal',
        'Jemez Springs',
        'Jornada',
        'Kirtland',
        'La Landa',
        'La Madera',
        'Laguna',
        'Las Cruces',
        'Las Vegas',
        'Lordsburg',
        'Los Alamos',
        'Los Lunas',
        'Lovington',
        'Luna',
        'Madrid',
        'Malaga',
        'Mimbres',
        'Milton',
        'Montezuma',
        'Moreno Valley',
        'Mountainair',
        'Nara Visa',
        'Navajo',
        'Nogal',
        'North Valley',
        'Peñasco',
        'Portales',
        'Pueblo of Acoma',
        'Pueblo of Cochiti',
        'Pueblo of Isleta',
        'Pueblo of Jemez',
        'Pueblo of Laguna',
        'Pueblo of Nambe',
        'Pueblo of Picuris',
        'Pueblo of Pojoaque',
        'Pueblo of Santa Clara',
        'Pueblo of Taos',
        'Questa',
        'Raton',
        'Red River',
        'Reserve',
        'Rio Communities',
        'Rio Rancho',
        'Roswell',
        'San Juan',
        'San Miguel',
        'Santa Clara',
        'Santa Fe',
        'Silver City',
        'Socorro',
        'Springer',
        'Sunland Park',
        'Taos',
        'Tatum',
        'Truth or Consequences',
        'Tucumcari',
        'Ute Park',
        'Vaughn',
        'Virden',
        'Viva',
        'Wagon Mound',
        'Watrous',
        'Willard',
    ];

    public function run(): void
    {
        $state = 'NM';

        City::factory()
            ->count(count(self::NM_CITIES))
            ->sequence(fn (Sequence $sequence) => ['city_name' => self::NM_CITIES[$sequence->index]])
            ->create(['state_id' => $state]);

        $states = State::query()
            ->whereNot('state_abbreviation', $state)
            ->whereNot('state_abbreviation', 'NULL')
            ->pluck('state_abbreviation')
            ->filter(fn (string $state) => strlen($state) <= 2)
            ->toArray();

        City::factory()
            ->state(new Sequence(
                fn (Sequence $sequence) => ['state_id' => collect($states)->random()],
            ))
            ->count(100)
            ->create();
    }
}
