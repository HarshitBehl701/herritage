<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ComponentSeeder::class,
            PageSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            BlogSeeder::class,
            MetaSeeder::class,
            LocationPresenceSeeder::class,
        ]);
    }
}
