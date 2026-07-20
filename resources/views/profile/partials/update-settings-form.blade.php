@php
    $settings = [
        'social_whatsapp' => \App\Models\Setting::getValue('social_whatsapp', '6281322263716'),
        'social_facebook' => \App\Models\Setting::getValue('social_facebook', 'smk_merdekabdg'),
        'social_youtube' => \App\Models\Setting::getValue('social_youtube', 'UCOLjeUn3mdfIiPmS_IC3hvw'),
        'social_instagram' => \App\Models\Setting::getValue('social_instagram', 'smk_merdekabdg'),
        'contact_address' => \App\Models\Setting::getValue('contact_address', 'Jl. Pahlawan No. 54 Bandung'),
        'contact_phone' => \App\Models\Setting::getValue('contact_phone', '022-7201621 / 022-7216143'),
        'contact_email_primary' => \App\Models\Setting::getValue('contact_email_primary', 'info@smkmerdekabdg.sch.id'),
        'contact_email_secondary' => \App\Models\Setting::getValue('contact_email_secondary', 'smksmerdekabdg@gmail.com'),
        'contact_hours' => \App\Models\Setting::getValue('contact_hours', 'Senin - Jumat, 06.45 - 17.00 WIB'),
        'contributor_phone' => \App\Models\Setting::getValue('contributor_phone', '6281322263716'),
        'contributor_add_without_permission' => \App\Models\Setting::getValue('contributor_add_without_permission', '1'),
        'contributor_delete_without_permission' => \App\Models\Setting::getValue('contributor_delete_without_permission', '1'),
        'contributor_edit_without_permission' => \App\Models\Setting::getValue('contributor_edit_without_permission', '1'),
    ];
@endphp

<div class="admin-card p-6">
    <div class="flex items-center gap-3 mb-6 pb-4 border-b-3 border-on-background">
        <span class="w-8 h-8 bg-gradient-to-br from-primary to-secondary border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
            <span class="material-symbols-outlined text-white text-sm">settings</span>
        </span>
        <div>
            <h2 class="font-headline-lg text-lg uppercase tracking-tight">Media Sosial & Kontak</h2>
            <p class="font-label-mono text-[10px] text-on-surface-variant uppercase">Atur tautan media sosial, informasi kontak, dan nomor perizinan kontributor</p>
        </div>
    </div>

    <form method="post" action="{{ route('profile.settings.update') }}" class="space-y-6">
        @csrf
        @method('put')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">WhatsApp <span class="text-error">*</span></label>
                <input name="social_whatsapp" type="text" class="admin-input" value="{{ old('social_whatsapp', $settings['social_whatsapp']) }}" placeholder="6281322263716">
            </div>
            <div>
                <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Facebook</label>
                <input name="social_facebook" type="text" class="admin-input" value="{{ old('social_facebook', $settings['social_facebook']) }}" placeholder="smk_merdekabdg">
            </div>
            <div>
                <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">YouTube <span class="text-on-surface-variant">(@ handle)</span></label>
                <input name="social_youtube" type="text" class="admin-input" value="{{ old('social_youtube', $settings['social_youtube']) }}" placeholder="nama_channel">
            </div>
            <div>
                <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Instagram</label>
                <input name="social_instagram" type="text" class="admin-input" value="{{ old('social_instagram', $settings['social_instagram']) }}" placeholder="smk_merdekabdg">
            </div>
        </div>

        <div class="border-t-3 border-on-background pt-6">
            <h3 class="font-headline-lg text-base uppercase tracking-tight mb-4">Kontak</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Alamat</label>
                    <input name="contact_address" type="text" class="admin-input" value="{{ old('contact_address', $settings['contact_address']) }}" placeholder="Jl. Pahlawan No. 54 Bandung">
                </div>
                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Telepon</label>
                    <input name="contact_phone" type="text" class="admin-input" value="{{ old('contact_phone', $settings['contact_phone']) }}" placeholder="022-7201621 / 022-7216143">
                </div>
                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Jam Operasional</label>
                    <input name="contact_hours" type="text" class="admin-input" value="{{ old('contact_hours', $settings['contact_hours']) }}" placeholder="Senin - Jumat, 06.45 - 17.00 WIB">
                </div>
                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Email Utama</label>
                    <input name="contact_email_primary" type="email" class="admin-input" value="{{ old('contact_email_primary', $settings['contact_email_primary']) }}" placeholder="info@smkmerdekabdg.sch.id">
                </div>
                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Email Kedua</label>
                    <input name="contact_email_secondary" type="email" class="admin-input" value="{{ old('contact_email_secondary', $settings['contact_email_secondary']) }}" placeholder="smksmerdekabdg@gmail.com">
                </div>
            </div>
        </div>

        <div class="border-t-3 border-on-background pt-6">
            <h3 class="font-headline-lg text-base uppercase tracking-tight mb-4">Perizinan Kontributor</h3>
            <div class="space-y-4 max-w-xl">
                <div>
                    <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">No. WhatsApp <span class="text-error">*</span></label>
                    <input name="contributor_phone" type="text" class="admin-input" value="{{ old('contributor_phone', $settings['contributor_phone']) }}" placeholder="6281322263716">
                    <p class="mt-1 font-label-mono text-[10px] text-on-surface-variant">Nomor ini yang menerima permintaan kontributor dari siswa</p>
                </div>
                <div class="flex items-center justify-between gap-4 p-4 border-3 border-on-background bg-surface-container-low rounded-xl">
                    <div>
                        <p class="font-body-md text-sm font-bold text-on-surface">Tambah Artikel</p>
                        <p class="font-label-mono text-[10px] text-on-surface-variant">Izinkan kontributor menambahkan artikel tanpa perizinan</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="hidden" name="contributor_add_without_permission" value="0">
                        <input type="checkbox" name="contributor_add_without_permission" value="1" {{ $settings['contributor_add_without_permission'] === '1' ? 'checked' : '' }}>
                        <span class="toggle-slider">
                            <span class="toggle-text toggle-off">OFF</span>
                            <span class="toggle-text toggle-on">ON</span>
                        </span>
                    </label>
                </div>
                <div class="flex items-center justify-between gap-4 p-4 border-3 border-on-background bg-surface-container-low rounded-xl">
                    <div>
                        <p class="font-body-md text-sm font-bold text-on-surface">Hapus Artikel</p>
                        <p class="font-label-mono text-[10px] text-on-surface-variant">Izinkan kontributor menghapus artikel tanpa perizinan</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="hidden" name="contributor_delete_without_permission" value="0">
                        <input type="checkbox" name="contributor_delete_without_permission" value="1" {{ $settings['contributor_delete_without_permission'] === '1' ? 'checked' : '' }}>
                        <span class="toggle-slider">
                            <span class="toggle-text toggle-off">OFF</span>
                            <span class="toggle-text toggle-on">ON</span>
                        </span>
                    </label>
                </div>
                <div class="flex items-center justify-between gap-4 p-4 border-3 border-on-background bg-surface-container-low rounded-xl">
                    <div>
                        <p class="font-body-md text-sm font-bold text-on-surface">Edit Artikel</p>
                        <p class="font-label-mono text-[10px] text-on-surface-variant">Izinkan kontributor mengedit artikel tanpa perizinan</p>
                    </div>
                    <label class="toggle-switch">
                        <input type="hidden" name="contributor_edit_without_permission" value="0">
                        <input type="checkbox" name="contributor_edit_without_permission" value="1" {{ $settings['contributor_edit_without_permission'] === '1' ? 'checked' : '' }}>
                        <span class="toggle-slider">
                            <span class="toggle-text toggle-off">OFF</span>
                            <span class="toggle-text toggle-on">ON</span>
                        </span>
                    </label>
                </div>
            </div>
        </div>

        <style>
            .toggle-switch {
                position: relative;
                display: inline-block;
                width: 64px;
                height: 30px;
                flex-shrink: 0;
                cursor: pointer;
            }
            .toggle-switch input {
                opacity: 0;
                width: 0;
                height: 0;
                position: absolute;
            }
            .toggle-slider {
                position: absolute;
                inset: 0;
                background-color: #9ca3af;
                border: 3px solid #191c1d;
                border-radius: 999px;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 2px 2px 0px 0px rgba(0,0,0,1);
                display: flex;
                align-items: center;
                padding: 0 6px;
            }
            .toggle-slider::before {
                content: '';
                position: absolute;
                width: 18px;
                height: 18px;
                left: 3px;
                bottom: 3px;
                background-color: white;
                border: 2px solid #191c1d;
                border-radius: 50%;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 1px 1px 0px 0px rgba(0,0,0,0.3);
                z-index: 2;
            }
            .toggle-switch input:checked + .toggle-slider {
                background-color: #004ac6;
            }
            .toggle-switch input:checked + .toggle-slider::before {
                transform: translateX(34px);
                background-color: #fff;
            }
            .toggle-text {
                font-family: 'Inter', sans-serif;
                font-size: 9px;
                font-weight: 800;
                letter-spacing: 0.5px;
                text-transform: uppercase;
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                transition: opacity 0.2s ease;
                z-index: 1;
                line-height: 1;
            }
            .toggle-off {
                left: 8px;
                color: white;
                opacity: 1;
            }
            .toggle-on {
                right: 8px;
                color: white;
                opacity: 0;
            }
            .toggle-switch input:checked + .toggle-slider .toggle-off {
                opacity: 0;
            }
            .toggle-switch input:checked + .toggle-slider .toggle-on {
                opacity: 1;
            }
            .dark .toggle-slider {
                border-color: #fff;
                box-shadow: 2px 2px 0px 0px rgba(255,255,255,0.15);
            }
            .dark .toggle-slider::before {
                border-color: #fff;
                background-color: #e0e0e0;
            }
            .dark .toggle-switch input:checked + .toggle-slider {
                background-color: #3b82f6;
            }
        </style>

        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="admin-btn-primary">
                <span class="material-symbols-outlined text-sm">save</span>
                Simpan Pengaturan
            </button>

            @if (session('status') === 'settings-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="font-label-mono text-xs text-green-700">
                    Tersimpan.
                </p>
            @endif
        </div>
    </form>
</div>
