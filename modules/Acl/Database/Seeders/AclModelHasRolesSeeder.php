<?php

namespace Modules\Acl\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AclModelHasRolesSeeder extends Seeder
{

    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        DB::table('model_has_roles')->truncate();

        //root
        DB::table('model_has_roles')->insert([
            'role_id' => 1,
            'model_type' => 'user',
            'model_id' => 1,
        ]);

        //content author
        DB::table('model_has_roles')->insert([
            'role_id' => 2,
            'model_type' => 'user',
            'model_id' => 2,
        ]);

        //content director
        DB::table('model_has_roles')->insert([
            'role_id' => 3,
            'model_type' => 'user',
            'model_id' => 3,
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
