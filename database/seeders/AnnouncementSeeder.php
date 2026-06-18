<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Announcement;
use Carbon\Carbon;

class AnnouncementSeeder extends Seeder
{
    public function run(): void
    {
        $announcements = [
            [
                'title' => 'Libur Hari Raya Idul Fitri 1447 H',
                'content' => json_encode([
                    'blocks' => [
                        ['type' => 'header', 'data' => ['text' => 'Informasi Libur Hari Raya', 'level' => 2]],
                        ['type' => 'paragraph', 'data' => ['text' => 'Sehubungan dengan Hari Raya Idul Fitri 1447 H, kegiatan belajar mengajar diliburkan mulai tanggal 10-14 April 2026. #Libur #IdulFitri #SMKMerdeka']],
                        ['type' => 'list', 'data' => ['style' => 'unordered', 'items' => ['Libur dimulai: 10 April 2026', 'Masuk kembali: 15 April 2026', 'Kegiatan tambahan: tidak ada']]],
                        ['type' => 'paragraph', 'data' => ['text' => 'Selamat Hari Raya Idul Fitri, mohon maaf lahir dan batin. #Lebaran #MinalAidinWalFaizin']],
                    ]
                ]),
                'type' => 'important',
                'is_active' => true,
                'expired_at' => Carbon::now()->addDays(7),
            ],
            [
                'title' => 'Rapat Orang Tua Siswa Semester Genap',
                'content' => json_encode([
                    'blocks' => [
                        ['type' => 'header', 'data' => ['text' => 'Undangan Rapat Orang Tua', 'level' => 2]],
                        ['type' => 'paragraph', 'data' => ['text' => 'Rapat orang tua siswa akan dilaksanakan pada hari Sabtu, 25 April 2026 pukul 09.00 di Aula Sekolah. #Rapat #OrangTua #SMKMerdeka']],
                        ['type' => 'header', 'data' => ['text' => 'Agenda Rapat', 'level' => 3]],
                        ['type' => 'list', 'data' => ['style' => 'ordered', 'items' => ['Laporan perkembangan akademik semester genap', 'Sosialisasi program magang industri', 'Pemaparan kegiatan ekstrakurikuler', 'Sesi tanya jawab']]],
                        ['type' => 'paragraph', 'data' => ['text' => 'Kehadiran orang tua/wali sangat diharapkan. Konfirmasi kehadiran melalui formulir online yang telah dikirimkan. #Pendidikan #Kerjasama']],
                    ]
                ]),
                'type' => 'info',
                'is_active' => true,
                'expired_at' => Carbon::now()->addDays(14),
            ],
            [
                'title' => 'Perubahan Jadwal Ujian Akhir Semester',
                'content' => json_encode([
                    'blocks' => [
                        ['type' => 'header', 'data' => ['text' => 'Pemberitahuan Perubahan Jadwal', 'level' => 2]],
                        ['type' => 'paragraph', 'data' => ['text' => 'Jadwal ujian akhir semester genap mengalami perubahan. Mohon perhatikan jadwal terbaru berikut ini. #Ujian #Jadwal #Penting']],
                        ['type' => 'header', 'data' => ['text' => 'Jadwal Baru', 'level' => 3]],
                        ['type' => 'list', 'data' => ['style' => 'ordered', 'items' => ['Senin, 1 Juni: Matematika', 'Selasa, 2 Juni: Bahasa Indonesia', 'Rabu, 3 Juni: Bahasa Inggris', 'Kamis, 4 Juni: Produktif']]],
                        ['type' => 'paragraph', 'data' => ['text' => 'Harap diperhatikan perubahan ini dan persiapkan diri sebaik mungkin. #SemangatUjian #Belajar']],
                    ]
                ]),
                'type' => 'warning',
                'is_active' => true,
                'expired_at' => Carbon::now()->addDays(5),
            ],
            [
                'title' => 'Pendaftaran Ekstrakurikuler Semester Baru',
                'content' => json_encode([
                    'blocks' => [
                        ['type' => 'header', 'data' => ['text' => 'Informasi Ekstrakurikuler', 'level' => 2]],
                        ['type' => 'paragraph', 'data' => ['text' => 'Pendaftaran ekstrakurikuler semester baru dibuka! Ayo ikuti kegiatan seru di luar jam belajar. #Ekstrakurikuler #SMKMerdeka #Aktif']],
                        ['type' => 'list', 'data' => ['style' => 'unordered', 'items' => ['Pendaftaran online: 1-15 April 2026', 'Program unggulan: Robotik, Futsal, Seni Tari', 'Kuota terbatas, daftar segera!']]],
                    ]
                ]),
                'type' => 'info',
                'is_active' => true,
                'expired_at' => Carbon::now()->addDays(20),
            ],
            [
                'title' => 'Pengumuman Kelulusan Tahun Ajaran 2025/2026',
                'content' => json_encode([
                    'blocks' => [
                        ['type' => 'header', 'data' => ['text' => 'Informasi Kelulusan', 'level' => 2]],
                        ['type' => 'paragraph', 'data' => ['text' => 'Pengumuman kelulusan siswa kelas XII tahun ajaran 2025/2026 akan disampaikan pada tanggal 30 Juni 2026 pukul 10.00 WIB. #Kelulusan #Lulus #SMKMerdeka']],
                        ['type' => 'paragraph', 'data' => ['text' => 'Pengumuman dapat diakses melalui website resmi sekolah dan papan pengumuman. #Pengumuman #Siswa']],
                        ['type' => 'quote', 'data' => ['text' => 'Selamat kepada seluruh siswa kelas XII. Teruslah berkarya dan jadilah kebanggaan keluarga, agama, dan bangsa.', 'caption' => 'Kepala SMK Merdeka']],
                    ]
                ]),
                'type' => 'important',
                'is_active' => true,
                'expired_at' => Carbon::now()->addDays(30),
            ],
        ];

        foreach ($announcements as $data) {
            Announcement::create($data);
        }
    }
}