<?php

namespace Database\Seeders;

use App\Models\Cast;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CastSeeder extends Seeder
{
    public function run(): void
    {
        $nama = [
            'Reza Pratama', 'Dian Sastrowardoyo', 'Arya Wicaksono', 'Putri Maharani', 'Bima Santoso',
            'Nadia Kusuma', 'Fajar Ramadhan', 'Laras Wulandari', 'Dimas Anggara', 'Citra Lestari',
            'Gilang Permana', 'Anindya Putri', 'Rangga Saputra', 'Maya Safitri', 'Yoga Firmansyah',
            'Sekar Ayu', 'Bayu Nugroho', 'Kirana Dewi', 'Hendra Gunawan', 'Salsa Amelia',
            'Adit Prakoso', 'Tiara Andini', 'Rizky Hidayat', 'Nabila Zahra', 'Ferdi Kurniawan',
            'Ayu Ningsih', 'Wahyu Setiawan', 'Mutiara Sari', 'Eko Prasetyo', 'Alya Rahmawati',
            'Teguh Wibowo', 'Karina Salim', 'Bagas Mahendra', 'Intan Permata', 'Joko Susilo',
            'Rani Oktaviani', 'Andika Pratama', 'Sinta Maharani', 'Rudi Hartono', 'Vina Panduwinata',
            'Galih Ginanjar', 'Dewi Persik', 'Satria Utama', 'Melati Kusumawardani', 'Fikri Alamsyah',
            'Zahra Aulia', 'Ilham Syahputra', 'Bunga Citra', 'Tomi Irawan', 'Rahayu Lestari',
        ];

        $profesi = [
            'berakting sejak remaja dan dikenal lewat peran-peran dramatis',
            'memulai karier dari panggung teater kampus sebelum masuk layar lebar',
            'dikenal punya kemampuan komedi yang natural dan spontan',
            'sering memerankan karakter tangguh dan menjalani sendiri adegan aksinya',
            'pernah masuk nominasi penghargaan aktor pendukung terbaik',
            'aktif di dunia akting sekaligus pegiat kegiatan sosial',
            'lulusan sekolah seni peran yang gemar mendalami karakter',
            'populer berkat penampilan memukau di berbagai film independen',
        ];

        foreach ($nama as $i => $n) {
            Cast::create([
                'name' => Str::limit($n, 45, ''),
                'age' => 19 + (($i * 7) % 46),
                'bio' => $n . ' adalah aktor/aktris yang ' . $profesi[$i % count($profesi)] . '.',
            ]);
        }
    }
}
