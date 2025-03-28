<?php

namespace Modules\Acl\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission;

class AclPermissionSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Permission::truncate();

        $permissions = $this->getPermissions();

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'user',
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }

    private function getPermissions(): array
    {
        return [

            //Main Menu
            '1' => 'Dashboard',
            '2' => 'Blog',
            '3' => 'Blog: Post - List',
            '4' => 'Blog: Category - List',
            '5' => 'Blog: Author - List',
            '6' => 'Acl', //Acl: Access Control List
            '7' => 'Acl: User - List',
            '8' => 'Acl: Permission - List',
            '9' => 'Acl: Role - List',

            //BlogPost/PostIndex.vue
            '10' => 'Blog: Post - Create',
            '11' => 'Blog: Post - Edit',
            '12' => 'Blog: Post - Delete',

            //BlogCategory/CategoryIndex.vue
            '13' => 'Blog: Category - Create',
            '14' => 'Blog: Category - Edit',
            '15' => 'Blog: Category - Delete',

            //BlogAuthor/AuthorIndex.vue
            '16' => 'Blog: Author - Create',
            '17' => 'Blog: Author - Edit',
            '18' => 'Blog: Author - Delete',

            //User/UserIndex.vue
            '19' => 'Acl: User - Manage Roles',
            '20' => 'Acl: User - Manage Permissions',
            '21' => 'Acl: User - Create',
            '22' => 'Acl: User - Edit',
            '23' => 'Acl: User - Delete',

            //AclPermission/PermissionIndex.vue
            '24' => 'Acl: Permission - Create',
            '25' => 'Acl: Permission - Edit',
            '26' => 'Acl: Permission - Delete',

            //AclRole/RoleIndex.vue
            '27' => 'Acl: Role - Create',
            '28' => 'Acl: Role - Edit',
            '29' => 'Acl: Role - Delete',

            //AclRolePermission/RolePermissionForm.vue
            '30' => 'Acl: Role - Manage Permissions',

        ];
    }
}
