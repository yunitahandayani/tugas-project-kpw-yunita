<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $profile = Profile::create([
            'alamat' => 'Kantor Pusat One Movies',
            'umur' => 30,
            'bio' => 'Administrator One Movies.',
        ]);

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => '12345678',
            'email_verified_at' => now(),
            'role_id' => User::ROLE_ADMIN,
            'profile_id' => $profile->id,
        ]);
    }
}
