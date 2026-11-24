<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Kritik;
use App\Models\User;
use Illuminate\Database\Seeder;

class KritikSeeder extends Seeder
{
    public function run(): void
    {
        // [rating, komentar]
        $komentar = [
            [5, 'Film yang luar biasa! Alurnya rapi dan akting para pemainnya meyakinkan dari awal sampai akhir.'],
            [5, 'Salah satu film terbaik yang pernah saya tonton tahun ini. Wajib ditonton bareng keluarga.'],
            [5, 'Sinematografinya indah dan musik latarnya pas banget. Saya sampai menontonnya dua kali.'],
            [4, 'Ceritanya seru dan penuh kejutan. Hanya saja di bagian tengah tempo sedikit melambat.'],
            [4, 'Bagus! Karakter-karakternya terasa hidup dan dialognya enak diikuti.'],
            [4, 'Hiburan yang menyenangkan. Endingnya cukup memuaskan walau ada beberapa bagian yang bisa lebih digali.'],
            [4, 'Visualnya memanjakan mata dan ceritanya mudah dinikmati. Rekomendasi untuk akhir pekan.'],
            [3, 'Lumayan, cukup menghibur tapi ceritanya agak mudah ditebak.'],
            [3, 'Ide ceritanya menarik, namun eksekusinya biasa saja. Masih layak ditonton sekali.'],
            [3, 'Aktingnya bagus, tapi naskahnya terasa kurang tajam di beberapa adegan.'],
            [2, 'Sayang sekali, premisnya menjanjikan tetapi pengembangan ceritanya kurang matang.'],
            [2, 'Terlalu banyak adegan yang berlarut-larut, jadi sedikit membosankan.'],
            [1, 'Kurang cocok buat saya. Ceritanya membingungkan dan tidak banyak yang berkesan.'],
        ];

        $userIds = User::where('role_id', User::ROLE_USER)->pluck('id')->all();
        if (empty($userIds)) {
            return;
        }

        foreach (Film::pluck('id') as $n => $filmId) {
            $jumlah = 2 + ($n % 4); // 2 - 5 komentar per film
            for ($k = 0; $k < $jumlah; $k++) {
                // peluang rating tinggi dibuat lebih besar (indeks awal = rating tinggi)
                $idx = (($n * 5) + ($k * 4) + ($n % 3)) % count($komentar);
                [$rating, $teks] = $komentar[$idx];

                Kritik::create([
                    'film_id' => $filmId,
                    'user_id' => $userIds[($n + $k * 3) % count($userIds)],
                    'rating' => $rating,
                    'comment' => $teks,
                ]);
            }
        }
    }
}
