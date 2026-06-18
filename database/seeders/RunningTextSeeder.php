<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RunningText;

class RunningTextSeeder extends Seeder
{
    public function run(): void
    {
        $runningTexts = [
            ['text' => 'SMK Merdeka Bandung - Mencetak Generasi Unggul dan Berkarakter', 'is_active' => true, 'display_order' => 1],
            ['text' => 'Pendaftaran PPDB 2026/2027 telah dibuka! Kunjungi website kami.', 'is_active' => true, 'display_order' => 2],
            ['text' => 'Jangan lupa untuk selalu menjaga protokol kesehatan di lingkungan sekolah.', 'is_active' => true, 'display_order' => 3],
        ];

        foreach ($runningTexts as $data) {
            RunningText::create($data);
        }
    }
}