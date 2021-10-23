<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin  = Role::where('name', 'Admin')->first();
        $role_sacon  = Role::where('name', 'Sacon')->first();
        $role_w_i  = Role::where('name', 'Warping & Indigo')->first();
        $role_admin_w_i  = Role::where('name', 'Admin Warping & Indigo')->first();
        $role_weaving  = Role::where('name', 'Weaving')->first();
        $role_admin_weaving  = Role::where('name', 'Admin Weaving')->first();
        $role_greige  = Role::where('name', 'Greige')->first();
        $role_admin_greige  = Role::where('name', 'Admin Greige')->first();
        $role_finish  = Role::where('name', 'Finish')->first();
        $role_admin_finish  = Role::where('name', 'Admin Finish')->first();


        

        $admin = new User();
        $admin->name      = 'Admin';
        $admin->username  = 'admin';
        $admin->email     = 'admin@example.com';
        $admin->password  = bcrypt('admin');
        $admin->save();
        $admin->roles()->attach($role_admin);

        $sacon = new User();
        $sacon->name        = 'Siti';
        $sacon->username    = 'siti';
        $sacon->email       = 'siti@example.com';
        $sacon->password    = bcrypt('siti');
        $sacon->save();
        $sacon->roles()->attach($role_sacon);

        $w_i = new User();
        $w_i->name        = 'Rani';
        $w_i->username    = 'rani';
        $w_i->email       = 'rani@example.com';
        $w_i->password    = bcrypt('rani');
        $w_i->save();
        $w_i->roles()->attach($role_w_i);

        $admin_w_i = new User();
        $admin_w_i->name        = 'Runi';
        $admin_w_i->username    = 'runi';
        $admin_w_i->email       = 'runi@example.com';
        $admin_w_i->password    = bcrypt('runi');
        $admin_w_i->save();
        $admin_w_i->roles()->attach($role_admin_w_i);

        $weaving = new User();
        $weaving->name        = 'Lia';
        $weaving->username    = 'lia';
        $weaving->email       = 'lia@example.com';
        $weaving->password    = bcrypt('lia');
        $weaving->save();
        $weaving->roles()->attach($role_weaving);

        $admin_weaving = new User();
        $admin_weaving->name        = 'Lio';
        $admin_weaving->username    = 'lio';
        $admin_weaving->email       = 'lio@example.com';
        $admin_weaving->password    = bcrypt('lio');
        $admin_weaving->save();
        $admin_weaving->roles()->attach($role_admin_weaving);
        
        $greige = new User();
        $greige->name        = 'Budi';
        $greige->username    = 'budi';
        $greige->email       = 'budi@example.com';
        $greige->password    = bcrypt('budi');
        $greige->save();
        $greige->roles()->attach($role_greige);

        $admin_greige = new User();
        $admin_greige->name        = 'Budo';
        $admin_greige->username    = 'budo';
        $admin_greige->email       = 'budo@example.com';
        $admin_greige->password    = bcrypt('budo');
        $admin_greige->save();
        $admin_greige->roles()->attach($role_admin_greige);

        $finish = new User();
        $finish->name        = 'Santi';
        $finish->username    = 'santi';
        $finish->email       = 'santi@example.com';
        $finish->password    = bcrypt('santi');
        $finish->save();
        $finish->roles()->attach($role_finish);

        $admin_finish = new User();
        $admin_finish->name        = 'Sinta';
        $admin_finish->username    = 'sinta';
        $admin_finish->email       = 'sinta@example.com';
        $admin_finish->password    = bcrypt('sinta');
        $admin_finish->save();
        $admin_finish->roles()->attach($role_admin_finish);
    }
}
