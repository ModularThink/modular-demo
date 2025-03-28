<?php

namespace Modules\Acl\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

class AclRoleSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Role::truncate();

        Role::create([
            'name' => 'root',
            'guard_name' => 'user',
        ]);

        Role::create([
            'name' => 'content author',
            'guard_name' => 'user',
        ]);

        Role::create([
            'name' => 'content director',
            'guard_name' => 'user',
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
