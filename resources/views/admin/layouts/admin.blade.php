<!DOCTYPE html>
<html lang="id">
<head>
    <script>
        if (localStorage.getItem('dark-mode') === 'true' || (!('dark-mode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Panel Admin') - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Plus+Jakarta+Sans:wght@400;500;700;800&family=JetBrains+Mono:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@2.30.7"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/delimiter@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/image@2.9.1"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script>
<script>
    const CustomQuote = class {
        static get toolbox() {
            return {
                title: 'Kutipan',
                icon: '<svg width="17" height="13" viewBox="0 0 17 13" xmlns="http://www.w3.org/2000/svg"><path d="M5.292 10.067c-1.245 0-2.256-.368-3.033-1.104C1.482 8.226 1.094 7.242 1.094 6.01c0-.898.225-1.754.674-2.567.46-.825 1.133-1.521 2.02-2.09.886-.568 1.93-.974 3.13-1.218l.404 1.66c-.787.232-1.451.578-1.992 1.038-.541.46-.91.985-1.104 1.575.257-.06.531-.09.82-.09.957 0 1.764.337 2.42 1.012.656.664.984 1.493.984 2.487 0 1.025-.34 1.87-1.022 2.534-.682.664-1.507.996-2.476.996zm7.656 0c-1.245 0-2.256-.368-3.033-1.104-.777-.737-1.165-1.721-1.165-2.953 0-.898.225-1.754.674-2.567.46-.825 1.133-1.521 2.02-2.09.886-.568 1.93-.974 3.13-1.218l.404 1.66c-.787.232-1.451.578-1.992 1.038-.541.46-.91.985-1.104 1.575.257-.06.531-.09.82-.09.957 0 1.764.337 2.42 1.012.656.664.984 1.493.984 2.487 0 1.025-.34 1.87-1.022 2.534-.682.664-1.507.996-2.476.996z"/></svg>'
            };
        }
        constructor({ data, config, api }) {
            this.api = api;
            this.config = config || {};
            this._data = { text: data.text || '', caption: data.caption || '', alignment: data.alignment || 'left' };
            this._element = null;
            this._caption = null;
        }
        render() {
            const c = document.createElement('div');
            c.className = 'cdx-quote';
            this._element = document.createElement('div');
            this._element.contentEditable = true;
            this._element.innerHTML = this._data.text;
            this._element.className = 'cdx-quote__text';
            this._element.dataset.placeholder = this.config.quotePlaceholder || 'Tulis kutipan...';
            this._caption = document.createElement('textarea');
            this._caption.value = this._data.caption;
            this._caption.className = 'cdx-quote__caption';
            this._caption.placeholder = this.config.captionPlaceholder || 'Sumber kutipan';
            this._caption.rows = 1;
            this._caption.addEventListener('keydown', (e) => { if (e.key === 'Enter') e.stopPropagation(); });
            this._caption.addEventListener('input', () => {
                this._caption.style.height = 'auto';
                this._caption.style.height = this._caption.scrollHeight + 'px';
            });
            c.appendChild(this._element);
            c.appendChild(this._caption);
            return c;
        }
        save() {
            return { text: this._element.innerHTML, caption: this._caption.value, alignment: this._data.alignment };
        }
        static get sanitize() {
            return { text: { br: true, b: true, i: true, a: true, mark: true }, caption: false };
        }
    };
</script>
<script>
    const CustomButton = class {
        static get toolbox() {
            return {
                title: 'Tombol',
                icon: '<svg width="18" height="14" viewBox="0 0 18 14" xmlns="http://www.w3.org/2000/svg"><rect x="1" y="1" width="16" height="12" rx="2" fill="none" stroke="currentColor" stroke-width="2"/><path d="M7 4l3 3-3 3" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>'
            };
        }
        constructor({ data, config, api }) {
            this.api = api;
            this.config = config || {};
            const isDownload = data.download || false;
            this.data = {
                text: data.text || '',
                url: data.url || '',
                style: data.style || 'primary',
                linkType: data.linkType || (isDownload ? 'download' : 'link'),
                newTab: true,
                download: isDownload,
                fileName: data.fileName || ''
            };
            this.nodes = {};
        }
        _makeInput(type, placeholder, value, onChange) {
            const i = document.createElement(type === 'textarea' ? 'textarea' : 'input');
            i.className = type === 'textarea' ? 'cdx-button-field__input cdx-button-field__textarea' : 'cdx-button-field__input';
            i.value = value || '';
            i.placeholder = placeholder || '';
            if (type !== 'textarea') i.type = type || 'text';
            i.addEventListener('input', (e) => { onChange(e.target.value); });
            i.addEventListener('keydown', (e) => {
                e.stopImmediatePropagation();
                if (e.key === 'Enter') e.preventDefault();
            });
            return i;
        }
        _makeField(labelText) {
            const g = document.createElement('div');
            g.className = 'cdx-button-field';
            const l = document.createElement('div');
            l.className = 'cdx-button-field__label';
            l.textContent = labelText;
            g.appendChild(l);
            return g;
        }
        _showSection(id) {
            this.nodes.linkSection.style.display = id === 'link' ? '' : 'none';
            this.nodes.downloadSection.style.display = id === 'download' ? '' : 'none';
        }
        render() {
            const wrap = document.createElement('div');
            wrap.className = 'cdx-button-block';

            // ── Teks tombol ──
            const textField = this._makeField('Teks tombol');
            textField.appendChild(this._makeInput('text', 'Contoh: Download Jadwal Upacara', this.data.text, (v) => { this.data.text = v; this._updatePreview(); }));
            wrap.appendChild(textField);

            // ── Tipe tombol: Link vs Download (radio) ──
            const typeField = this._makeField('Tipe tombol');
            const typeRow = document.createElement('div');
            typeRow.className = 'cdx-button-field__row';
            ['link', 'download'].forEach((t) => {
                const label = document.createElement('label');
                label.className = 'cdx-button-radio';
                const radio = document.createElement('input');
                radio.type = 'radio';
                radio.name = 'btn-type';
                radio.value = t;
                radio.checked = this.data.linkType === t;
                radio.addEventListener('change', () => {
                    this.data.linkType = t;
                    this.data.download = (t === 'download');
                    this.data.url = '';
                    this.data.fileName = '';
                    if (this.nodes.linkInput) this.nodes.linkInput.value = '';
                    if (this.nodes.fileNameDisplay) this.nodes.fileNameDisplay.value = '';
                    this._showSection(t);
                    this._updatePreview();
                });
                label.appendChild(radio);
                const span = document.createElement('span');
                span.textContent = t === 'link' ? 'Button Link' : 'Button Download';
                label.appendChild(span);
                typeRow.appendChild(label);
            });
            typeField.appendChild(typeRow);
            wrap.appendChild(typeField);

            // ── Section: Link ──
            this.nodes.linkSection = document.createElement('div');
            this.nodes.linkSection.className = 'cdx-button-field';
            const linkLabel = document.createElement('div');
            linkLabel.className = 'cdx-button-field__label';
            linkLabel.textContent = 'URL tujuan (otomatis buka tab baru)';
            this.nodes.linkSection.appendChild(linkLabel);
            this.nodes.linkInput = this._makeInput('url', 'https://contoh.com/halaman', this.data.url, (v) => { this.data.url = v; this._updatePreview(); });
            this.nodes.linkSection.appendChild(this.nodes.linkInput);
            wrap.appendChild(this.nodes.linkSection);

            // ── Section: Download ──
            this.nodes.downloadSection = document.createElement('div');
            this.nodes.downloadSection.className = 'cdx-button-field';
            const dlLabel = document.createElement('div');
            dlLabel.className = 'cdx-button-field__label';
            dlLabel.textContent = 'Upload file';
            this.nodes.downloadSection.appendChild(dlLabel);
            const dlRow = document.createElement('div');
            dlRow.className = 'cdx-button-field__row';
            this.nodes.fileNameDisplay = document.createElement('input');
            this.nodes.fileNameDisplay.type = 'text';
            this.nodes.fileNameDisplay.className = 'cdx-button-field__input flex-1';
            this.nodes.fileNameDisplay.placeholder = 'Belum ada file dipilih';
            this.nodes.fileNameDisplay.value = this.data.fileName || '';
            this.nodes.fileNameDisplay.readOnly = true;
            dlRow.appendChild(this.nodes.fileNameDisplay);
            const fileBtn = document.createElement('button');
            fileBtn.type = 'button';
            fileBtn.className = 'cdx-button-field__file-btn';
            fileBtn.innerHTML = '<span class="material-symbols-outlined" style="font-size:14px">upload_file</span> Pilih file';
            fileBtn.addEventListener('click', () => { this._triggerFileUpload(); });
            dlRow.appendChild(fileBtn);
            this.nodes.downloadSection.appendChild(dlRow);
            const dlHint = document.createElement('div');
            dlHint.className = 'cdx-button-field__hint';
            dlHint.textContent = 'Format: PDF, DOC, DOCX, XLS, XLSX, JPG, PNG, WebP, GIF, ZIP';
            this.nodes.downloadSection.appendChild(dlHint);
            this.nodes.fileInput = document.createElement('input');
            this.nodes.fileInput.type = 'file';
            this.nodes.fileInput.style.display = 'none';
            this.nodes.fileInput.accept = '.pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png,.webp,.gif,.zip';
            this.nodes.fileInput.addEventListener('change', (e) => { this._handleFile(e); });
            this.nodes.downloadSection.appendChild(this.nodes.fileInput);
            wrap.appendChild(this.nodes.downloadSection);

            // ── Gaya tombol ──
            const styleField = this._makeField('Gaya tombol');
            const styleRow = document.createElement('div');
            styleRow.className = 'cdx-button-field__row';
            ['primary', 'secondary', 'outline'].forEach((s) => {
                const b = document.createElement('button');
                b.type = 'button';
                b.className = 'cdx-button-style-btn' + (s === this.data.style ? ' active' : '');
                let label = s === 'primary' ? 'Utama' : s === 'secondary' ? 'Sekunder' : 'Garis';
                b.textContent = label;
                b.addEventListener('click', () => {
                    this.data.style = s;
                    styleRow.querySelectorAll('.cdx-button-style-btn').forEach((x) => x.classList.remove('active'));
                    b.classList.add('active');
                    this._updatePreview();
                });
                b.addEventListener('keydown', (e) => { e.stopPropagation(); });
                styleRow.appendChild(b);
            });
            styleField.appendChild(styleRow);
            wrap.appendChild(styleField);

            // ── Preview ──
            this.nodes.previewWrap = document.createElement('div');
            this.nodes.previewWrap.className = 'cdx-button-preview';
            this.nodes.previewEl = document.createElement('span');
            this.nodes.previewEl.className = 'cdx-button-preview__el';
            this.nodes.previewWrap.appendChild(this.nodes.previewEl);
            wrap.appendChild(this.nodes.previewWrap);

            this._showSection(this.data.linkType);
            this._updatePreview();

            return wrap;
        }
        _triggerFileUpload() {
            this.nodes.fileInput.click();
        }
        async _handleFile(e) {
            const file = e.target.files[0];
            if (!file) return;
            if (file.size > 5 * 1024 * 1024) {
                alert('File maksimal 5MB.');
                this.nodes.fileInput.value = '';
                return;
            }
            const original = this.nodes.fileNameDisplay.placeholder;
            this.nodes.fileNameDisplay.placeholder = 'Mengunggah...';
            const form = new FormData();
            form.append('file', file);
            try {
                const res = await fetch('/admin/editor/upload-file', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content },
                    body: form
                });
                const json = await res.json();
                if (json.success) {
                    this.data.url = json.url;
                    this.data.fileName = file.name;
                    this.nodes.fileNameDisplay.value = file.name;
                    this._updatePreview();
                } else {
                    alert(json.message || 'Gagal upload file');
                }
            } catch (err) {
                alert('Gagal upload file: ' + err.message);
            }
            this.nodes.fileNameDisplay.placeholder = original;
            this.nodes.fileInput.value = '';
        }
        _updatePreview() {
            if (!this.nodes.previewEl) return;
            const txt = this.data.text || 'Tombol';
            const isDownload = this.data.linkType === 'download';
            const baseClass = 'cdx-button-preview__el inline-block px-6 py-3 font-headline-lg text-sm uppercase tracking-wider';
            const styles = {
                primary: 'bg-primary text-on-primary border-2 border-on-background',
                secondary: 'bg-secondary text-on-secondary border-2 border-on-background',
                outline: 'bg-transparent text-on-background border-2 border-on-background'
            };
            const icon = isDownload ? 'download' : 'link';
            this.nodes.previewEl.className = baseClass + ' ' + (styles[this.data.style] || styles.primary);
            this.nodes.previewEl.innerHTML = '<span class="material-symbols-outlined text-sm mr-2 align-middle">' + icon + '</span><span class="align-middle">' + txt + '</span>';
        }
        save() {
            return {
                text: this.data.text,
                url: this.data.url,
                style: this.data.style,
                linkType: this.data.linkType,
                newTab: true,
                download: this.data.linkType === 'download',
                fileName: this.data.fileName
            };
        }
        static get sanitize() {
            return { text: false, url: false, style: false, linkType: false, newTab: false, download: false, fileName: false };
        }
    };
</script>
<script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "tertiary-container": "var(--tertiary-container)", "surface-variant": "var(--surface-variant)", "on-background": "var(--on-background)",
                        "background": "var(--background)", "on-tertiary-container": "var(--on-tertiary-container)", "error": "var(--error)",
                        "on-error": "var(--on-error)", "on-secondary-container": "var(--on-secondary-container)", "on-primary-container": "var(--on-primary-container)",
                        "secondary": "var(--secondary)", "surface": "var(--surface)", "error-container": "var(--error-container)",
                        "inverse-primary": "var(--inverse-primary)", "tertiary-fixed-dim": "var(--tertiary-fixed-dim)", "tertiary-fixed": "var(--tertiary-fixed)",
                        "tertiary": "var(--tertiary)", "on-secondary": "var(--on-secondary)", "surface-container-highest": "var(--surface-container-highest)",
                        "outline-variant": "var(--outline-variant)", "on-tertiary-fixed": "var(--on-tertiary-fixed)", "secondary-fixed": "var(--secondary-fixed)",
                        "surface-container-lowest": "var(--surface-container-lowest)", "secondary-fixed-dim": "var(--secondary-fixed-dim)",
                        "on-error-container": "var(--on-error-container)", "outline": "var(--outline)", "primary": "var(--primary)",
                        "surface-container": "var(--surface-container)", "surface-container-high": "var(--surface-container-high)", "surface-dim": "var(--surface-dim)",
                        "inverse-surface": "var(--inverse-surface)", "on-primary-fixed": "var(--on-primary-fixed)", "on-tertiary-fixed-variant": "var(--on-tertiary-fixed-variant)",
                        "on-tertiary": "var(--on-tertiary)", "on-surface-variant": "var(--on-surface-variant)", "primary-container": "var(--primary-container)",
                        "surface-container-low": "var(--surface-container-low)", "on-surface": "var(--on-surface)", "primary-fixed-dim": "var(--primary-fixed-dim)",
                        "on-secondary-fixed-variant": "var(--on-secondary-fixed-variant)", "on-secondary-fixed": "var(--on-secondary-fixed)",
                        "inverse-on-surface": "var(--inverse-on-surface)", "on-primary": "var(--on-primary)", "secondary-container": "var(--secondary-container)",
                        "primary-fixed": "var(--primary-fixed)", "surface-tint": "var(--surface-tint)", "on-primary-fixed-variant": "var(--on-primary-fixed-variant)",
                        "surface-bright": "var(--surface-bright)"
                    },
                    borderRadius: { DEFAULT: "0.125rem", lg: "0.25rem", xl: "0.5rem", full: "0.75rem" },
                    spacing: { "margin-mobile": "16px", gutter: "24px", "margin-desktop": "64px", "grid-unit": "8px", "border-width": "3px" },
                    fontFamily: { "headline-lg": ["Anton"], "body-md": ["Plus Jakarta Sans"], "label-mono": ["JetBrains Mono"] },
                    fontSize: {
                        "headline-lg": ["36px", { lineHeight: "100%", fontWeight: "400" }],
                        "label-mono": ["12px", { lineHeight: "1.2", fontWeight: "700" }],
                        "body-md": ["16px", { lineHeight: "1.6", fontWeight: "500" }]
                    }
                },
            },
        }
    </script>
    <style>
        :root {
            --tertiary-container: #aa5700; --surface-variant: #e1e3e4; --on-background: #191c1d;
            --background: #f8f9fa; --on-tertiary-container: #ffede3; --error: #ba1a1a;
            --on-error: #ffffff; --on-secondary-container: #76014e; --on-primary-container: #eeefff;
            --secondary: #a43073; --surface: #f8f9fa; --error-container: #ffdad6;
            --inverse-primary: #b4c5ff; --tertiary-fixed-dim: #ffb783; --tertiary-fixed: #ffdcc5;
            --tertiary: #864300; --on-secondary: #ffffff; --surface-container-highest: #e1e3e4;
            --outline-variant: #c3c6d7; --on-tertiary-fixed: #301400; --secondary-fixed: #ffd8e7;
            --surface-container-lowest: #ffffff; --secondary-fixed-dim: #ffafd3;
            --on-error-container: #93000a; --outline: #737686; --primary: #004ac6;
            --surface-container: #edeeef; --surface-container-high: #e7e8e9; --surface-dim: #d9dadb;
            --inverse-surface: #2e3132; --on-primary-fixed: #00174b; --on-tertiary-fixed-variant: #713700;
            --on-tertiary: #ffffff; --on-surface-variant: #434655; --primary-container: #2563eb;
            --surface-container-low: #f3f4f5; --on-surface: #191c1d; --primary-fixed-dim: #b4c5ff;
            --on-secondary-fixed-variant: #85145a; --on-secondary-fixed: #3d0026;
            --inverse-on-surface: #f0f1f2; --on-primary: #ffffff; --secondary-container: #fc79bd;
            --primary-fixed: #dbe1ff; --surface-tint: #0053db; --on-primary-fixed-variant: #003ea8;
            --surface-bright: #f8f9fa;
        }
        .dark {
            --tertiary-container: #665500; --surface-variant: #2a2a2a; --on-background: #ffffff;
            --background: #0a0a0a; --on-tertiary-container: #ffe082; --error: #ff6b6b;
            --on-error: #000000; --on-secondary-container: #ffe0b2; --on-primary-container: #fff8e1;
            --secondary: #ff8c00; --surface: #111111; --error-container: #6b0000;
            --inverse-primary: #004ac6; --tertiary-fixed-dim: #ffcc02; --tertiary-fixed: #fff3cd;
            --tertiary: #ffcc02; --on-secondary: #000000; --surface-container-highest: #2a2a2a;
            --outline-variant: #333333; --on-tertiary-fixed: #1a1400; --secondary-fixed: #ffe0b2;
            --surface-container-lowest: #080808; --secondary-fixed-dim: #ffb347;
            --on-error-container: #ffcccc; --outline: #444444; --primary: #ffd700;
            --surface-container: #1a1a1a; --surface-container-high: #222222; --surface-dim: #0a0a0a;
            --inverse-surface: #ffffff; --on-primary-fixed: #1a1400; --on-tertiary-fixed-variant: #332a00;
            --on-tertiary: #000000; --on-surface-variant: #cccccc; --primary-container: #ffed4a;
            --surface-container-low: #141414; --on-surface: #ffffff; --primary-fixed-dim: #ffd700;
            --on-secondary-fixed-variant: #331c00; --on-secondary-fixed: #1a0e00;
            --inverse-on-surface: #000000; --on-primary: #000000; --secondary-container: #e67e00;
            --primary-fixed: #fff3b0; --surface-tint: #ffd700; --on-primary-fixed-variant: #332a00;
            --surface-bright: #2a2a2a;
        }
        .dark .brutalist-shadow { box-shadow: 8px 8px 0px 0px rgba(255,255,255,0.12); }
        .dark .brutalist-shadow-sm { box-shadow: 4px 4px 0px 0px rgba(255,255,255,0.12); }
        .dark .brutalist-border { border-color: var(--on-background); }
        * { font-family: 'Plus Jakarta Sans', sans-serif; }
        html { scroll-behavior: smooth; }
        body { background-color: var(--surface-container); }

        .brutalist-shadow { box-shadow: 8px 8px 0px 0px rgba(0, 0, 0, 1); }
        .brutalist-shadow-sm { box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1); }
        .brutalist-border { border: 3px solid #191c1d; }
        .btn-press:active { transform: translate(4px, 4px); box-shadow: none !important; }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.625rem 0.75rem;
            border-radius: 0.25rem;
            font-size: 0.8rem;
            font-weight: 700;
            font-family: 'JetBrains Mono', monospace;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--on-surface-variant);
            transition: all 0.15s ease;
            border: 2px solid transparent;
            border-left: 3px solid transparent;
        }
        .sidebar-link:hover {
            background: var(--surface-container);
            color: var(--primary);
            border-left-color: var(--primary);
        }
        .sidebar-link.active {
            background: var(--primary);
            color: var(--on-primary);
            border-left-color: var(--on-background);
            border-color: var(--on-background);
            box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1);
        }
        .dark .sidebar-link.active {
            box-shadow: 4px 4px 0px 0px rgba(255,255,255,0.15);
        }
        .sidebar-link.active .material-symbols-outlined {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
            font-size: 1.25rem;
        }
        .material-symbols-filled {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        input:focus { outline: none; box-shadow: none; }
        textarea:focus { outline: none; box-shadow: none; }
        select:focus { outline: none; box-shadow: none; }

        [x-cloak] { display: none !important; }

        .admin-card {
            background: var(--surface-container-lowest);
            border: 3px solid var(--on-background);
            box-shadow: 8px 8px 0px 0px rgba(0, 0, 0, 1);
            position: relative;
        }
        .dark .admin-card {
            box-shadow: 8px 8px 0px 0px rgba(255,255,255,0.12);
        }
        .admin-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary);
            opacity: 0.5;
        }
        .admin-card-sm {
            background: var(--surface-container-lowest);
            border: 3px solid var(--on-background);
            box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1);
        }
        .dark .admin-card-sm {
            box-shadow: 4px 4px 0px 0px rgba(255,255,255,0.12);
        }
        .admin-input {
            width: 100%;
            background-color: var(--surface-container-lowest);
            border: 3px solid var(--on-background);
            padding: 0.625rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.15s ease;
            box-shadow: 2px 2px 0px 0px rgba(0, 0, 0, 0.08);
        }
        .admin-input:focus {
            border-color: var(--primary);
            box-shadow: 3px 3px 0px 0px color-mix(in srgb, var(--primary) 15%, transparent);
            background-color: var(--background);
        }
        .admin-btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--primary);
            color: var(--on-primary);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.625rem 1.25rem;
            border: 3px solid var(--on-background);
            box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1);
            transition: all 0.15s ease;
        }
        .dark .admin-btn-primary { box-shadow: 4px 4px 0px 0px rgba(255,255,255,0.15); }
        .admin-btn-primary:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px rgba(0, 0, 0, 1);
            background: var(--on-primary-fixed-variant);
        }
        .dark .admin-btn-primary:hover { box-shadow: 6px 6px 0px 0px rgba(255,255,255,0.15); }
        .admin-btn-primary:active {
            transform: translate(2px, 2px);
            box-shadow: none;
        }
        .admin-btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--surface-container-lowest);
            color: var(--on-surface);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.625rem 1.25rem;
            border: 3px solid var(--on-background);
            box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1);
            transition: all 0.15s ease;
        }
        .dark .admin-btn-secondary { box-shadow: 4px 4px 0px 0px rgba(255,255,255,0.15); }
        .admin-btn-secondary:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px rgba(0, 0, 0, 1);
            background: var(--primary-fixed);
            border-color: var(--primary);
            color: var(--primary);
        }
        .dark .admin-btn-secondary:hover { box-shadow: 6px 6px 0px 0px rgba(255,255,255,0.15); }
        .admin-btn-secondary:active {
            transform: translate(2px, 2px);
            box-shadow: none;
        }
        .admin-btn-danger {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--error);
            color: var(--on-error);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.625rem 1.25rem;
            border: 3px solid var(--on-background);
            box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1);
            transition: all 0.15s ease;
        }
        .dark .admin-btn-danger { box-shadow: 4px 4px 0px 0px rgba(255,255,255,0.15); }
        .admin-btn-danger:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px rgba(0, 0, 0, 1);
            background: var(--on-error-container);
        }
        .dark .admin-btn-danger:hover { box-shadow: 6px 6px 0px 0px rgba(255,255,255,0.15); }
        .admin-btn-danger:active {
            transform: translate(2px, 2px);
            box-shadow: none;
        }
        .admin-btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.7rem;
        }
        .admin-btn-success {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: #2e7d32;
            color: #ffffff;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.625rem 1.25rem;
            border: 3px solid var(--on-background);
            box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1);
            transition: all 0.15s ease;
        }
        .dark .admin-btn-success { box-shadow: 4px 4px 0px 0px rgba(255,255,255,0.15); }
        .admin-btn-success:hover {
            transform: translate(-2px, -2px);
            box-shadow: 6px 6px 0px 0px rgba(0, 0, 0, 1);
            background: #1b5e20;
        }
        .dark .admin-btn-success:hover { box-shadow: 6px 6px 0px 0px rgba(255,255,255,0.15); }
        .admin-btn-success:active {
            transform: translate(2px, 2px);
            box-shadow: none;
        }
        .admin-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.625rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border: 2px solid #191c1d;
        }
        .admin-badge-success {
            background-color: #e8f5e9;
            color: #2e7d32;
            border-color: #2e7d32;
        }
        .admin-badge-warning {
            background-color: #fff3e0;
            color: #e65100;
            border-color: #e65100;
        }
        .admin-badge-info {
            background-color: #e3f2fd;
            color: #004ac6;
            border-color: #004ac6;
        }
        .admin-badge-error {
            background-color: #ffebee;
            color: #c62828;
            border-color: #c62828;
        }
        .admin-badge-neutral {
            background-color: #f5f5f5;
            color: #616161;
            border-color: #616161;
        }

        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            border: 2px solid var(--on-background);
            background: var(--surface-container-lowest);
            color: var(--on-surface-variant);
            transition: all 0.15s ease;
            box-shadow: 2px 2px 0px 0px rgba(0, 0, 0, 1);
        }
        .dark .action-btn { box-shadow: 2px 2px 0px 0px rgba(255,255,255,0.12); }
        .action-btn:hover {
            transform: translate(-1px, -1px);
            box-shadow: 3px 3px 0px 0px rgba(0, 0, 0, 1);
        }
        .dark .action-btn:hover { box-shadow: 3px 3px 0px 0px rgba(255,255,255,0.12); }
        .action-btn:active {
            transform: translate(1px, 1px);
            box-shadow: none;
        }
        .action-btn-edit:hover {
            background: var(--primary-fixed);
            color: var(--primary);
            border-color: var(--primary);
        }
        .action-btn-view:hover {
            background: #e8f5e9;
            color: #2e7d32;
            border-color: #2e7d32;
        }
        .dark .action-btn-view:hover {
            background: #1b5e20;
            color: #a5d6a7;
            border-color: #a5d6a7;
        }
        .action-btn-delete:hover {
            background: #ffebee;
            color: #c62828;
            border-color: #c62828;
        }
        .dark .action-btn-delete:hover {
            background: #93000a;
            color: #ffb4ab;
            border-color: #ffb4ab;
        }

        /* Stat card variants */
        .stat-card {
            position: relative;
            overflow: hidden;
        }
        .stat-card::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
        }
        .stat-card-blue::after { background: #004ac6; }
        .stat-card-pink::after { background: #a43073; }
        .stat-card-orange::after { background: #864300; }
        .stat-card-green::after { background: #2e7d32; }
        .stat-card-purple::after { background: #7b1fa2; }
        .stat-card-teal::after { background: #00695c; }

        /* Card header accent colors */
        .card-header-blue { border-bottom-color: #004ac6 !important; }
        .card-header-pink { border-bottom-color: #a43073 !important; }
        .card-header-orange { border-bottom-color: #864300 !important; }
        .card-header-green { border-bottom-color: #2e7d32 !important; }

        /* Table styling */
        .admin-table th {
            background: var(--primary-fixed);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--primary);
            padding: 0.75rem;
            border-bottom: 3px solid var(--on-background);
        }
        .dark .admin-table th {
            background: var(--surface-container-high);
            color: var(--on-surface);
        }
        .admin-table td {
            padding: 0.75rem;
            border-bottom: 2px solid color-mix(in srgb, var(--on-background) 10%, transparent);
        }
        .admin-table tr:last-child td {
            border-bottom: none;
        }
        .admin-table tbody tr {
            transition: background 0.15s ease;
        }
        .admin-table tbody tr:hover {
            background: color-mix(in srgb, var(--primary) 8%, var(--surface));
        }

        /* Custom file input */
        .custom-file-input::-webkit-file-upload-button {
            visibility: hidden;
        }
        .custom-file-input::before {
            content: 'Pilih File';
            display: inline-block;
            background: var(--primary);
            color: var(--on-primary);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            padding: 0.375rem 0.75rem;
            border: 2px solid var(--on-background);
            margin-right: 0.5rem;
            cursor: pointer;
            box-shadow: 2px 2px 0px 0px rgba(0, 0, 0, 1);
        }
        .dark .custom-file-input::before { box-shadow: 2px 2px 0px 0px rgba(255,255,255,0.12); }

        /* Page header accent */
        .page-header-accent {
            width: 3rem;
            height: 4px;
            background: #004ac6;
            margin-top: 0.25rem;
        }

        /* Empty state styling */
        .empty-state-icon {
            width: 4rem;
            height: 4rem;
            background: var(--surface-container-highest);
            border: 3px solid var(--on-background);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 0.1);
        }
        .dark .empty-state-icon { box-shadow: 4px 4px 0px 0px rgba(255,255,255,0.12); }
        .dark .admin-input { background-color: var(--surface-container); color: var(--on-surface); }
        .dark .admin-input::placeholder { color: var(--on-surface-variant); opacity: 0.6; }
        .dark input:not([class]):not(.admin-input) { background-color: var(--surface-container); color: var(--on-surface); }
        .dark input:not([class]):not(.admin-input)::placeholder { color: var(--on-surface-variant); opacity: 0.6; }
        .dark textarea:not([class]):not(.admin-input)::placeholder { color: var(--on-surface-variant); opacity: 0.6; }
        .dark select:not([class]):not(.admin-input) { background-color: var(--surface-container); color: var(--on-surface); }

        /* Section title with accent line */
        .section-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        .section-title::after {
            content: '';
            flex: 1;
            height: 2px;
            background: var(--on-background);
            opacity: 0.3;
        }

        /* Navbar accent */
        .navbar-brand-icon {
            background: var(--primary);
            box-shadow: 3px 3px 0px 0px rgba(0, 0, 0, 1);
        }
        .dark .navbar-brand-icon { box-shadow: 3px 3px 0px 0px rgba(255,255,255,0.12); }

        /* Dark mode - badge overrides for inline Tailwind classes */
        .dark [class*="bg-green-100"]:is(.admin-badge) { background-color: #1b5e20 !important; color: #a5d6a7 !important; border-color: #4caf50 !important; }
        .dark [class*="bg-blue-100"]:is(.admin-badge) { background-color: #0d47a1 !important; color: #90caf9 !important; border-color: #2196f3 !important; }
        .dark [class*="bg-red-100"]:is(.admin-badge) { background-color: #8b0000 !important; color: #ef9a9a !important; border-color: #f44336 !important; }
        .dark [class*="bg-orange-100"]:is(.admin-badge) { background-color: #993d00 !important; color: #ffcc80 !important; border-color: #ff9800 !important; }
        .dark [class*="bg-teal-100"]:is(.admin-badge) { background-color: #004d40 !important; color: #80cbc4 !important; border-color: #009688 !important; }
        .dark [class*="bg-purple-100"]:is(.admin-badge) { background-color: #4a148c !important; color: #ce93d8 !important; border-color: #9c27b0 !important; }
        .dark [class*="bg-gray-100"]:is(.admin-badge) { background-color: #424242 !important; color: #e0e0e0 !important; border-color: #9e9e9e !important; }

        /* Dark mode - admin badge CSS variants */
        .dark .admin-badge-success { background-color: #1b5e20 !important; color: #a5d6a7 !important; border-color: #4caf50 !important; }
        .dark .admin-badge-warning { background-color: #993d00 !important; color: #ffcc80 !important; border-color: #ff9800 !important; }
        .dark .admin-badge-info { background-color: #0d47a1 !important; color: #90caf9 !important; border-color: #2196f3 !important; }
        .dark .admin-badge-error { background-color: #8b0000 !important; color: #ef9a9a !important; border-color: #f44336 !important; }
        .dark .admin-badge-neutral { background-color: #424242 !important; color: #e0e0e0 !important; border-color: #9e9e9e !important; }

        /* Dark mode - stat card accents */
        .dark .stat-card-blue::after { background: #ffd700; }
        .dark .stat-card-pink::after { background: #ff8c00; }
        .dark .stat-card-orange::after { background: #ffcc02; }
        .dark .stat-card-green::after { background: #66bb6a; }
        .dark .stat-card-purple::after { background: #ffd700; }
        .dark .stat-card-teal::after { background: #ffd700; }

        /* Dark mode - card header accents */
        .dark .card-header-blue { border-bottom-color: #ffd700 !important; }
        .dark .card-header-pink { border-bottom-color: #ff8c00 !important; }
        .dark .card-header-orange { border-bottom-color: #ffcc02 !important; }
        .dark .card-header-green { border-bottom-color: #66bb6a !important; }

        /* Dark mode - page header accent */
        .dark .page-header-accent { background: #ffd700; }

        /* Dark mode toggle */
        .dark-mode-toggle {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.25rem;
            height: 2.25rem;
            border: 2px solid var(--on-background);
            background: var(--surface-container-lowest);
            color: var(--on-surface);
            cursor: pointer;
            transition: all 0.15s ease;
            box-shadow: 2px 2px 0px 0px rgba(0,0,0,0.1);
        }
        .dark-mode-toggle:hover {
            background: var(--primary-fixed);
            color: var(--primary);
            border-color: var(--primary);
        }
        .dark .dark-mode-toggle { box-shadow: 2px 2px 0px 0px rgba(255,255,255,0.12); }
        .dark .dark-mode-toggle:hover {
            background: var(--primary);
            color: var(--on-primary);
        }

        /* ── Editor.js canvas: notebook paper style ── */
        #editorjs-content .codex-editor {
            background: #f7f6f3;
            border: 2px solid rgba(0,0,0,0.15);
            border-radius: 4px;
        }
        #editorjs-content .codex-editor__redactor {
            padding-bottom: 200px !important;
            counter-reset: ce-block-num;
            max-height: 100% !important;
            overflow: visible !important;
        }
        #editorjs-content {
            overflow: visible !important;
        }
        #editorjs-content .ce-popover,
        #editorjs-content .ce-tune-popover {
            z-index: 1000 !important;
        }
        #editorjs-content .ce-block {
            counter-increment: ce-block-num;
            padding-left: 2rem;
            position: relative;
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(2px);
            margin: 0;
            border-left: 3px solid transparent;
            border-bottom: 1px solid rgba(0,0,0,0.1);
            transition: background 0.15s;
        }
        #editorjs-content .ce-block::before {
            content: counter(ce-block-num);
            position: absolute;
            left: 4px;
            top: 50%;
            transform: translateY(-50%);
            width: 1.25rem;
            text-align: right;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.75rem;
            color: #333;
            user-select: none;
            pointer-events: none;
        }
        #editorjs-content .ce-block--selected {}
        #editorjs-content .ce-block--selected::before {
            content: "\25B8 " counter(ce-block-num);
            color: var(--primary);
            font-weight: 800;
        }
        #editorjs-content .ce-block--drop-target {
            border-left-color: var(--error);
        }
        #editorjs-content .ce-block__content {
            max-width: 100%;
            padding: 6px 16px;
        }
        #editorjs-content .ce-block--drop-target .ce-block__content {
            background: rgba(186,26,26,0.05);
        }

        /* ── Editor.js heading differentiation ── */
        #editorjs-content h1.ce-header {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1.2;
            margin: 0.5em 0 0.25em;
            color: #1a1a1a;
        }
        #editorjs-content h2.ce-header {
            font-size: 1.6rem;
            font-weight: 700;
            line-height: 1.25;
            margin: 0.4em 0 0.2em;
            color: #1a1a1a;
        }
        #editorjs-content h3.ce-header {
            font-size: 1.3rem;
            font-weight: 600;
            line-height: 1.3;
            margin: 0.3em 0 0.15em;
            color: #2a2a2a;
        }
        #editorjs-content h4.ce-header {
            font-size: 1.1rem;
            font-weight: 600;
            line-height: 1.35;
            margin: 0.2em 0 0.1em;
            color: #2a2a2a;
        }
        #editorjs-content h5.ce-header {
            font-size: 1rem;
            font-weight: 600;
            line-height: 1.4;
            color: #333;
        }
        #editorjs-content h6.ce-header {
            font-size: 0.9rem;
            font-weight: 600;
            line-height: 1.4;
            color: #444;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        #editorjs-content .ce-paragraph {
            line-height: 1.8;
        }
        #editorjs-content .ce-toolbar {
            background: rgba(255,255,255,0.95);
            backdrop-filter: blur(4px);
        }
        @media (min-width: 651px) {
            #editorjs-content .ce-toolbar__plus {
                float: right;
                position: static;
                background: var(--surface-container-lowest);
                border: 2px solid var(--on-background);
                color: var(--on-surface);
                box-shadow: 2px 2px 0 0 rgba(0,0,0,1);
                transition: all 0.1s;
            }
            #editorjs-content .ce-toolbar__actions {
                left: auto;
                right: 60px;
            }
            #editorjs-content .ce-toolbar__settings-btn {
                background: var(--surface-container-lowest);
                border: 2px solid var(--on-background);
                color: var(--on-surface);
                box-shadow: 2px 2px 0 0 rgba(0,0,0,1);
                transition: all 0.1s;
            }
        }
        #editorjs-content .ce-toolbar__plus:hover,
        #editorjs-content .ce-toolbar__settings-btn:hover {
            transform: translate(-1px,-1px);
            box-shadow: 3px 3px 0 0 rgba(0,0,0,1);
            background: var(--primary);
            color: var(--on-primary);
        }
        #editorjs-content .ce-inline-toolbar {
            border: 2px solid var(--on-background);
            box-shadow: 4px 4px 0 0 rgba(0,0,0,1);
            border-radius: 2px;
            background: var(--surface);
        }
        #editorjs-content .ce-inline-toolbar__dropdown:hover,
        #editorjs-content .ce-inline-tool:hover {
            background: var(--primary-fixed);
            color: var(--primary);
        }
        #editorjs-content .ce-conversion-toolbar {
            border: 2px solid var(--on-background);
            box-shadow: 4px 4px 0 0 rgba(0,0,0,1);
            background: var(--surface);
        }
        #editorjs-content .ce-conversion-tool:hover {
            background: var(--primary-fixed);
            color: var(--primary);
        }
        #editorjs-content .ce-popover {
            border: 2px solid var(--on-background);
            box-shadow: 4px 4px 0 0 rgba(0,0,0,1);
            background: var(--surface);
        }
        #editorjs-content .ce-popover-item:hover {
            background: var(--primary-fixed);
            color: var(--primary);
        }
        #editorjs-content .ce-popover-item--active {
            background: var(--primary);
            color: var(--on-primary);
        }
        #editorjs-content .ce-block--selected .ce-block__content {
            background: transparent;
        }
        #editorjs-content .cdx-button {
            background: var(--surface-container);
            border: 2px solid var(--on-background);
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            box-shadow: 2px 2px 0 0 rgba(0,0,0,1);
            transition: all 0.1s;
        }
        #editorjs-content .cdx-button:hover {
            transform: translate(-1px,-1px);
            box-shadow: 3px 3px 0 0 rgba(0,0,0,1);
        }

        /* ── Editor.js Image Tool display fixes ── */
        #editorjs-content .image-tool__image {
            margin-bottom: 10px;
        }
        #editorjs-content .image-tool__image-picture {
            max-width: 100%;
            max-height: 360px;
            width: auto;
            height: auto;
            display: block;
            margin: 0 auto;
        }
        #editorjs-content .image-tool--uploading .image-tool__image {
            min-height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border-color, #e8e8eb);
            background-color: #fff;
        }
        #editorjs-content .image-tool--uploading .image-tool__image-picture,
        #editorjs-content .image-tool--uploading .cdx-button {
            display: none;
        }
        #editorjs-content .ce-block:has(.image-tool--filled) {
            padding-left: 0;
        }
        #editorjs-content .ce-block:has(.image-tool--filled)::before {
            display: none;
        }
        #editorjs-content .ce-block:has(.image-tool--filled) .ce-block__content {
            max-width: 100%;
            padding: 6px 0;
        }

        /* dark mode */
        .dark #editorjs-content .image-tool--uploading .image-tool__image {
            background-color: #1a1a1a;
            border-color: #444;
        }

        /* dark mode overrides */
        .dark #editorjs-content .codex-editor {
            background: #1a1a1a;
            border-color: rgba(255,255,255,0.15);
        }
        .dark #editorjs-content h1.ce-header,
        .dark #editorjs-content h2.ce-header,
        .dark #editorjs-content h3.ce-header,
        .dark #editorjs-content h4.ce-header { color: #e8e6e3; }
        .dark #editorjs-content h5.ce-header,
        .dark #editorjs-content h6.ce-header { color: #c4c2bf; }
        .dark #editorjs-content .ce-block {
            background: rgba(30,30,30,0.9);
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .dark #editorjs-content .ce-block::before {
            color: #ccc;
        }
        .dark #editorjs-content .ce-block--selected {
            border-left: 5px solid var(--primary);
            background: rgba(20,30,40,0.97);
            box-shadow: inset 2px 0 0 0 var(--primary), 0 1px 4px rgba(0,0,0,0.3);
        }
        .dark #editorjs-content .ce-block--selected::before {
            color: var(--primary);
        }
        .dark #editorjs-content .ce-toolbar {
            background: rgba(20,20,20,0.95);
        }
        .dark #editorjs-content .ce-toolbar__plus,
        .dark #editorjs-content .ce-toolbar__settings-btn {
            background: var(--surface-container);
            box-shadow: 2px 2px 0 0 rgba(255,255,255,0.12);
        }
        .dark #editorjs-content .ce-toolbar__plus:hover,
        .dark #editorjs-content .ce-toolbar__settings-btn:hover {
            box-shadow: 3px 3px 0 0 rgba(255,255,255,0.12);
        }
        .dark #editorjs-content .ce-inline-toolbar,
        .dark #editorjs-content .ce-conversion-toolbar,
        .dark #editorjs-content .ce-popover {
            border-color: #333;
            box-shadow: 4px 4px 0 0 rgba(255,255,255,0.12);
            background: var(--surface-container);
        }
        .dark #editorjs-content .cdx-button {
            background: var(--surface-container-high);
            box-shadow: 2px 2px 0 0 rgba(255,255,255,0.12);
        }
        .ce-paragraph[data-placeholder]:empty::before,
        .cdx-quote__text[data-placeholder]:empty::before,
        .cdx-block[data-placeholder]:empty::before,
        .cdx-header[data-placeholder]:empty::before,
        .cdx-input[data-placeholder]:empty::before,
        .cdx-list[data-placeholder]:empty::before {
            content: attr(data-placeholder) !important;
            color: #9ca3af !important;
            pointer-events: none;
            font-style: italic;
        }
        .cdx-quote__caption {
            width: 100%;
            margin-top: 0.5rem;
            padding: 0.5rem;
            border: 1px dashed #d1d5db;
            border-radius: 0.25rem;
            background: transparent;
            font-size: 0.875rem;
            color: inherit;
            resize: none;
            overflow: hidden;
            min-height: 2.5rem;
            font-family: inherit;
            box-sizing: border-box;
        }
        .cdx-quote__caption:focus {
            outline: none;
            border-color: #006b4f;
        }
        .cdx-quote__caption::placeholder {
            color: #9ca3af;
            font-style: italic;
        }
        .dark .cdx-quote__caption {
            border-color: #555;
            color: #e5e5e5;
        }
        .dark .cdx-quote__caption:focus {
            border-color: #34d399;
        }
        .cdx-quote__text {
            padding: 10px 14px 10px 20px;
            border-left: 3px solid var(--primary);
            min-height: 50px;
            outline: none;
        }
        .cdx-quote__text:focus {
            border-left-color: var(--secondary);
        }
        .dark .cdx-quote__text {
            border-left-color: var(--primary);
        }
        .dark .cdx-quote__text:focus {
            border-left-color: var(--secondary);
        }

        /* ── Editor Toolbar ── */
        .editor-toolbar {
            position: relative;
            display: flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.375rem 0.75rem;
            background: var(--surface-container);
            border-bottom: 2px solid var(--on-background);
            flex-shrink: 0;
            min-height: 2.5rem;
        }
        .editor-toolbar__scroll {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            flex: 1;
            min-width: 0;
            overflow-x: auto;
            overflow-y: hidden;
            white-space: nowrap;
            scrollbar-width: thin;
            scrollbar-color: var(--outline-variant) transparent;
        }
        .editor-toolbar__scroll::-webkit-scrollbar {
            height: 4px;
        }
        .editor-toolbar__scroll::-webkit-scrollbar-track {
            background: transparent;
        }
        .editor-toolbar__scroll::-webkit-scrollbar-thumb {
            background: var(--outline-variant);
            border-radius: 2px;
        }
        .editor-toolbar__group {
            display: flex;
            align-items: center;
            gap: 0.125rem;
            white-space: nowrap;
        }
        .editor-toolbar__group + .editor-toolbar__group {
            border-left: 1px solid var(--outline-variant);
            padding-left: 0.5rem;
        }
        .editor-toolbar__btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 1.75rem;
            height: 1.75rem;
            border: 2px solid transparent;
            background: transparent;
            color: var(--on-surface-variant);
            cursor: pointer;
            transition: all 0.1s ease;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 0.8rem;
            border-radius: 0;
        }
        .editor-toolbar__btn:hover {
            background: var(--surface-container-highest);
            border-color: var(--outline);
            color: var(--on-surface);
        }
        .editor-toolbar__btn.active {
            background: var(--primary);
            color: var(--on-primary);
            border-color: var(--on-background);
        }
        .editor-toolbar__btn:disabled {
            opacity: 0.3;
            cursor: not-allowed;
            pointer-events: none;
        }
        .editor-toolbar__line {
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.65rem;
            font-weight: 700;
            color: var(--on-surface-variant);
            white-space: nowrap;
            padding: 0 0.25rem;
        }
        .editor-tune-popup {
            position: absolute;
            top: 100%;
            right: 0;
            z-index: 50;
            min-width: 170px;
            background: var(--surface);
            border: 3px solid var(--on-background);
            box-shadow: 6px 6px 0px 0px rgba(0,0,0,1);
            margin-top: 4px;
        }
        .dark .editor-tune-popup {
            box-shadow: 6px 6px 0px 0px rgba(255,255,255,0.12);
        }
        .editor-tune-popup button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            width: 100%;
            padding: 0.5rem 0.75rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--on-surface);
            background: transparent;
            border: none;
            border-bottom: 2px solid var(--outline-variant);
            cursor: pointer;
            transition: background 0.1s;
        }
        .editor-tune-popup button:last-child {
            border-bottom: none;
        }
        .editor-tune-popup button:hover {
            background: var(--surface-container-highest);
        }
        .editor-tune-popup .text-error {
            color: var(--error);
        }

        /* Hide default EditorJS floating buttons (custom toolbar replaces them) */
        #editorjs-content .ce-toolbar__plus,
        #editorjs-content .ce-toolbar__actions {
            display: none !important;
        }

        .dark .editor-toolbar {
            background: var(--surface-container-high);
        }
        .dark .editor-toolbar__btn.active {
            background: var(--primary);
            color: var(--on-primary);
            border-color: var(--on-background);
        }
        .dark .editor-toolbar__hbtn.active {
            background: var(--primary);
            color: var(--on-primary);
            border-color: var(--on-background);
        }
        .dark .editor-tune-popup {
            background: var(--surface-container);
        }

        /* ── Block Picker Popup ── */
        .editor-block-picker {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 999;
            min-width: 180px;
            background: var(--surface);
            border: 3px solid var(--on-background);
            box-shadow: 6px 6px 0px 0px rgba(0,0,0,1);
            margin-top: 4px;
        }
        .dark .editor-block-picker {
            box-shadow: 6px 6px 0px 0px rgba(255,255,255,0.12);
        }
        .editor-block-picker button {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            width: 100%;
            padding: 0.5rem 0.75rem;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--on-surface);
            background: transparent;
            border: none;
            border-bottom: 2px solid var(--outline-variant);
            cursor: pointer;
            transition: background 0.1s;
        }
        .editor-block-picker button:last-child {
            border-bottom: none;
        }
        .editor-block-picker button:hover {
            background: var(--surface-container-highest);
        }
        .dark .editor-block-picker {
            background: var(--surface-container);
        }

        /* ── Line Number Badge ── */
        .editor-toolbar__line-badge {
            display: flex;
            align-items: center;
            gap: 4px;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.7rem;
            font-weight: 700;
            color: var(--on-surface-variant);
            white-space: nowrap;
        }

        /* ── Conditional group hide/show ── */
        .editor-toolbar__group--conditional {
            display: flex;
            align-items: center;
            gap: 0.125rem;
        }

        /* ── Heading level buttons ── */
        .editor-toolbar__hbtn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 1.75rem;
            height: 1.75rem;
            border: 2px solid transparent;
            background: transparent;
            color: var(--on-surface-variant);
            cursor: pointer;
            transition: all 0.1s ease;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 0.65rem;
            border-radius: 0;
            padding: 0 4px;
        }
        .editor-toolbar__hbtn:hover {
            background: var(--surface-container-highest);
            border-color: var(--outline);
            color: var(--on-surface);
        }
        .editor-toolbar__hbtn.active {
            background: var(--primary);
            color: var(--on-primary);
            border-color: var(--on-background);
        }

        /* ── Custom Button Tool ── */
        .cdx-button-block { padding: 0.5rem 0; }
        .cdx-button-field { margin-bottom: 0.75rem; }
        .cdx-button-field__label { font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #666; margin-bottom: 0.25rem; font-family: 'JetBrains Mono', monospace; }
        .dark .cdx-button-field__label { color: #999; }
        .cdx-button-field__input, .cdx-button-field__textarea { width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0; font-size: 0.875rem; background: #fff; color: #111; outline: none; box-sizing: border-box; font-family: inherit; }
        .cdx-button-field__input:focus, .cdx-button-field__textarea:focus { border-color: #006b4f; box-shadow: 0 0 0 2px rgba(0,107,79,0.15); }
        .dark .cdx-button-field__input, .dark .cdx-button-field__textarea { background: #2a2a2a; color: #e5e5e5; border-color: #555; }
        .dark .cdx-button-field__input:focus, .dark .cdx-button-field__textarea:focus { border-color: #34d399; box-shadow: 0 0 0 2px rgba(52,211,153,0.15); }
        .cdx-button-field__textarea { resize: none; overflow: hidden; min-height: 2.5rem; }
        .cdx-button-field__row { display: flex; gap: 0.5rem; }
        .cdx-button-field__row .cdx-button-field__input { flex: 1; }
        .cdx-button-field__file-btn { display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.5rem 0.75rem; font-size: 0.75rem; font-weight: 600; border: 1px solid #d1d5db; background: #f3f4f6; cursor: pointer; transition: background 0.15s; white-space: nowrap; font-family: inherit; }
        .cdx-button-field__file-btn:hover { background: #e5e7eb; }
        .dark .cdx-button-field__file-btn { background: #333; border-color: #555; color: #e5e5e5; }
        .dark .cdx-button-field__file-btn:hover { background: #444; }
        .cdx-button-style-btn { display: inline-flex; align-items: center; justify-content: center; padding: 0.35rem 0.75rem; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; border: 2px solid #333; cursor: pointer; transition: all 0.1s; background: #fff; color: #333; font-family: inherit; }
        .cdx-button-style-btn.active { background: #333; color: #fff; }
        .cdx-button-style-btn:hover { transform: translate(-1px,-1px); }
        .cdx-button-style-btn + .cdx-button-style-btn { margin-left: 0.25rem; }
        .dark .cdx-button-style-btn { border-color: #888; background: transparent; color: #ccc; }
        .dark .cdx-button-style-btn.active { background: #ccc; color: #1a1a1a; }
        .cdx-button-radio { display: inline-flex; align-items: center; gap: 0.4rem; font-size: 0.8rem; cursor: pointer; color: #444; font-family: inherit; padding: 0.25rem 0.5rem; border: 2px solid #d1d5db; transition: all 0.1s; }
        .cdx-button-radio input { width: 0.9rem; height: 0.9rem; cursor: pointer; accent-color: #006b4f; }
        .cdx-button-radio:has(input:checked) { border-color: #006b4f; background: rgba(0,107,79,0.06); }
        .dark .cdx-button-radio { color: #ccc; border-color: #555; }
        .dark .cdx-button-radio input { accent-color: #34d399; }
        .dark .cdx-button-radio:has(input:checked) { border-color: #34d399; background: rgba(52,211,153,0.1); }
        .cdx-button-radio + .cdx-button-radio { margin-left: 0.25rem; }
        .cdx-button-field__hint { font-size: 0.65rem; color: #999; margin-top: 0.25rem; font-family: 'JetBrains Mono', monospace; }
        .dark .cdx-button-field__hint { color: #777; }
        .cdx-button-field__input[readonly] { background: #f3f4f6; cursor: default; }
        .dark .cdx-button-field__input[readonly] { background: #222; color: #999; }
        .cdx-button-preview { margin-top: 0.75rem; padding-top: 0.75rem; border-top: 1px dashed #d1d5db; display: flex; justify-content: center; }
        .cdx-button-preview__el { cursor: default; pointer-events: none; }
        .dark .cdx-button-preview { border-color: #555; }
    </style>
    @stack('styles')
</head>
<body class="text-on-surface antialiased">

    {{-- Mobile Sidebar Overlay --}}
    <div x-data="{ sidebarOpen: false, darkMode: localStorage.getItem('dark-mode') === 'true' }" x-init="$watch('sidebarOpen', val => document.body.classList.toggle('overflow-hidden', val)); $watch('darkMode', val => { localStorage.setItem('dark-mode', val); document.documentElement.classList.toggle('dark', val) })">
        <div x-show="sidebarOpen" x-cloak class="fixed inset-0 bg-on-background/50 z-40 lg:hidden" @click="sidebarOpen = false"></div>

        {{-- Mobile Sidebar --}}
        <div x-show="sidebarOpen" x-cloak x-transition:enter="transition transform duration-200 ease-out" x-transition:enter-start="-translate-x-full" x-transition:leave="transition transform duration-150 ease-in" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="fixed top-0 left-0 h-full w-[280px] bg-surface z-50 overflow-y-auto border-r-3 border-on-background shadow-[4px_0px_0px_0px_rgba(0,0,0,1)]">
            <div class="p-4">
                <div class="flex items-center justify-between mb-6">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2">
                        <div class="w-8 h-8 navbar-brand-icon border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                            <span class="material-symbols-outlined text-on-primary text-lg">dashboard</span>
                        </div>
                        <span class="font-headline-lg text-lg uppercase tracking-tight">Admin</span>
                    </a>
                    <button @click="sidebarOpen = false" class="p-1.5 border-2 border-on-background hover:bg-surface-container-highest">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
                @include('layouts.partials.sidebar')
            </div>
        </div>

        {{-- DESKTOP SIDEBAR --}}
        <div class="hidden lg:fixed lg:inset-y-0 lg:z-30 lg:flex lg:w-[260px] lg:flex-col">
            <div class="flex grow flex-col gap-y-4 overflow-y-auto bg-surface border-r-3 border-on-background px-4 pb-4 shadow-[4px_0px_0px_0px_rgba(0,0,0,1)]">
                {{-- Brand --}}
                <div class="flex items-center gap-3 h-16 shrink-0 border-b-3 border-on-background">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5">
                        <div class="w-9 h-9 navbar-brand-icon border-3 border-on-background flex items-center justify-center shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">
                            <span class="material-symbols-outlined text-on-primary">dashboard</span>
                        </div>
                        <span class="font-headline-lg text-xl uppercase tracking-tight text-on-surface">Admin</span>
                    </a>
                </div>

                {{-- Sidebar Navigation --}}
                <nav class="flex flex-1 flex-col gap-0.5">
                    @include('layouts.partials.sidebar')
                </nav>

                {{-- Sidebar footer accent --}}
                <div class="h-1 bg-primary opacity-20"></div>
            </div>
        </div>

        {{-- MAIN CONTENT AREA --}}
        <div class="lg:pl-[260px]">
            {{-- TOP NAVBAR --}}
            <div class="sticky top-0 z-20 bg-surface/95 backdrop-blur-md border-b-3 border-on-background shadow-[0_4px_0px_0px_rgba(0,0,0,1)]">
                <div class="flex items-center justify-between h-16 px-4 md:px-6">
                    <div class="flex items-center gap-3">
                        <button @click="sidebarOpen = true" class="lg:hidden p-2 border-2 border-on-background hover:bg-surface-container-highest">
                            <span class="material-symbols-outlined">menu</span>
                        </button>
                        <div class="hidden md:flex items-center gap-2 font-label-mono text-xs uppercase text-on-surface-variant">
                            <a href="{{ route('admin.dashboard') }}" class="hover:text-primary transition-colors">Dashboard</a>
                            @hasSection('breadcrumb')
                                <span class="material-symbols-outlined text-sm">chevron_right</span>
                                @yield('breadcrumb')
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center gap-2" x-data="{ userMenu: false }">
                        {{-- Dark Mode Toggle --}}
                        <button @click="darkMode = !darkMode" class="dark-mode-toggle" title="Toggle dark mode">
                            <template x-if="!darkMode">
                                <span class="material-symbols-outlined text-sm">dark_mode</span>
                            </template>
                            <template x-if="darkMode">
                                <span class="material-symbols-outlined text-sm">light_mode</span>
                            </template>
                        </button>
                        <div class="flex items-center gap-2 font-label-mono text-xs uppercase text-on-surface-variant truncate max-w-[120px] sm:max-w-none">
                            <span class="w-7 h-7 rounded-full bg-primary flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                <span class="material-symbols-outlined text-on-primary text-xs">person</span>
                            </span>
                            <span>{{ Auth::user()->name }}</span>
                        </div>
                        <div class="relative">
                            <button @click="userMenu = !userMenu" class="w-9 h-9 bg-primary border-3 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 transition-all">
                                <span class="material-symbols-outlined text-on-primary text-sm">more_vert</span>
                            </button>
                            <div x-show="userMenu" x-cloak @click.outside="userMenu = false" x-transition class="absolute right-0 mt-2 w-48 bg-surface border-3 border-on-background shadow-[6px_6px_0px_0px rgba(0,0,0,1)] z-50">
                                <div class="p-1">
                                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-3 py-2 font-label-mono text-xs uppercase hover:bg-surface-container-low transition-colors rounded">
                                        <span class="material-symbols-outlined text-sm">settings</span>
                                        Pengaturan
                                    </a>
                                    <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-2 px-3 py-2 font-label-mono text-xs uppercase hover:bg-surface-container-low transition-colors rounded">
                                        <span class="material-symbols-outlined text-sm">open_in_new</span>
                                        Lihat Website
                                    </a>
                                    <hr class="border-on-background/20 my-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center gap-2 px-3 py-2 font-label-mono text-xs uppercase text-error hover:bg-error-container transition-colors rounded">
                                            <span class="material-symbols-outlined text-sm">logout</span>
                                            Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ALERTS --}}
            @if(session('success'))
                <div class="mx-4 md:mx-6 mt-4" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                    <div class="bg-secondary-fixed border-3 border-on-background shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-4 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-full bg-secondary border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                <span class="material-symbols-outlined text-on-secondary text-sm">check_circle</span>
                            </span>
                            <p class="font-body-md text-sm font-bold">{{ session('success') }}</p>
                        </div>
                        <button @click="show = false" class="p-1 hover:bg-surface-container-highest border-2 border-on-background">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </button>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mx-4 md:mx-6 mt-4" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                    <div class="bg-error-container border-3 border-on-background shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] p-4 flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <span class="w-8 h-8 rounded-full bg-error border-2 border-on-background flex items-center justify-center shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                                <span class="material-symbols-outlined text-on-error text-sm">error</span>
                            </span>
                            <p class="font-body-md text-sm font-bold">{{ session('error') }}</p>
                        </div>
                        <button @click="show = false" class="p-1 hover:bg-surface-container-highest border-2 border-on-background">
                            <span class="material-symbols-outlined text-sm">close</span>
                        </button>
                    </div>
                </div>
            @endif

            {{-- PAGE HEADER --}}
            @hasSection('page_title')
                <div class="px-4 md:px-6 pt-6 pb-2">
                    <h1 class="font-headline-lg text-2xl md:text-3xl uppercase tracking-tight">
                        @yield('page_title')
                    </h1>
                    <div class="page-header-accent"></div>
                    @hasSection('page_description')
                        <p class="font-body-md text-sm text-on-surface-variant mt-3">@yield('page_description')</p>
                    @endif
                </div>
            @endif

            {{-- MAIN CONTENT --}}
            <main class="px-4 md:px-6 py-6">
                @yield('content')
            </main>

            {{-- FOOTER --}}
            <div class="border-t-3 border-on-background px-4 md:px-6 py-4 bg-surface-container-low">
                <div class="flex items-center justify-between font-label-mono text-xs uppercase text-on-surface-variant">
                    <span>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</span>
                    <span>SMK Merdeka Bandung</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('click', function(e) {
            if (e.target.closest('[data-confirm-delete]')) {
                e.preventDefault();
                const btn = e.target.closest('[data-confirm-delete]');
                const form = btn.closest('form');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: btn.dataset.message || 'Data yang dihapus tidak dapat dikembalikan!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ba1a1a',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true,
                    customClass: {
                        popup: 'brutalist-border shadow-[12px_12px_0px_0px_rgba(0,0,0,1)] rounded-none',
                        confirmButton: 'admin-btn-danger admin-btn-sm',
                        cancelButton: 'admin-btn-secondary admin-btn-sm',
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            }
        });
    </script>
    @stack('scripts')
    <x:loading-overlay />
</body>
</html>
