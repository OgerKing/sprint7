<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserSetting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'create adjudication']);
        Permission::create(['name' => 'edit adjudication']);
        Permission::create(['name' => 'read court']);
        Permission::create(['name' => 'read judges']);
        Permission::create(['name' => 'read global documents']);
        Permission::create(['name' => 'read split_and_combine']);
        Permission::create(['name' => 'see adudication elipse']);
        Permission::create(['name' => 'add or edit adjudication sections']);
        Permission::create(['name' => 'edit courts and judges']);
        Permission::create(['name' => 'edit adjudication sections']);
        Permission::create(['name' => 'sys-admin only']);
        Permission::create(['name' => 'sys-admin and lap admin only']);
        Permission::create(['name' => 'bureau-law-clerk-and-up']);
        Permission::create(['name' => 'attorney-and-up']);
        Permission::create(['name' => 'bulk-change-subfile-documents']);
        Permission::create(['name' => 'bulk-change-water-rights-documents']);
        Permission::create(['name' => 'bulk-change-pod-documents']);
        Permission::create(['name' => 'bulk-change-pod-rights']);
        Permission::create(['name' => 'bulk-change-pou-rights']);
        Permission::create(['name' => 'bulk-change-pou-documents']);
        Permission::create(['name' => 'subfile-records-list-write-access']);
        Permission::create(['name' => 'persons-records-list-write-access']);
        Permission::create(['name' => 'authorized-agents-records-list-write-access']);
        Permission::create(['name' => 'water-rights-records-list-write-access']);
        Permission::create(['name' => 'points-of-diversion-records-list-write-access']);
        Permission::create(['name' => 'places-of-use-records-list-write-access']);
        Permission::create(['name' => 'documents-records-list-write-access']);

        // create roles and assign existing permissions

        $role1 = Role::create(['name' => 'WRATS_SystemAdmin']);
        $role1->givePermissionTo('create adjudication');
        $role1->givePermissionTo('edit adjudication');
        $role1->givePermissionTo('read court');
        $role1->givePermissionTo('read judges');
        $role1->givePermissionTo('read global documents');
        $role1->givePermissionTo('see adudication elipse');
        $role1->givePermissionTo('add or edit adjudication sections');
        $role1->givePermissionTo('edit courts and judges');
        $role1->givePermissionTo('read split_and_combine');
        $role1->givePermissionTo('sys-admin only');
        $role1->givePermissionTo('sys-admin and lap admin only');
        $role1->givePermissionTo('bureau-law-clerk-and-up');
        $role1->givePermissionTo('attorney-and-up');
        $role1->givePermissionTo('bulk-change-subfile-documents');
        $role1->givePermissionTo('bulk-change-water-rights-documents');
        $role1->givePermissionTo('bulk-change-pod-documents');
        $role1->givePermissionTo('bulk-change-pod-rights');
        $role1->givePermissionTo('bulk-change-pou-rights');
        $role1->givePermissionTo('bulk-change-pou-documents');
        $role1->givePermissionTo('subfile-records-list-write-access');
        $role1->givePermissionTo('persons-records-list-write-access');
        $role1->givePermissionTo('authorized-agents-records-list-write-access');
        $role1->givePermissionTo('water-rights-records-list-write-access');
        $role1->givePermissionTo('points-of-diversion-records-list-write-access');
        $role1->givePermissionTo('places-of-use-records-list-write-access');
        $role1->givePermissionTo('documents-records-list-write-access');

        $role2 = Role::create(['name' => 'WRATS_LAP_Administrator']);
        $role2->givePermissionTo('create adjudication');
        $role2->givePermissionTo('edit adjudication');
        $role2->givePermissionTo('read court');
        $role2->givePermissionTo('read judges');
        $role2->givePermissionTo('read global documents');
        $role2->givePermissionTo('see adudication elipse');
        $role2->givePermissionTo('add or edit adjudication sections');
        $role2->givePermissionTo('edit courts and judges');
        $role2->givePermissionTo('read split_and_combine');
        $role2->givePermissionTo('sys-admin and lap admin only');
        $role2->givePermissionTo('bureau-law-clerk-and-up');
        $role2->givePermissionTo('attorney-and-up');
        $role2->givePermissionTo('bulk-change-subfile-documents');
        $role2->givePermissionTo('subfile-records-list-write-access'); //TODO: check sprint 8 subfile records list permissions

        $role3 = Role::create(['name' => 'WRATS_LawClerk']);
        $role3->givePermissionTo('see adudication elipse');
        $role3->givePermissionTo('read court');
        $role3->givePermissionTo('read judges');
        $role3->givePermissionTo('edit courts and judges');
        $role3->givePermissionTo('read global documents');
        $role3->givePermissionTo('bureau-law-clerk-and-up');
        $role3->givePermissionTo('attorney-and-up');
        $role3->givePermissionTo('bulk-change-subfile-documents');
        $role3->givePermissionTo('bulk-change-water-rights-documents');
        $role3->givePermissionTo('bulk-change-pod-documents');
        $role3->givePermissionTo('bulk-change-pou-documents');
        $role3->givePermissionTo('subfile-records-list-write-access'); //TODO: Sprint 8. update permissions for only law clerks who are attached to the subfile bureau
        $role3->givePermissionTo('persons-records-list-write-access'); //TODO: only attached to subfile bureau
        $role3->givePermissionTo('authorized-agents-records-list-write-access'); //TODO: only attached to subfile bureau
        $role3->givePermissionTo('water-rights-records-list-write-access'); //TODO: attached to subfile bureau
        $role3->givePermissionTo('points-of-diversion-records-list-write-access');
        $role3->givePermissionTo('documents-records-list-write-access');

        $role10 = Role::create(['name' => 'WRATS_Attorney']);
        $role10->givePermissionTo('attorney-and-up');
        $role10->givePermissionTo('bulk-change-subfile-documents');
        $role10->givePermissionTo('persons-records-list-write-access');
        $role10->givePermissionTo('authorized-agents-records-list-write-access');

        $role4 = Role::create(['name' => 'WRATS_AttorneySupervisor']);

        $role5 = Role::create(['name' => 'WRATS_Hydrographic_Survy']);
        $role5->givePermissionTo('see adudication elipse');
        $role5->givePermissionTo('read global documents');
        $role5->givePermissionTo('bulk-change-subfile-documents');
        $role5->givePermissionTo('bulk-change-water-rights-documents');
        $role5->givePermissionTo('bulk-change-pod-documents');
        $role5->givePermissionTo('bulk-change-pod-rights');
        $role5->givePermissionTo('bulk-change-pou-rights');
        $role5->givePermissionTo('bulk-change-pou-documents');
        $role5->givePermissionTo('subfile-records-list-write-access'); //TODO: Sprint 8. update permissions for only hydrographic survey who are attached to the subfile bureau
        $role5->givePermissionTo('persons-records-list-write-access');
        $role5->givePermissionTo('water-rights-records-list-write-access'); //TODO: attached to subfile bureau.
        $role5->givePermissionTo('points-of-diversion-records-list-write-access');
        $role5->givePermissionTo('places-of-use-records-list-write-access');

        $role6 = Role::create(['name' => 'WRATS_ReportOSEwideAdmin']);

        $role7 = Role::create(['name' => 'WRATS_ReportBureauAdmin']);

        $role8 = Role::create(['name' => 'WRATS_PDOSEwideAdmin']);

        $role9 = Role::create(['name' => 'WRATS_PDtBureauAdmin']);

        //create test users
        $user = User::factory()->create([
            'name' => 'WRATS_SystemAdmin_user',
            'email' => 'WRATS_SystemAdmin_user',
            'password' => Hash::make('p@leStamp65'),
        ]);
        $usersetting = UserSetting::factory()->create([
            'display_name' => $user->name,
            'user_id' => $user->id,
        ]);
        $user->assignRole($role1);

        $user = User::factory()->create([
            'name' => 'WRATS_LAP_Administrator_user',
            'email' => 'WRATS_LAP_Administrator_user',
            'password' => Hash::make('p@leStamp65'),
        ]);
        $usersetting = UserSetting::factory()->create([
            'display_name' => $user->name,
            'user_id' => $user->id,
        ]);
        $user->assignRole($role2);

        $user = User::factory()->create([
            'name' => 'WRATS_LawClerk_user',
            'email' => 'WRATS_LawClerk_user',
            'password' => Hash::make('p@leStamp65'),
        ]);
        $usersetting = UserSetting::factory()->create([
            'display_name' => $user->name,
            'user_id' => $user->id,
        ]);
        $user->assignRole($role3);

        $user = User::factory()->create([
            'name' => 'WRATS_Attorney_user',
            'email' => 'WRATS_Attorney_user',
            'password' => Hash::make('p@leStamp65'),
        ]);
        $usersetting = UserSetting::factory()->create([
            'display_name' => $user->name,
            'user_id' => $user->id,
        ]);
        $user->assignRole($role10);

        $user = User::factory()->create([
            'name' => 'WRATS_AttorneySupervisor_user',
            'email' => 'WRATS_AttorneySupervisor_user',
            'password' => Hash::make('p@leStamp65'),
        ]);
        $usersetting = UserSetting::factory()->create([
            'display_name' => $user->name,
            'user_id' => $user->id,
        ]);
        $user->assignRole($role4);

        $user = User::factory()->create([
            'name' => 'WRATS_Hydrographic_Survey_user',
            'email' => 'WRATS_Hydrographic_Survey_user',
            'password' => Hash::make('p@leStamp65'),
        ]);
        $usersetting = UserSetting::factory()->create([
            'display_name' => $user->name,
            'user_id' => $user->id,
        ]);
        $user->assignRole($role5);

        $user = User::factory()->create([
            'name' => 'WRATS_ReportOSEwideAdmin_user',
            'email' => 'WRATS_ReportOSEwideAdmin_user',
            'password' => Hash::make('p@leStamp65'),
        ]);
        $usersetting = UserSetting::factory()->create([
            'display_name' => $user->name,
            'user_id' => $user->id,
        ]);
        $user->assignRole($role6);

        $user = User::factory()->create([
            'name' => 'WRATS_ReportBureauAdmin_user',
            'email' => 'WRATS_ReportBureauAdmin_user',
            'password' => Hash::make('p@leStamp65'),
        ]);
        $usersetting = UserSetting::factory()->create([
            'display_name' => $user->name,
            'user_id' => $user->id,
        ]);
        $user->assignRole($role7);

        $user = User::factory()->create([
            'name' => 'WRATS_PDOSEwideAdmin_user',
            'email' => 'WRATS_PDOSEwideAdmin_user',
            'password' => Hash::make('p@leStamp65'),
        ]);
        $usersetting = UserSetting::factory()->create([
            'display_name' => $user->name,
            'user_id' => $user->id,
        ]);
        $user->assignRole($role8);

        $user = User::factory()->create([
            'name' => 'WRATS_PDtBureauAdmin_user',
            'email' => 'WRATS_PDtBureauAdmin_user',
            'password' => Hash::make('p@leStamp65'),
        ]);
        $usersetting = UserSetting::factory()->create([
            'display_name' => $user->name,
            'user_id' => $user->id,
        ]);
        $user = User::factory()->create([
            'name' => 'Monica',
            'email' => 'monica@rs21.io',
            'password' => Hash::make('password'),
        ]);
        $usersetting = UserSetting::factory()->create([
            'display_name' => $user->name,
            'user_id' => $user->id,
        ]);
        $user->assignRole($role1);
    }
}
