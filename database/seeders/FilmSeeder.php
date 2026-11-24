<?php

namespace Database\Seeders;

use App\Models\Film;
use App\Models\Genre;
use Illuminate\Database\Seeder;

class FilmSeeder extends Seeder
{
    /**
     * Tiga variasi alur cerita per genre (dipilih bergantian) supaya
     * sinopsis tiap film terasa berbeda dan nyambung dengan genrenya.
     */
    private array $plot = [
        'Action' => [
            'Seorang mantan agen khusus terpaksa kembali bertugas ketika organisasi lamanya diserang. Dalam hitungan jam, ia harus menembus kota yang dikuasai musuh demi menyelamatkan orang-orang yang ia sayangi.',
            'Sebuah misi penyelamatan berubah menjadi perburuan tanpa henti. Tim kecil yang tersisa harus bertahan dari kejaran dan membongkar siapa pengkhianat di antara mereka.',
            'Ketika sebuah kota diteror kelompok bersenjata, seorang polisi muda mengambil keputusan nekat: melawan sendirian sebelum bala bantuan tiba.',
        ],
        'Biography' => [
            'Film ini menelusuri perjalanan hidup seorang tokoh biasa yang menempuh jalan terjal hingga menjadi inspirasi banyak orang, lengkap dengan jatuh bangun yang membentuk dirinya.',
            'Dari masa kecil yang sederhana hingga puncak pencapaian, kisah nyata ini menunjukkan harga sebuah keyakinan dan pengorbanan.',
            'Berdasarkan kisah nyata, film ini merekam pergulatan batin seorang pemimpin dalam mengambil keputusan paling berat sepanjang hidupnya.',
        ],
        'Crime' => [
            'Seorang detektif menyelidiki rangkaian pencurian yang rapi dan nyaris tanpa jejak. Semakin dalam ia menggali, semakin dekat ia dengan orang-orang di lingkarannya sendiri.',
            'Pertemuan tak sengaja dengan seorang pelaku kriminal menyeret seorang pegawai biasa ke dunia gelap yang penuh pengkhianatan.',
            'Kasus lama yang sudah ditutup tiba-tiba terbuka kembali setelah bukti baru muncul, memaksa penyidik menghadapi kebenaran yang tak nyaman.',
        ],
        'Family' => [
            'Menjelang hari raya, sebuah keluarga besar berkumpul dan harus menyelesaikan salah paham lama yang diam-diam memisahkan mereka.',
            'Petualangan sederhana seorang anak bersama keluarganya mengajarkan arti kebersamaan, kejujuran, dan saling menjaga.',
            'Ketika sang ayah kehilangan pekerjaan, seluruh anggota keluarga belajar saling mendukung dan menemukan kebahagiaan dalam hal-hal kecil.',
        ],
        'Horror' => [
            'Sebuah keluarga pindah ke rumah tua yang menyimpan rahasia kelam. Malam demi malam, kejadian janggal membuat mereka sadar bahwa mereka tidak sendirian.',
            'Sekelompok teman yang berkemah di hutan terpencil mulai diteror sosok misterius. Satu per satu dari mereka menghilang tanpa sebab.',
            'Sebuah rekaman tua yang ditemukan di loteng membawa kutukan yang menuntut korban berikutnya setiap kali diputar.',
        ],
        'Romance' => [
            'Dua orang asing bertemu di stasiun kereta pada hari hujan. Pertemuan singkat itu membuka kisah cinta yang diuji oleh jarak dan waktu.',
            'Sahabat sejak kecil baru menyadari perasaan mereka ketika salah satunya harus pergi jauh untuk mengejar mimpi.',
            'Seorang penulis muda jatuh cinta pada pembaca setianya, tanpa tahu bahwa ia menyimpan rahasia yang bisa mengubah segalanya.',
        ],
        'Sports' => [
            'Tim yang selalu diremehkan mendapat kesempatan terakhir untuk tampil di final. Dengan pelatih baru yang keras, mereka belajar bahwa kemenangan dimulai dari disiplin.',
            'Seorang atlet yang pernah cedera parah bangkit dan berlatih keras demi satu kesempatan kembali ke arena.',
            'Dari lapangan desa hingga turnamen nasional, perjalanan sekelompok remaja membuktikan bahwa kerja sama mengalahkan bakat semata.',
        ],
        'War' => [
            'Di tengah pertempuran yang berkecamuk, sebuah pleton kecil harus menahan posisi sambil menunggu bantuan yang tak kunjung datang.',
            'Kisah seorang prajurit muda yang dipaksa dewasa lebih cepat, menyaksikan harga perang bagi orang-orang di sekitarnya.',
            'Dua tentara dari pihak berseberangan terjebak di wilayah yang sama dan harus memilih antara bertarung atau bertahan hidup bersama.',
        ],
        'Adventure' => [
            'Sekelompok penjelajah menempuh hutan dan gunung untuk mencari peta kuno yang konon menuntun ke harta yang hilang.',
            'Perjalanan melintasi samudra membawa sang tokoh utama bertemu bahaya, sahabat baru, dan rahasia tentang asal-usul keluarganya.',
            'Liburan sekolah berubah menjadi ekspedisi tak terduga ketika tiga sahabat menemukan gua yang tidak tercantum di peta mana pun.',
        ],
        'Comedy' => [
            'Salah paham kecil di hari pernikahan berkembang menjadi rentetan kekacauan yang mengocok perut seluruh tamu.',
            'Dua rekan kerja yang saling bertolak belakang dipaksa menjalankan proyek bersama, dan semuanya berantakan dengan cara paling lucu.',
            'Seorang ibu rumah tangga yang lelah memutuskan memberontak dari rutinitas, dan petualangan konyolnya mengubah hidup seisi lingkungan.',
        ],
        'Documentary' => [
            'Dokumenter ini menyorot kehidupan sehari-hari masyarakat yang menjaga tradisi di tengah perubahan zaman.',
            'Dengan wawancara dan rekaman langka, film ini mengungkap proses di balik sebuah peristiwa yang mengubah banyak kehidupan.',
            'Kamera mengikuti perjalanan para peneliti selama bertahun-tahun, menunjukkan sisi alam yang jarang terlihat.',
        ],
        'Fantasy' => [
            'Seorang anak menemukan pintu rahasia menuju dunia sihir yang sedang terancam, dan hanya dialah yang bisa menyelamatkannya.',
            'Di negeri yang dihuni makhluk legenda, seorang pemuda biasa ditakdirkan memegang kekuatan yang diperebutkan banyak pihak.',
            'Sebuah buku tua membangkitkan makhluk-makhluk dari dongeng, dan para tokohnya harus mengembalikan semuanya sebelum fajar.',
        ],
        'Thriller' => [
            'Sekelompok orang terkurung di sebuah gedung tanpa jalan keluar, dan satu per satu mulai saling curiga siapa yang mengendalikan permainan ini.',
            'Pesan tanpa nama terus datang ke ponsel seorang jurnalis, mengarahkannya ke rahasia besar yang ingin dikubur banyak orang.',
            'Dalam satu malam, seorang saksi mata harus bertahan dari orang-orang yang tidak ingin ia bicara.',
        ],
        'Animation' => [
            'Sekawanan hewan yang kocak berpetualang mencari rumah baru ketika habitat mereka berubah, belajar bahwa persahabatan adalah tempat pulang terbaik.',
            'Robot kecil yang polos menemukan arti perasaan lewat persahabatan dengan seorang anak penyendiri.',
            'Di dunia penuh warna, seekor naga muda yang takut api harus menemukan keberaniannya demi menyelamatkan desa.',
        ],
        'Costume' => [
            'Di lingkungan istana yang penuh intrik, seorang putri muda harus pandai membaca siasat demi menyelamatkan kerajaannya.',
            'Kisah cinta terlarang antara seorang bangsawan dan rakyat jelata di zaman kerajaan, ketika adat lebih berkuasa daripada hati.',
            'Seorang panglima setia dihadapkan pada pilihan sulit antara sumpah kepada raja dan keselamatan rakyatnya.',
        ],
        'Drama' => [
            'Seorang ayah berjuang memperbaiki hubungan dengan anaknya setelah bertahun-tahun terpisah oleh keadaan.',
            'Kehilangan orang tercinta membuat sebuah keluarga belajar kembali mengenal satu sama lain dan menerima kenyataan.',
            'Seorang guru di daerah terpencil bertahan demi murid-muridnya, meski sekolah nyaris ditutup.',
        ],
        'History' => [
            'Film ini menghidupkan kembali peristiwa bersejarah yang mengubah arah sebuah bangsa, dilihat dari mata orang-orang biasa.',
            'Perjuangan para tokoh pergerakan merebut kemerdekaan, dengan segala pengorbanan dan perbedaan pandangan di antara mereka.',
            'Menyusuri jejak masa lalu, seorang sejarawan muda menemukan catatan yang membuka sisi lain dari sebuah peristiwa besar.',
        ],
        'Musical' => [
            'Seorang penyanyi jalanan mengejar mimpi tampil di panggung besar, ditemani lagu-lagu yang mengungkap kisah hidupnya.',
            'Sebuah grup musik sekolah berjuang menyelamatkan ruang latihan mereka lewat satu konser yang menentukan.',
            'Nada dan tarian menjadi bahasa dua insan dari dunia berbeda yang saling jatuh cinta di atas panggung.',
        ],
        'Psychological' => [
            'Seorang wanita mulai meragukan ingatannya sendiri ketika hal-hal kecil di sekelilingnya perlahan berubah tanpa penjelasan.',
            'Seorang psikolog menangani pasien misterius, dan batas antara kenyataan dan khayalan makin kabur bagi keduanya.',
            'Setelah sebuah kecelakaan, seorang pria mendengar suara-suara yang mengungkap rahasia yang selama ini ia kubur.',
        ],
    ];

    public function run(): void
    {
        $genres = Genre::pluck('name', 'id');

        $csv = fopen(base_path('database/data/movies.csv'), 'r');
        $first = true;
        $i = 0;

        while (($row = fgetcsv($csv, 500, ';')) !== false) {
            if ($first) {
                $first = false;
                continue;
            }
            if (count($row) < 4) {
                continue;
            }

            [$poster, $title, $year, $genreId] = $row;
            $genreName = $genres[(int) $genreId] ?? 'Drama';
            $plots = $this->plot[$genreName] ?? $this->plot['Drama'];

            Film::create([
                // gambar poster ada di public/template/images
                'poster' => str_replace('storage/images/', 'template/images/', $poster),
                'title' => $title,
                'year' => (int) $year,
                'genre_id' => (int) $genreId,
                'sinopsis' => $title . ' (' . $year . '), film ' . $genreName . '. ' . $plots[$i % 3],
            ]);
            $i++;
        }

        fclose($csv);
    }
}
