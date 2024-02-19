<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Goods;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $login = env('LOGIN_ADMIN','admin');
        $password = env('PASSWORD_ADMIN','admin777');
        $email = env('EMAIL_ADMIN','admin@ukr.net');

         User::factory(1)->create([
             'login' => $login,
             'email' => $email,
             'password' => Hash::make($password),
             'role' => 'admin',
             'created_at' => date("Y-m-d H:i:s"),
             'updated_at' => null,
         ]);

         User::factory(50)->create();
         Post::factory(100)->create();
         Comment::factory(100)->create();
    }
}
