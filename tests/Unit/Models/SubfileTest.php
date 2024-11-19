<?php

namespace Tests\Unit\Models;

use App\Models\Subfile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubfileTest extends TestCase
{
    use RefreshDatabase;

    public function testGetAppropriateFileNameWithValidSubfileId()
    {
        $subfile = Subfile::factory()->create([
            'basin_section_hl' => 'Basin1',
            'sub_file_hl_txt' => 'Section2',
            'sub_file_hl_sfx' => 'Suffix3',
        ]);

        $result = $subfile->get_appropriate_file_name($subfile->id);

        $this->assertEquals('Basin1_Section2_Suffix3', $result);
    }

    public function testGetAppropriateFileNameWithNonExistentSubfileId()
    {
        $this->expectException(\Illuminate\Database\Eloquent\ModelNotFoundException::class);

        $nonExistentId = 9999;
        $subfile = new Subfile;
        $subfile->get_appropriate_file_name($nonExistentId);
    }

    public function testGetAppropriateFileNameWithEmptyFields()
    {
        $subfile = Subfile::factory()->create([
            'basin_section_hl' => '',
            'sub_file_hl_txt' => '',
            'sub_file_hl_sfx' => '',
        ]);

        $result = $subfile->get_appropriate_file_name($subfile->id);

        $this->assertEquals('__', $result);
    }
}
