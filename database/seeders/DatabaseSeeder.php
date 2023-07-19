<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Arr;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // DB::table('employers')->factory(10)->insert([
        //     'company_name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => 'admin'
        // ]);
       
        \App\Models\User::factory(10)->create();

        
    }
}
// DatabaseSeeder.php
// Displaying DatabaseSeeder.php.
