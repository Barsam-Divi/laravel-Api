<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::query()->where('title' , 'admin')->first();
        User::query()->create([
            'role_id' => $adminRole->id,
            'name' => 'Barsam',
            'email' => 'barsam@gmail.com',
            'password' => Hash::make(123456)
        ]);
    }
}
