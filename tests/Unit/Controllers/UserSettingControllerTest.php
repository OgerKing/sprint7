<?php

namespace Tests\Unit\Controllers;

use App\Http\Controllers\UserSettingController;
use App\Models\UserSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\View\View;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserSettingControllerTest extends TestCase
{
    use RefreshDatabase;

    private UserSettingController $controller;

    protected function setUp(): void
    {
        parent::setUp();
        $this->controller = new UserSettingController;
    }

    #[Test]
    public function index_returns_view_with_user_settings()
    {
        UserSetting::factory()->count(3)->create();

        $response = $this->controller->index(new Request);

        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('userSetting.index', $response->getName());
        $this->assertCount(3, $response->getData()['userSettings']);
    }

    #[Test]
    public function create_returns_create_view()
    {
        $response = $this->controller->create(new Request);

        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('userSetting.create', $response->getName());
    }

    #[Test]
    public function show_returns_view_with_all_user_settings()
    {
        UserSetting::factory()->count(3)->create();
        $userSetting = UserSetting::first();

        $response = $this->controller->show(new Request, $userSetting);

        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('userSetting.show', $response->getName());
        $this->assertCount(3, $response->getData()['userSettings']);
    }

    #[Test]
    public function edit_returns_edit_view_with_user_setting()
    {
        $userSetting = UserSetting::factory()->create();

        $response = $this->controller->edit(new Request, $userSetting);

        $this->assertInstanceOf(View::class, $response);
        $this->assertEquals('userSetting.edit', $response->getName());
        $this->assertEquals($userSetting->id, $response->getData()['userSetting']->id);
    }
}
