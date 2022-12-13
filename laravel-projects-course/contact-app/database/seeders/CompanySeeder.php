<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = [];
        foreach(range(1, 10) as $index) {
            $company = [
                'name' => $name = "Company $index",
                'address' => "Address $name",
                'website' => "website $name",
                'email' => "email $name",
                'created_at' => now(),
                'updated_at' => now()
            ];

            $companies[] = $company;
        }

        DB::table('companies')->insert($companies);
    }
}
