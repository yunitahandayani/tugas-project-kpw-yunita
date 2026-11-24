<?php

namespace Database\Seeders;

use App\Models\Cast;
use App\Models\Film;
use App\Models\Peran;
use Illuminate\Database\Seeder;

class PeranSeeder extends Seeder
{
    public function run(): void
    {
        $castIds = Cast::pluck('id')->all();
        $tokoh = ['Raka', 'Sari', 'Bayu', 'Dinda', 'Arga', 'Maya', 'Tio', 'Laras', 'Joni', 'Ratna', 'Dewa', 'Kirana'];
        $jenis = ['Tokoh Utama', 'Pemeran Pendukung', 'Antagonis', 'Sahabat Tokoh Utama', 'Mentor', 'Cameo'];

        foreach (Film::pluck('id') as $n => $filmId) {
            $jumlah = 3 + ($n % 3); // 3 - 5 pemeran per film
            $start = ($n * 3) % count($castIds);

            for ($k = 0; $k < $jumlah; $k++) {
                Peran::create([
                    'film_id' => $filmId,
                    'cast_id' => $castIds[($start + $k * 7) % count($castIds)],
                    'actor' => $tokoh[($n + $k * 5) % count($tokoh)] . ' (' . $jenis[$k % count($jenis)] . ')',
                ]);
            }
        }
    }
}
