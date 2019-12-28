<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\NormalUser;
use App\Account;
use Illuminate\Support\Facades\Hash;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleAdmin = Role::create(["role"=>"admin"]);
        Role::create(["role"=>"normaluser"]);

       $admin = $roleAdmin->users()->create(["fullName"=>"Admin","status"=>1,"gender"=>1]);

       $admin->account()->create(["email"=>"admin@gmail.com","username"=>"admin","password"=>Hash::make("123123123")]);
    }
}
