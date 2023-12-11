<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'super@admin.com',
            'password' => '$2y$12$Mgv4g6MCzbw0ozJYlomGeuMpuPsCLUY2HY7wR0JQuS2p1QlBMFazO' ,
        ]);
    }
}
