<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Trip;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
            'rol' => 'admin',
        ]);

        $categories = ['Beach', 'Mountain', 'City', 'Adventure', 'Cruise'];
        
        foreach ($categories as $cat) {
            Category::firstOrCreate(['name' => $cat]);
        }


        Trip::factory(50)->create();

        User::factory(10)->create();
    }
}