<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            // Role permissions
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            // Permission management permissions
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-update',
            'permission-delete',

            // User management permissions
            'user-list',
            'user-create',
            'user-store',
            'user-edit',
            'user-update',
            'user-delete',

            // Dashboard permissions
            'admin-dashboard',
            'salesman-dashboard',

            // Lead management permissions
            'leads-create',
            'leads-store',
            'leads-edit',
            'leads-update',
            'leads-index',
            'leads-destroy',
            'leads-show',



            //lead accept
            'salesman-lead-make_sale',
            'salesman-lead-create',
            'salesman-lead-accept',
            'salesman-leads',
            'salesman-conversation',
            'salesman-conversation-store',
            'salesman-conversation-index',
            'admin-conversation-index',
            'admin-conversation-edit',
            'admin-conversation-update',
            'admin-conversation-destroy',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
