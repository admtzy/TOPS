<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Circle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
   public function run(): void
    {
        $admin = User::create([
            'name'=>'Admin',
            'email'=>'admin@sirkel.com',
            'password'=>bcrypt('123456'),
            'role'=>'admin'
        ]);

        Circle::create([
            'name'=>'Sirkel Gabut',
            'description'=>'Tongkrongan solid sejak 2019',
            'created_by'=>$admin->id
        ]);
    }
}
