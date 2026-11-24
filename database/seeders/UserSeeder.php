<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['User Demo', 'user@example.com', 17, 'Jl. Merdeka No. 10, Karawang', 'Akun demo untuk user biasa.'],
            ['Budi Santoso', 'budi@example.com', 21, 'Jl. Melati No. 5, Bekasi', 'Suka film aksi dan petualangan.'],
            ['Siti Aminah', 'siti@example.com', 19, 'Jl. Kenanga No. 12, Bandung', 'Pencinta drama dan romantis.'],
            ['Rizky Fauzan', 'rizky@example.com', 23, 'Jl. Anggrek No. 3, Jakarta', 'Kritikus film amatir di waktu luang.'],
            ['Dewi Lestari', 'dewi@example.com', 25, 'Jl. Mawar No. 8, Depok', 'Penonton setia film keluarga.'],
            ['Andi Wijaya', 'andi@example.com', 20, 'Jl. Cempaka No. 21, Bogor', 'Penggemar horor dan thriller.'],
            ['Putri Ayu', 'putri@example.com', 18, 'Jl. Dahlia No. 7, Cikampek', 'Suka animasi dan film musikal.'],
            ['Agus Salim', 'agus@example.com', 30, 'Jl. Flamboyan No. 14, Purwakarta', 'Hobi menonton film sejarah.'],
            ['Nurul Hidayah', 'nurul@example.com', 22, 'Jl. Teratai No. 2, Subang', 'Senang membahas film bersama teman.'],
            ['Fandi Ahmad', 'fandi@example.com', 27, 'Jl. Seruni No. 19, Cirebon', 'Penonton komedi garis keras.'],
        ];

        foreach ($data as [$name, $email, $umur, $alamat, $bio]) {
            $profile = Profile::create(['umur' => $umur, 'alamat' => $alamat, 'bio' => $bio]);

            User::create([
                'name' => $name,
                'email' => $email,
                'password' => '12345678',
                'email_verified_at' => now(),
                'role_id' => User::ROLE_USER,
                'profile_id' => $profile->id,
            ]);
        }
    }
}
