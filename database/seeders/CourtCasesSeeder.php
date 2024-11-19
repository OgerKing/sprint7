<?php

namespace Database\Seeders;

use App\Models\CourtCase;
use Illuminate\Database\Seeder;

class CourtCasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        CourtCase::factory()->create([
            'court_id' => 1,
            'case_number' => '66cv 6639 WJ/WPL',
            'case_name' => 'Aamodt Adjudication (Nambe, Pojoaque, Tesuque)
            State of New Mexico ex rel. State Engineer, et al. v. R. Lee Aamodt, et al.,
            United States District Court, 66cv06639,
            Nambe Pojoaque Tesuque Adjudication.',
            'court_docket_link' => 'https://animasadjudication.nmcourts.gov/forms-files-list/#subfile',
            'court_judge_id' => 1,
            'court_master_id' => 2,

        ]);

        CourtCase::factory()->create([
            'court_id' => 2,
            'case_name' => 'Henry P. Anaya, et al. v. Public Service Company of New Mexico, et al. v. State of New Mexico ex rel. S.E. Reynolds, State Engineer,
First Judicial District Court, County of Santa Fe, Cause Nmer: SF No. 43,347,
Santa Fe Stream System Adjudication.',
            'court_judge_id' => null,
            'court_master_id' => null,

        ]);

        CourtCase::factory()->create([
            'court_id' => 1,
            'case_name' => 'Listed as Rito De Tierra Amarilla',
            'court_judge_id' => 3,
            'court_master_id' => null,

        ]);

        //TODO: why do some of these not have a judge id?
        CourtCase::factory()->create([
            'court_id' => 6,
            'case_name' => 'Pecos River',
            'court_judge_id' => null,
            'court_master_id' => null,
        ]);

        CourtCase::factory()->create([
            'court_id' => 6,
            'case_number' => 'CV-WA-01 - 78',
            'case_name' => 'State of New Mexico ex rel State Engineer and Pecos Valley Artesian Conservatory District vs L.T. Lewis et al., United States of America.',
            'court_judge_id' => 11,
            'court_master_id' => null,
        ]);

        CourtCase::factory()->create([
            'court_id' => 1,
            'case_number' => '72cv09780-JEC',
            'case_name' => 'Red River Adjudication 
United States District Court 
For the District of New Mexico 
State of New Mexico on the relation of State Engineer,
and United States of America -v- Molycorp., et al.',
            'court_judge_id' => 13,
            'court_master_id' => 2,
        ]);

        CourtCase::factory()->create([
            'court_id' => 1,
            'case_name' => '"Santa Cruz/Truchas Adjudication
State of New Mexico ex rel. State Engineer v. John Abbott, et al., United States District Court, 68cv07488 and 70cv08650, consolidated, Rio Santa Cruz and Rio de Truchas Adjudication."',
            'court_judge_id' => null,
            'court_master_id' => null,
        ]);

        CourtCase::factory()->create([
            'court_id' => 1,
            'case_number' => '69cv6:69-cv-07941-MV/KK',
            'case_name' => 'State of New Mexico ex rel. State Engineer v. Roman Aragon, et al., 
United States District Court
69cv07941
Rio Chama Adjudication',
            'court_judge_id' => 3,
            'court_master_id' => null,
        ]);

        CourtCase::factory()->create([
            'court_id' => 1,
            'case_number' => '83cv01041- JEC-ACE',
            'case_name' => 'State of New Mexico ex rel. State Engineer v. Tom Abousleman, et al.,
United States District Court, 83cv01041
Rio Jemez Adjudication',
            'court_judge_id' => 13,
            'court_master_id' => 2,
        ]);

        CourtCase::factory()->create([
            'court_id' => 1,
            'case_name' => 'State of New Mexico ex rel. State Engineer, et al., v. Eduardo Abeyta, et al., and Celso Arellano, et al., United States District Court, 69cv07896 and 69cv07939 consolidated,
Rio Pueblo de Taos and Rio Hondo Adjudication.',
            'court_judge_id' => null,
            'court_master_id' => null,
        ]);

        CourtCase::factory()->create([
            'court_id' => 4,
            'case_number' => 'CV 96-888',
            'case_name' => 'State of New Mexico ex rel. New Mexico State Engineer, Plaintiff v. Elephant Butte Irrigation District, et al., Defendants.',
            'court_docket_link' => 'https://lrgadjudication.nmcourts.gov/forms-files-directory/general-case-filings/',
            'court_judge_id' => 10,
            'court_master_id' => null,
        ]);
    }
}
