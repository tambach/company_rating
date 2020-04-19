<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       /* User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin'),
            'role' => 2
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@test.com',
            'password' => Hash::make('secret'),
            'role' => 1
        ]);
       \App\Category::create([
           'name' => 'განათლება'
       ]);
        \App\Category::create([
            'name' => 'ჯანმრთელობა'
        ]);
        \App\Category::create([
            'name' => 'კვება'
        ]);
        \App\Category::create([
            'name' => 'საბავშვო'
        ]);
        \App\Category::create([
            'name' => 'ტექნიკა'
        ]);
        \App\Category::create([
            'name' => 'გართობა'
        ]);
        \App\Category::create([
            'name' => 'ავეჯი'
        ]); */

        // $this->call(UsersTableSeeder::class);
        $this->call(ArticlesSeeder::class);
        $this->call(CompanySeeder::class);
    }
}
