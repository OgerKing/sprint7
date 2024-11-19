<?php

namespace Tests\Unit\Livewire\Components;

use App\Livewire\Components\AdjudicationChangelogSidebar;
use Livewire\Livewire;
use Tests\TestCase;

class AdjudicationChangelogSidebarTest extends TestCase
{
    public function test_it_can_be_instantiated()
    {
        $component = Livewire::test(AdjudicationChangelogSidebar::class);
        $this->assertInstanceOf(AdjudicationChangelogSidebar::class, $component->instance());
    }

    public function test_it_has_correct_initial_properties()
    {
        $component = Livewire::test(AdjudicationChangelogSidebar::class);

        $this->assertNull($component->get('adjudication'));

    }

    public function test_it_can_set_adjudication()
    {
        $adjudication = ['id' => 1, 'name' => 'Test Adjudication'];
        $component = Livewire::test(AdjudicationChangelogSidebar::class);
        $component->set('adjudication', $adjudication);
        $this->assertEquals($adjudication, $component->get('adjudication'));
    }
}
