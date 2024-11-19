<?php

namespace Tests\Unit;

use App\Livewire\AdjudicationDocumentRecordsListPowergrid;
use App\Models\AdjudicationDocument;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AdjudicationDocumentRecordsListPowergridTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_render_the_powergrid_component()
    {
        Livewire::test(AdjudicationDocumentRecordsListPowergrid::class)
            ->assertStatus(200);
    }

    #[Test]
    public function it_has_correct_datasource()
    {
        $component = new AdjudicationDocumentRecordsListPowergrid;
        $datasource = $component->datasource();

        $this->assertInstanceOf(\Illuminate\Database\Eloquent\Builder::class, $datasource);
        $this->assertEquals(AdjudicationDocument::class, $datasource->getModel()::class);
    }
}
