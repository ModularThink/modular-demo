<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Modules\User\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        $this->createTestUsers();

        User::factory()
            ->count(12)
            ->create();

        Schema::enableForeignKeyConstraints();
    }

    private function createTestUsers(): void
    {
        $users = [
            'Root User' => 'root@ismodular.com',
            'Content Author' => 'author@ismodular.com',
            'Content Director' => 'director@ismodular.com',
        ];

        foreach ($users as $userName => $userEmail) {
            User::factory()->create([
                'name' => $userName,
                'email' => $userEmail,
                'email_verified_at' => now(),
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            ]);
        }
    }
}
