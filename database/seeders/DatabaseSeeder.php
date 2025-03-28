<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Acl\Database\Seeders\AclModelHasRolesSeeder;
use Modules\Acl\Database\Seeders\AclPermissionSeeder;
use Modules\Acl\Database\Seeders\AclRoleHasPermissionsSeeder;
use Modules\Acl\Database\Seeders\AclRoleSeeder;
use Modules\Blog\Database\Seeders\BlogSeeder;
use Modules\User\Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AclRoleSeeder::class,
            AclPermissionSeeder::class,
            BlogSeeder::class,
            UserSeeder::class,
            AclModelHasRolesSeeder::class,
            AclRoleHasPermissionsSeeder::class,
            AclRoleSeeder::class,
        ]);
    }
}
