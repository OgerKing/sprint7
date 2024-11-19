<?php

namespace Tests\Unit\Livewire\Components;

use App\Livewire\Components\AdjudicationCards;
use App\Models\Adjudication;
use App\Models\User;
use Database\Seeders\PermissionsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdjudicationCardsTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_select_adjudication()
    {
        $adjudication = Adjudication::factory()->create();
        $this->seed(PermissionsSeeder::class);
        $user = User::factory()->create();
        $user->givePermissionTo('sys-admin and lap admin only');
        $this->actingAs($user);

        Livewire::test(AdjudicationCards::class, ['adjudication' => $adjudication])
            ->assertSet('adjudication', $adjudication);
    }

    public function test_can_get_split_and_combine_permissions()
    {
        $adjudication = Adjudication::factory()->create();

        $this->seed(PermissionsSeeder::class);
        $user = User::factory()->create();
        $user->givePermissionTo('sys-admin and lap admin only');
        $this->actingAs($user);

        Livewire::test(AdjudicationCards::class, ['adjudication' => $adjudication])
            ->call('splitAndCombinePermissions')
            ->assertSet('split_and_combine_permissions', true);
    }

    public function test_has_editAdjudicationPermissions()
    {
        $adjudication = Adjudication::factory()->create();
        //ßdd($adjudication->adjudication_status->adjudication_status_description);
        $this->seed(PermissionsSeeder::class);
        $user = User::factory()->create();
        $user->givePermissionTo('sys-admin and lap admin only');

        $this->actingAs($user);

        Livewire::test(AdjudicationCards::class, ['adjudication' => $adjudication])
            ->assertNotSet('edit_adjudication_permissions', 'Null');
    }
}
