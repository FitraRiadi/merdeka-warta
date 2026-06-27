<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RunningText;

class RunningTextSeeder extends Seeder
{
    public function run(): void
    {
        $runningTexts = [
            ['text' => 'SMK Merdeka Bandung - Mencetak Generasi Unggul dan Berkarakter'],
            ['text' => 'Pendaftaran PPDB 2026/2027 telah dibuka! Kunjungi website kami.'],
            ['text' => 'Jangan lupa untuk selalu menjaga protokol kesehatan di lingkungan sekolah.'],
        ];

        foreach ($runningTexts as $data) {
            RunningText::create($data);
        }
    }
}