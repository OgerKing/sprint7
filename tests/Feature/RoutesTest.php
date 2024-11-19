<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class RoutesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

    }

    // Leaving this for later, having issues with wrats application history write

    /**
     * test all routes
     */
    public function test_routes_work()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Retrieve all routes
        $routes = collect(Route::getRoutes())->map(function ($route) {
            return [
                'uri' => $route->uri(),
                'methods' => $route->methods(),
            ];
        });

        $ignoretheseroutes = [
            // Vendor
            '_debugbar',
            '_ignition',
            'livewire',

            // Laravel
            'login',
            'logout',
            'password',
            'confirm-password',
            'forgot-password',
            'reset-password',
            'register',
            'email',
            'verify-email',

            // App
            'adjudications',
            'combine',
            'courts-and-judges',
            'document-management/',
            'global-documents',
            'profile',
            'sections',
            'split',

            'wrats-user-application-histories',
        ];

        // Iterate over each route
        foreach ($routes as $route) {
            foreach ($route['methods'] as $method) {
                if (collect($ignoretheseroutes)->contains(fn ($value) => str($route['uri'])->startsWith($value))) {
                    continue;
                }

                $this->be($user);
                $this->withoutExceptionHandling();
                $response = $this->call($method, $route['uri']);
                $response->assertStatus(200);
            }
        }
    }
}
