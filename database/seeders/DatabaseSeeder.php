<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\CategorySeeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\TransactionSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       // call the CategorySeeder and TransactionSeeder
            $this->call([
                CategorySeeder::class,
                TransactionSeeder::class,
                PostSeeder::class,

            ]);

            \App\Models\User::create(['email' => 'admin@admin.com', 'password' => bcrypt('123456789'), 'name' => 'admin']);


    }
}
