<?php

namespace Tests\Unit\Livewire\Components;

use App\Livewire\Components\CourtsAndJudgesFormHtml;
use PHPUnit\Framework\TestCase;

class CourtsAndJudgesFormHtmlTest extends TestCase
{
    public function testComponentExists()
    {
        $this->assertTrue(class_exists(CourtsAndJudgesFormHtml::class));
    }

    public function testComponentIsLivewireComponent()
    {
        $component = new CourtsAndJudgesFormHtml;
        $this->assertInstanceOf(\Livewire\Component::class, $component);
    }

    public function testComponentHasRenderMethod()
    {
        $component = new CourtsAndJudgesFormHtml;
        $this->assertTrue(method_exists($component, 'render'));
    }
}
