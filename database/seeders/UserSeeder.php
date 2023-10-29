<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'                   =>'Admin',
            'email'                   =>'admin@gmail.com',
            'email_verified_at' =>now(),
            'created_at'           =>now(),
            'updated_at'          =>now(),
            'password'=>Hash::make('Admin@1234') // <---- Remember this
        ]);
    }
}
