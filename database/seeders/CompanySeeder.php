<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seedData = Faker::create();
        
        for ($i = 0; $i < 10; $i++) {
            DB::table('company')->insert([
                'user_id' => '1',
                'company_name' => $seedData->name,
                'email' => $seedData->unique()->safeEmail,
                'created_at'  =>now(),
                'updated_at'  =>now(),
            ]);
        }
    }
}
