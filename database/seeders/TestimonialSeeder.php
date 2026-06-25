<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'quote' => 'Sangat membantu untuk mengetahui info sekolah terbaru! Merdeka Warta jadi rujukan utama saya.',
                'author_name' => 'Budi',
                'author_role' => 'Siswa Kelas XI',
                'bg_color' => 'bg-secondary-fixed',
            ],
            [
                'quote' => 'ANJAY Desain beritanya sangat modern dan mudah dibaca oleh semua kalangan civitas akademika.',
                'author_name' => 'Ibu Siti',
                'author_role' => 'Guru',
                'bg_color' => 'bg-tertiary-fixed',
            ],
            [
                'quote' => 'Informasi pengumuman sekarang jauh lebih jelas dan transparan. Sukses terus untuk tim redaksi!',
                'author_name' => 'Rian',
                'author_role' => 'Alumni',
                'bg_color' => 'bg-primary-fixed',
            ],
            [
                'quote' => 'Saya bangga melihat prestasi siswa ditampilkan di sini. Ini motivasi besar bagi seluruh sekolah.',
                'author_name' => 'Bpk. Ahmad',
                'author_role' => 'Kepala Sekolah',
                'bg_color' => 'bg-surface-container',
            ],
        ];

        foreach ($testimonials as $data) {
            Testimonial::create(array_merge($data, [
                'is_active' => true,
            ]));
        }
    }
}
