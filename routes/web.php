<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//untuk register user by manual route
// Route::get('/register-zoro', function () {
//     // Semak sama ada pengguna dengan email ini sudah wujud
//     $existingUser = User::where('email', 'zoro@example.com')->first();

//     if ($existingUser) {
//         return redirect()->back()->with('error', 'User already exists!');
//     }

//     // Cipta pengguna
//     $user = User::create([
//         'name' => 'Zoro',
//         'email' => 'zoro@demo.com', // Tetapkan email tetap
//         'password' => bcrypt('password'), // Kata laluan tetap
//     ]);

//     // Tetapkan peranan kepada pengguna (contohnya, "Admin")
//     //1 admin , 2 agent ini delare dari array kat seeder, dia based dari database punya id
//     $user->roles()->sync([2]);

//     return redirect()->back()->with('success', 'User Zoro registered successfully!');
// });