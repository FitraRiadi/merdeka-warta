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
            <div>
                <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">No. WhatsApp <span class="text-error">*</span></label>
                <input name="contributor_phone" type="text" class="admin-input" value="{{ old('contributor_phone', $settings['contributor_phone']) }}" placeholder="6281322263716">
                <p class="mt-1 font-label-mono text-[10px] text-on-surface-variant">Nomor ini yang menerima permintaan kontributor dari siswa</p>
            </div>
        </div>

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
