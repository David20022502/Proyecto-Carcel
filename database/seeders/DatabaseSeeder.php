<?php

namespace Database\Seeders;

use App\Models\Ward;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ReportSeeder::class,
            WardSeeder::class,
            JailSeeder::class,
            ImageSeeder::class
        ]);
    }
}
