<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'Admin';
        $role->description = 'Admin Account';
        $role->save();

        $role = new Role();
        $role->name = 'Sacon';
        $role->description = 'Sacon Account';
        $role->save();

        $role = new Role();
        $role->name = 'Warping & Indigo';
        $role->description = 'Warping & Indigo Account';
        $role->save();

        $role = new Role();
        $role->name = 'Admin Warping & Indigo';
        $role->description = 'Admin Warping & Indigo Account';
        $role->save();

        $role = new Role();
        $role->name = 'Weaving';
        $role->description = 'Weaving Account';
        $role->save();
        
        $role = new Role();
        $role->name = 'Admin Weaving';
        $role->description = 'Admin Weaving Account';
        $role->save();

        $role = new Role();
        $role->name = 'Greige';
        $role->description = 'Greige Account';
        $role->save();

        $role = new Role();
        $role->name = 'Admin Greige';
        $role->description = 'Admin Greige Account';
        $role->save();

        $role = new Role();
        $role->name = 'Finish';
        $role->description = 'Finish Account';
        $role->save();

        $role = new Role();
        $role->name = 'Admin Finish';
        $role->description = 'Admin Finish Account';
        $role->save();
        
        
    }
}
