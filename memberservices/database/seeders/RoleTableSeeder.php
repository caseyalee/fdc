<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $member = Role::create([
            'name'         => 'member'
        ]);

        $admin = Role::create([
            'name'         => 'admin'
        ]);
    }
}
