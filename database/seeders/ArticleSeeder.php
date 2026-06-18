<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        $images = [
            'https://lh3.googleusercontent.com/aida-public/AB6AXuA5qafomWEoZRrPlO0EM_z8xJBZNw5Gioj3pi5v2IG8UMWh_unnGvHTcEIAPrhIp_sDkiFNCGMnawNHRU8sz7pFvGanj4urgROIuCsgK7hliSVhFqz3kbOddzBAckJMG8StEKBv2NXZM8GrdhgmoK4jzXkeiZ7RjQ8zjOcUMN1xwa9xRV_n1qCoid7u4CaB9PcqbYwD8k_4t7OValt35jXUXdcPzvQL1hNRGW8B-rFXpKASPYO-uFud61OuA3VWWz8r2CudG0RfHRSB',
            'https://lh3.googleusercontent.com/aida-public/AB6AXuCsMMxBC6t89E1Kk1j3hpe4auQhd-jlFPk72uANi4nrLzsACvr0k3N5jsPCMB_Gt8Hood0tFzmdBGSDVyMhHUlXCvDn4UB1-GyWVlyc8sgy3_zQN-pf6GKRlraJcq6wzjMNKCPNnQwQYFNIxOA7BaGO4n0-8tTZoMYgq4n5jS23JqeUEpzpp91bkRAKh_7ljf-vklMk9c7G4uXVr2vIK-ptxE_UPCFZaOb3tuM9K8Al7CcjOvnEtZBiYqaD04ImM-CY9rR9VfIAJLua',
            'https://lh3.googleusercontent.com/aida-public/AB6AXuAi7wqtjz9yKKHTtIBABtJFrBYBYWM0VcqN0a93n9PDYbD3pn5xUNK3IaThAB2zqaiNcQL9ZjDLBmAb0EYAubEmxmfN1PvShIoF9zlvZJzuwD8LjIG5NXBWK37-3NubUjFamkMgpae6kIGcfUdHUuyzjNRObsvNTrrNok9Iu_NAOwEQ632NPaZYo-QWIdLnFkia14sBjRx6bgOxm6AswaB8j5kGAVCMwd4HIs5iI-sgjY_XfPvCwUMNkwvzBVOKvzCZo7FXa0iRp6w-',
            'https://lh3.googleusercontent.com/aida-public/AB6AXuDgYcRA_rQeMC7B-3IHMzx6kRAMwGrmGK1tUFM_NJUCNowRJzorlzW_Iu2rYUz1b3Rryve3Iyv6HMbf42aQZYE78QPqjgWHu4k2kdySjsstjKW51YShXBDVMRkA1yvfR8sg7us5NCobl1II8HIfvFN1m3EXsPE1vccdCNUyvXAZNGoLj_yOSqpSY_f-AnkpvtPiNysbLckH4P4lUONgF5ccXgE7p02tDWYXOe_977SneGWNxUdaEPgJcn-JSnQrXli0Et1mN-gBlVF8',
            'https://lh3.googleusercontent.com/aida-public/AB6AXuD532YT8KNnhZZb3XN58xC127kxh24sA3I70kbKuxiCJFpSPly38n5NmpIQdEkVoHkrXgUpe50ctu3bPtwtLCrciRpXbyEKYOVskyls3bWIwsSegMgHrBd0APwqe1UVHhehQsf1oS1ucWJlRG2Q7WtTQeQ5-7bdyTf_mRmvnBmqjQYtcZDKsvf-derX_GrB3NVH2rYYMEKqyZ6jxAZ1vY_RZ_q3uUB3sDsi3mlalhXIABXoIjBL3nB9pX755VKhxf9tsj0uFYz30ejY',
            'https://lh3.googleusercontent.com/aida-public/AB6AXuAvWZU1zctQ6AHqdoqtuMPK78gSUTB4cNovAFhehwGCpQZr1x7Q6lufjlrGu90zAavogcIUQ2UnBLxp19YqRFe_BhzQ8rEPtKbwDCGiQp7gRCpppCNTuozEDGIYJgoRVOt6ACsE6YIaTjtdThqcTF71jg8jq8fKtZPcz1hiUs3CSkMtPppd8UqM0EJO71lEo6QHNtZqeHQXM5iJjAA1ujfe43Zfwqxuna8prnT_vOFN5uDI2MwZP-k6ACK8_j6vpHP3RrgZCkHDdoPg',
        ];

        $articles = [
            [
                'title' => 'Selamat Datang di SMK Merdeka Bandung',
                'slug' => 'selamat-datang-di-smk-merdeka-bandung',
                'content' => json_encode([
                    'blocks' => [
                        ['type' => 'header', 'data' => ['text' => 'Selamat Datang di SMK Merdeka Bandung', 'level' => 2]],
                        ['type' => 'paragraph', 'data' => ['text' => 'SMK Merdeka Bandung adalah sekolah menengah kejuruan unggulan di Kota Bandung yang berkomitmen mencetak lulusan siap kerja.']],
                        ['type' => 'paragraph', 'data' => ['text' => 'Kami memiliki berbagai program keahlian yang relevan dengan kebutuhan industri saat ini.']],
                    ]
                ]),
                'published_at' => Carbon::now()->subDays(10),
                'is_published' => true,
                'category' => 'Berita',
            ],
            [
                'title' => 'Penerimaan Peserta Didik Baru 2026/2027',
                'slug' => 'ppdb-2026-2027',
                'content' => json_encode([
                    'blocks' => [
                        ['type' => 'header', 'data' => ['text' => 'PPDB SMK Merdeka 2026/2027', 'level' => 2]],
                        ['type' => 'paragraph', 'data' => ['text' => 'Pendaftaran peserta didik baru tahun ajaran 2026/2027 telah resmi dibuka! Segera daftarkan diri kamu dan raih masa depan gemilang di SMK Merdeka. #PPDB #SMKMerdeka #PendidikanVokasi']],
                        ['type' => 'header', 'data' => ['text' => 'Persyaratan Pendaftaran', 'level' => 3]],
                        ['type' => 'list', 'data' => ['style' => 'ordered', 'items' => ['Ijazah/SKL SMP/MTs', 'Fotokopi KK dan Akta Kelahiran', 'Pas foto 3x4 (2 lembar)', 'Raport semester 1-5']]],
                        ['type' => 'paragraph', 'data' => ['text' => 'Pendaftaran dilaksanakan secara online melalui portal resmi sekolah. Jadwal tes masuk akan diumumkan setelah masa pendaftaran ditutup. #Pendaftaran #PPDB2026']]],
                ]),
                'published_at' => Carbon::now()->subDays(5),
                'is_published' => true,
                'category' => 'Pengumuman',
            ],
            [
                'title' => 'Tim Robotik SMK Merdeka Juara Nasional',
                'slug' => 'tim-robotik-juara-nasional',
                'content' => json_encode([
                    'blocks' => [
                        ['type' => 'paragraph', 'data' => ['text' => 'SMK Merdeka kembali menorehkan tinta emas di kancah nasional. Kali ini, tim robotik sekolah berhasil meraih juara pertama dalam kompetisi Inovasi Energi Terbarukan tingkat Nasional yang diselenggarakan di Jakarta pekan lalu. #Prestasi #Robotik #SMKMerdeka']],
                        ['type' => 'paragraph', 'data' => ['text' => 'Keberhasilan ini diraih melalui proyek berjudul "Smart School Energy". Sistem ini mengintegrasikan panel surya dengan algoritma optimasi berbasis AI untuk mengatur penggunaan listrik di lingkungan sekolah secara otomatis. Proyek ini berhasil mengalahkan ratusan peserta dari berbagai SMK dan SMA unggulan di seluruh Indonesia. #Inovasi #EnergiTerbarukan']],
                        ['type' => 'header', 'data' => ['text' => 'Fitur Utama Smart School Energy', 'level' => 3]],
                        ['type' => 'list', 'data' => ['style' => 'unordered', 'items' => ['Optimasi Pencahayaan Real-time', 'Monitoring Panel Surya IoT', 'Prediksi Konsumsi Energi Mingguan']]],
                        ['type' => 'paragraph', 'data' => ['text' => 'Kepala Sekolah SMK Merdeka, Drs. Ahmad Wijaya, menyatakan kebanggaannya dalam sesi wawancara. Beliau menekankan bahwa prestasi ini merupakan bukti nyata bahwa kurikulum berbasis proyek (PBL) yang diterapkan sekolah sangat efektif.']],
                        ['type' => 'quote', 'data' => ['text' => 'Penghargaan ini bukan hanya tentang piala, tapi tentang bagaimana siswa-siswi kita mampu menjawab tantangan krisis energi global melalui solusi yang praktis dan aplikatif. Kami akan terus mendukung inovasi siswa di segala bidang.', 'caption' => 'Drs. Ahmad Wijaya, Kepala Sekolah SMK Merdeka']],
                        ['type' => 'paragraph', 'data' => ['text' => 'Tim yang terdiri dari lima siswa jurusan Elektronika dan Rekayasa Perangkat Lunak ini telah mengerjakan proyek tersebut selama enam bulan. Ke depannya, pihak sekolah berencana untuk mengimplementasikan sistem "Smart School Energy" secara penuh di seluruh gedung sekolah untuk mengurangi emisi karbon secara signifikan. #Lingkungan #Berkelanjutan']],
                        ['type' => 'delimiter', 'data' => []],
                        ['type' => 'header', 'data' => ['text' => 'Checklist Persiapan Implementasi', 'level' => 4]],
                        ['type' => 'checklist', 'data' => ['items' => [
                            ['text' => 'Instalasi panel surya di atap gedung A', 'checked' => true],
                            ['text' => 'Pemasangan sensor IoT di 12 ruang kelas', 'checked' => true],
                            ['text' => 'Pelatihan penggunaan sistem untuk teknisi sekolah', 'checked' => false],
                            ['text' => 'Integrasi dengan sistem pencahayaan existing', 'checked' => false],
                        ]]],
                    ]
                ]),
                'published_at' => Carbon::now()->subDays(3),
                'is_published' => true,
                'category' => 'Prestasi',
            ],
            [
                'title' => 'Peresmian Laboratorium Teknik Baru',
                'slug' => 'peresmian-lab-teknik-baru',
                'content' => json_encode([
                    'blocks' => [
                        ['type' => 'header', 'data' => ['text' => 'Lab Teknik Kelas Industri', 'level' => 2]],
                        ['type' => 'paragraph', 'data' => ['text' => 'SMK Merdeka meresmikan laboratorium teknik terbaru bekerja sama dengan perusahaan teknologi global.']],
                        ['type' => 'paragraph', 'data' => ['text' => 'Lab ini memiliki standar industri internasional untuk mendukung pembelajaran siswa.']],
                    ]
                ]),
                'published_at' => Carbon::now()->subDays(7),
                'is_published' => true,
                'category' => 'Berita',
            ],
            [
                'title' => 'Kisah Alumni: Dari SMK Menuju Karir Global',
                'slug' => 'alumni-karir-global',
                'content' => json_encode([
                    'blocks' => [
                        ['type' => 'header', 'data' => ['text' => 'Inspirasi Alumni SMK', 'level' => 2]],
                        ['type' => 'paragraph', 'data' => ['text' => 'Simak kisah inspiratif alumni SMK Merdeka yang kini sukses berkarir di Tokyo dan Silicon Valley.']],
                        ['type' => 'paragraph', 'data' => ['text' => 'Mereka membuktikan bahwa lulusan SMK mampu bersaing di kancah global.']],
                    ]
                ]),
                'published_at' => Carbon::now()->subDays(12),
                'is_published' => true,
                'category' => 'Alumni',
            ],
            [
                'title' => 'Festival Seni Akhir Tahun 2026',
                'slug' => 'festival-seni-2026',
                'content' => json_encode([
                    'blocks' => [
                        ['type' => 'header', 'data' => ['text' => 'Keseruan Festival Seni Akhir Tahun', 'level' => 2]],
                        ['type' => 'paragraph', 'data' => ['text' => 'Momen-momen terbaik dari pertunjukan drama dan pameran lukisan siswa kelas XII dalam Festival Seni Akhir Tahun. #FestivalSeni #Kreativitas #SMKMerdeka']],
                        ['type' => 'paragraph', 'data' => ['text' => 'Acara tahunan ini menjadi ajang kreativitas siswa SMK Merdeka yang dinanti-nantikan oleh seluruh warga sekolah. #Seni #Budaya']],
                        ['type' => 'quote', 'data' => ['text' => 'Seni adalah jendela jiwa. Festival ini membuktikan bahwa siswa SMK Merdeka tidak hanya unggul di bidang teknologi, tetapi juga kaya akan kreativitas.', 'caption' => 'Pembina Seni SMK Merdeka']],
                    ]
                ]),
                'published_at' => Carbon::now()->subDays(15),
                'is_published' => true,
                'category' => 'Event',
            ],
        ];

        $extraTitles = [
            ['title' => 'Workshop Robotik untuk Pemula', 'category' => 'Event'],
            ['title' => 'Kunjungan Industri ke PT Teknologi Nusantara', 'category' => 'Berita'],
            ['title' => 'Lomba Desain Grafis Antar Kelas', 'category' => 'Event'],
            ['title' => 'Pelatihan Jurnalistik untuk Siswa', 'category' => 'Opini'],
            ['title' => 'SMK Merdeka Go Green: Program Penghijauan', 'category' => 'Berita'],
            ['title' => 'Peringatan Hari Guru Nasional 2026', 'category' => 'Event'],
            ['title' => 'Tes Kebugaran Jasmani Semester Genap', 'category' => 'Pengumuman'],
            ['title' => 'Studi Banding ke SMK Unggulan Jakarta', 'category' => 'Berita'],
            ['title' => 'Peluncuran Website Baru Sekolah', 'category' => 'Berita'],
            ['title' => 'Kegiatan Bakti Sosial di Panti Asuhan', 'category' => 'Event'],
            ['title' => 'Tips Sukses Menghadapi Ujian Akhir', 'category' => 'Opini'],
            ['title' => 'Rekrutmen Anggota OSIS Periode Baru', 'category' => 'Pengumuman'],
            ['title' => 'Seminar Karir bersama Alumni Sukses', 'category' => 'Event'],
            ['title' => 'Peringatan Bulan Bahasa di SMK Merdeka', 'category' => 'Event'],
            ['title' => 'Kelas Inspirasi: Belajar dari Profesional', 'category' => 'Berita'],
        ];

        foreach ($extraTitles as $i => $item) {
            $slug = Str::slug($item['title']);
            $articles[] = [
                'title' => $item['title'],
                'slug' => $slug,
                'content' => json_encode([
                    'blocks' => [
                        ['type' => 'header', 'data' => ['text' => $item['title'], 'level' => 2]],
                        ['type' => 'paragraph', 'data' => ['text' => "SMK Merdeka kembali mengadakan kegiatan {$item['title']} yang bertujuan untuk meningkatkan kompetensi siswa. #SMKMerdeka #{$item['category']}"]],
                        ['type' => 'paragraph', 'data' => ['text' => "Kegiatan ini diikuti oleh seluruh siswa yang antusias dan mendapatkan respon positif dari berbagai pihak. #KegiatanSekolah #Prestasi"]],
                    ]
                ]),
                'published_at' => Carbon::now()->subDays(rand(1, 60)),
                'is_published' => true,
                'category' => $item['category'],
            ];
        }

        foreach ($articles as $i => $data) {
            $article = new Article($data);
            $article->image = $images[$i % count($images)];
            $article->user_id = $users->random()->id;
            $article->save();
        }
    }
}
