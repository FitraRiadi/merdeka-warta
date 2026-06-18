{{-- KIRIM TULISANMU MODAL --}}
<div class="fixed inset-0 z-[100] flex items-center justify-center hidden" id="contributorModal">
    <div class="fixed inset-0 bg-on-background/60 backdrop-blur-sm" id="modalOverlay"></div>
    <div class="relative bg-surface border-4 border-on-background shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] w-[92%] max-w-lg max-h-[90vh] overflow-y-auto z-10">
        {{-- Header --}}
        <div class="bg-primary text-on-primary px-6 py-4 border-b-4 border-on-background flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-3xl">edit_note</span>
                <h3 class="font-headline-lg text-2xl uppercase tracking-tight">Izinkan Saya Menjadi Kontributor</h3>
            </div>
            <button class="w-10 h-10 flex items-center justify-center bg-error text-on-error border-3 border-on-background shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all btn-press" id="closeModal">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        {{-- Form --}}
        <form id="contributorForm" class="p-6 space-y-6">
            @csrf
            <div>
                <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Nama Lengkap</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-on-surface-variant">person</span>
                    <input type="text" name="name" required
                        class="w-full bg-surface border-3 border-on-background pl-12 pr-4 py-3 font-body-md focus:outline-none focus:border-primary transition-colors"
                        placeholder="Masukkan nama lengkap...">
                </div>
            </div>

            <div>
                <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Kelas</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-on-surface-variant">school</span>
                    <input type="text" name="class" required
                        class="w-full bg-surface border-3 border-on-background pl-12 pr-4 py-3 font-body-md focus:outline-none focus:border-primary transition-colors"
                        placeholder="Contoh: XI RPL 1">
                </div>
            </div>

            <div>
                <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Alasan Bergabung</label>
                <div class="relative">
                    <span class="absolute left-3 top-3 material-symbols-outlined text-on-surface-variant">edit</span>
                    <textarea name="reason" required rows="4"
                        class="w-full bg-surface border-3 border-on-background pl-12 pr-4 py-3 font-body-md focus:outline-none focus:border-primary transition-colors resize-none"
                        placeholder="Tuliskan alasan Anda ingin bergabung menjadi kontributor..."></textarea>
                </div>
            </div>

            <div>
                <label class="font-label-mono text-xs uppercase text-on-surface-variant mb-2 block">Kontak No. HP / WhatsApp</label>
                <div class="relative">
                    <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-on-surface-variant">phone</span>
                    <input type="tel" name="phone" required
                        class="w-full bg-surface border-3 border-on-background pl-12 pr-4 py-3 font-body-md focus:outline-none focus:border-primary transition-colors"
                        placeholder="Contoh: 08123456789">
                </div>
            </div>

            <button type="submit" id="submitBtn"
                class="w-full bg-primary text-on-primary font-headline-lg text-xl uppercase py-4 border-3 border-on-background shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all flex items-center justify-center gap-3">
                <span class="material-symbols-outlined">send</span>
                KIRIM PERMINTAAN
            </button>
        </form>
    </div>
</div>
