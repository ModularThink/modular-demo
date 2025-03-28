<?php

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class BlogAclSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = $this->getPermissions();

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'user',
            ]);
        }
    }

    private function getPermissions(): array
    {
        return [
            // Main Menu
            'Blog',

            // BlogPost/PostIndex.vue
            'Blog: Post - List',
            'Blog: Post - Create',
            'Blog: Post - Edit',
            'Blog: Post - Delete',

            // BlogCategory/CategoryIndex.vue
            'Blog: Category - List',
            'Blog: Category - Create',
            'Blog: Category - Edit',
            'Blog: Category - Delete',

            // BlogAuthor/AuthorIndex.vue
            'Blog: Author - List',
            'Blog: Author - Create',
            'Blog: Author - Edit',
            'Blog: Author - Delete',

            // BlogTag/TagIndex.vue
            'Blog: Tag - List',
            'Blog: Tag - Create',
            'Blog: Tag - Edit',
            'Blog: Tag - Delete',
        ];
    }
}
