<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'super@admin.com',
            'password' => '$2y$12$Mgv4g6MCzbw0ozJYlomGeuMpuPsCLUY2HY7wR0JQuS2p1QlBMFazO' ,
        ]);

        $user = \App\Models\User::find(1);
        $user->assignRole('super_admin');

        \App\Models\Kec::factory()->create([
            'name' => 'Brondong',
            'kode' => '35240',
        ]);

        \App\Models\Kel::factory()->create([
            'name' => 'Brengkok',
            'kode' => '01',
            'kec_id'=> '1',
            ])
            ->create([
            'name' => 'Brondong',
            'kode' => '01',
            'kec_id'=> '1',
            ])
            ->create([
            'name' => 'Labuhan',
            'kode' => '01',
            'kec_id'=> '1',
            ])
            ->create([
            'name' => 'Lembor',
            'kode' => '01',
            'kec_id'=> '1',
            ])
            ->create([
            'name' => 'Lohgung',
            'kode' => '01',
            'kec_id'=> '1',
            ])
            ->create([
            'name' => 'Sedayulawas',
            'kode' => '01',
            'kec_id'=> '1',
            ])
            ->create([
            'name' => 'Sendangharjo',
            'kode' => '01',
            'kec_id'=> '1',
            ])
            ->create([
            'name' => 'Sidomukti',
            'kode' => '01',
            'kec_id'=> '1',
            ])
            ->create([
            'name' => 'Sumberagung',
            'kode' => '01',
            'kec_id'=> '1',
            ])
            ->create([
            'name' => 'Tlogoretno',
            'kode' => '01',
            'kec_id'=> '1',
        ]);


    }
}
