<?php

namespace Database\Seeders;

use App\Models\Court;
use Illuminate\Database\Seeder;

class CourtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Court::factory()->create([
            'court_name' => 'US District Court',
            'court_jurisdiction' => 'District of New Mexico',
            'court_type' => 'Federal',
            'created_by' => 'RGuidi',
        ]);
        Court::factory()->create([
            'court_name' => 'State of New Mexico First Judicial District',
            'court_jurisdiction' => 'Los Alamos County, Rio Arriba County & Santa Fe County',
            'court_type' => 'State',
            'created_by' => 'RGuidi',
        ]);
        Court::factory()->create([
            'court_name' => 'State of New Mexico Second Judicial District',
            'court_jurisdiction' => 'Bernalillo County',
            'court_type' => 'State',
            'created_by' => 'RGuidi',
        ]);
        Court::factory()->create([
            'court_name' => 'State of New Mexico Third Judicial District',
            'court_jurisdiction' => 'Dona Ana County',
            'court_type' => 'State',
            'created_by' => 'RGuidi',
        ]);
        Court::factory()->create([
            'court_name' => 'State of New Mexico Fourth Judicial District',
            'court_jurisdiction' => 'Guadalupe County, Mora County & San Miguel County',
            'court_type' => 'State',
            'created_by' => 'RGuidi',
        ]);
        Court::factory()->create([
            'court_name' => 'State of New Mexico Fifth Judicial District',
            'court_jurisdiction' => 'Chaves County, Eddy County & Lea County',
            'court_type' => 'State',
            'created_by' => 'RGuidi',
        ]);
        Court::factory()->create([
            'court_name' => 'State of New Mexico Sixth Judicial District',
            'court_jurisdiction' => 'Grant County, Hidalgo County & Luna County',
            'court_type' => 'State',
            'created_by' => 'RGuidi',
        ]);
        Court::factory()->create([
            'court_name' => 'State of New Mexico Seventh Judicial District',
            'court_jurisdiction' => 'Catron County, Sierra County, Socorro County & Torrance County',
            'court_type' => 'State',
            'created_by' => 'RGuidi',
        ]);
        Court::factory()->create([
            'court_name' => 'State of New Mexico Eighth Judicial District',
            'court_jurisdiction' => 'Colfax County, Taos County & Union County',
            'court_type' => 'State',
            'created_by' => 'RGuidi',
        ]);
        Court::factory()->create([
            'court_name' => 'State of New Mexico Ninth Judicial District',
            'court_jurisdiction' => 'Curry County & Roosevelt County',
            'court_type' => 'State',
            'created_by' => 'RGuidi',
        ]);
        Court::factory()->create([
            'court_name' => 'State of New Mexico Tenth Judicial District',
            'court_jurisdiction' => 'De Baca County, Harding County & Quay County',
            'court_type' => 'State',
            'created_by' => 'RGuidi',
        ]);
        Court::factory()->create([
            'court_name' => 'State of New Mexico Eleventh Judicial District',
            'court_jurisdiction' => 'McKinley County & San Juan County',
            'court_type' => 'State',
            'created_by' => 'RGuidi',
        ]);
        Court::factory()->create([
            'court_name' => 'State of New Mexico Twelfth Judicial District',
            'court_jurisdiction' => 'Lincoln County & Otero County',
            'court_type' => 'State',
            'created_by' => 'RGuidi',
        ]);
        Court::factory()->create([
            'court_name' => 'State of New Mexico Thirteenth Judicial District',
            'court_jurisdiction' => 'Cibola County, Sandoval County & Valencia County',
            'court_type' => 'State',
            'created_by' => 'RGuidi',
        ]);
    }
}
