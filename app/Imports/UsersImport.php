<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToCollection
{

    public function collection(Collection $collection)
    {
        $user = \App\Models\User::find(1);
        $user->assignRole('super_admin');
    }
}
