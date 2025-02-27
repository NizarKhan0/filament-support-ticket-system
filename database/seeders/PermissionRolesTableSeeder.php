<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_permissions = Permission::all();

        $agent_permissions = Permission::whereIn('title', [
            'category_show',
            'category_access',
            'label_show',
            'label_access',
            'ticket_show',
            'ticket_access',
        ])->get();

        //find by id 1 and 2 dari table roles
        Role::findOrFail(1)->permissions()->sync($admin_permissions);
        Role::findOrFail(2)->permissions()->sync($agent_permissions);
    }
}