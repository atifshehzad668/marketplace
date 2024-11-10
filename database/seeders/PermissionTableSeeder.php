<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'permission-list',
            'permission-show',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'permission-update',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'listing-list',
            'listing-create',
            'listing-edit',
            'listing-delete',
            'order-list',
            'order-create',
            'order-edit',
            'order-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'purchase-order-index',
            'admin-wallet',
            'admin-orders',




        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
