<?php

namespace Tests\Unit\Http\Middleware;

use App\Http\Middleware\WratsUserApplicationHistoryLogger;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class WratsUserApplicationHistoryLoggerTest extends TestCase
{
    use RefreshDatabase;

    protected $middleware;

    protected function setUp(): void
    {
        parent::setUp();
        $this->middleware = new WratsUserApplicationHistoryLogger;
    }

    public function test_it_logs_user_visit_when_authenticated()
    {
        $user = new User;
        $user->name = 'jhondoe';
        $user->email = 'jhondoe@example.com';
        $user->password = 'password';
        // Set other fields ...
        $user->save();
        $this->actingAs($user);

        $request = Request::create('/dashboard', 'GET', ['param' => 'value']);

        config([
            'settings.user.history.paths' => [
                'dashboard' => 'dashboard_visit',
                'default' => 'other_visit',
            ],
        ]);

        $this->middleware->handle($request, function () {
            return response()->noContent();
        });

        $this->assertDatabaseHas('wrats_user_application_history', [
            'users_id' => $user->id,
            'path' => $request->url(),
            'parameters' => json_encode(['param' => 'value']),
            'record_type' => 'dashboard_visit',
            'label' => 'Visited Page',
        ]);
    }

    public function test_it_does_not_log_visit_when_user_is_not_authenticated()
    {
        $request = Request::create('/dashboard', 'GET');

        $this->middleware->handle($request, function () {
            return response()->noContent();
        });

        $this->assertDatabaseCount('wrats_user_application_history', 0);
    }

    public function test_it_uses_default_record_type_for_unknown_paths()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $request = Request::create('/unknown', 'GET');

        config([
            'settings.user.history.paths' => [
                'dashboard' => 'dashboard_visit',
                'default' => 'other_visit',
            ],
        ]);

        $this->middleware->handle($request, function () {
            return response()->noContent();
        });

        $this->assertDatabaseHas('wrats_user_application_history', [
            'users_id' => $user->id,
            'path' => $request->url(),
            'record_type' => 'other_visit',
        ]);
    }
}
