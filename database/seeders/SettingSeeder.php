<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            ['key' => 'social_whatsapp', 'value' => '6281322263716'],
            ['key' => 'social_facebook', 'value' => 'smk_merdekabdg'],
            ['key' => 'social_youtube', 'value' => '54visualart36'],
            ['key' => 'social_instagram', 'value' => 'smk_merdekabdg'],
            ['key' => 'contact_address', 'value' => 'Jl. Pahlawan No. 54 Bandung'],
            ['key' => 'contact_phone', 'value' => '022-7201621 / 022-7216143'],
            ['key' => 'contact_email_primary', 'value' => 'info@smkmerdekabdg.sch.id'],
            ['key' => 'contact_email_secondary', 'value' => 'smksmerdekabdg@gmail.com'],
            ['key' => 'contact_hours', 'value' => 'Senin - Jumat, 06.45 - 17.00 WIB'],
            ['key' => 'contributor_phone', 'value' => '6281322263716'],
            ['key' => 'contributor_add_without_permission', 'value' => '1'],
            ['key' => 'contributor_delete_without_permission', 'value' => '1'],
            ['key' => 'contributor_edit_without_permission', 'value' => '1'],
        ];

        foreach ($settings as $data) {
            Setting::firstOrCreate(
                ['key' => $data['key']],
                ['value' => $data['value']]
            );
        }
    }
}
