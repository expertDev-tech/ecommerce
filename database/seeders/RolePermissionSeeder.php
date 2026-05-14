<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Reset Cached Roles & Permissions
        |--------------------------------------------------------------------------
        */

        app()[\Spatie\Permission\PermissionRegistrar::class]
            ->forgetCachedPermissions();

        /*
        |--------------------------------------------------------------------------
        | Permissions
        |--------------------------------------------------------------------------
        */

        $permissions = [

            // Products
            'manage products',
            'create products',
            'edit products',
            'delete products',

            // Categories
            'manage categories',
            'create categories',
            'edit categories',
            'delete categories',

            // Brands
            'manage brands',
            'create brands',
            'edit brands',
            'delete brands',

            // Orders
            'manage orders',
            'view orders',
            'update orders',

            // Users
            'manage users',
            'create users',
            'edit users',
            'delete users',

            // Inventory
            'manage inventory',

            // Coupons
            'manage coupons',

            // Reviews
            'manage reviews',

            // Roles & Permissions
            'manage roles',
            'manage permissions',

            // Dashboard
            'view dashboard',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Roles
        |--------------------------------------------------------------------------
        */

        $superAdmin = Role::firstOrCreate([
            'name' => 'Super Admin'
        ]);

        $admin = Role::firstOrCreate([
            'name' => 'Admin'
        ]);

        $manager = Role::firstOrCreate([
            'name' => 'Manager'
        ]);

        $vendor = Role::firstOrCreate([
            'name' => 'Vendor'
        ]);

        $customer = Role::firstOrCreate([
            'name' => 'Customer'
        ]);

        $wholesaler = Role::firstOrCreate([
            'name' => 'Wholesaler'
        ]);

        $retailer = Role::firstOrCreate([
            'name' => 'Retailer'
        ]);

        /*
        |--------------------------------------------------------------------------
        | Assign Permissions
        |--------------------------------------------------------------------------
        */

        // Super Admin gets everything
        $superAdmin->givePermissionTo(Permission::all());

        // Admin
        $admin->givePermissionTo([
            'view dashboard',
            'manage products',
            'manage categories',
            'manage brands',
            'manage orders',
            'manage inventory',
            'manage coupons',
            'manage reviews',
        ]);

        // Manager
        $manager->givePermissionTo([
            'view dashboard',
            'manage products',
            'manage categories',
            'manage brands',
            'manage orders',
            'manage inventory',
        ]);

        // Vendor
        $vendor->givePermissionTo([
            'view dashboard',
            'manage products',
        ]);
    }
}
