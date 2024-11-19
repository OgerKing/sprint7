<?php

namespace Tests\Unit;

use App\Livewire\CourtsAndJudgesPowergrid;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CourtsAndJudgesPowergridTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_set_up_the_component()
    {

        $component = new CourtsAndJudgesPowergrid;
        $setup = $component->setUp();

        $this->assertIsArray($setup);

    }
}
