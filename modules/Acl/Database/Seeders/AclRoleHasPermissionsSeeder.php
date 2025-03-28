<?php

namespace Modules\Acl\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

class AclRoleHasPermissionsSeeder extends Seeder
{

    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $contentAuthorPermissions = [
            '1', //Dashboard
            '2', //Blog
            '3', //Blog: Post - List
            '4', //Blog: Category - List
            '10', //Blog: Post - Create
            '11', //Blog: Post - Edit
            '13', //Blog: Category - Create
            '14', //Blog: Category - Edit
        ];

        $contentDirectorPermissions = array_merge($contentAuthorPermissions, [
            '5', //Blog: Author - List
            '12', //Blog: Post - Delete
            '15', //Blog: Category - Delete
            '16', //Blog: Author - Create
            '17', //Blog: Author - Edit
            '18', //Blog: Author - Delete
        ]);

        $rolesWithPermissions = [
            2 => $contentAuthorPermissions,
            3 => $contentDirectorPermissions,
        ];

        foreach ($rolesWithPermissions as $roleId => $permissionsIds) {
            $role = Role::findOrFail($roleId);

            foreach ($permissionsIds as $permissionId) {
                $role->givePermissionTo((int) $permissionId);
            }
        }

        Schema::enableForeignKeyConstraints();
    }
}
