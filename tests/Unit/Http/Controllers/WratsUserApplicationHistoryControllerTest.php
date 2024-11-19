<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\WratsUserApplicationHistoryController;
use PHPUnit\Framework\TestCase;

class WratsUserApplicationHistoryControllerTest extends TestCase
{
    public function testControllerExists()
    {
        $this->assertTrue(class_exists(WratsUserApplicationHistoryController::class));
    }

    public function testControllerExtendsBaseController()
    {
        $controller = new WratsUserApplicationHistoryController;
        $this->assertInstanceOf(\App\Http\Controllers\Controller::class, $controller);
    }
}
