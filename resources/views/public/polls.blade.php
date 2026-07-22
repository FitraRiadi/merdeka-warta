<!DOCTYPE html>
<html lang="id">
<head>
    <script>
        if (localStorage.getItem('dark-mode') === 'true' || (!('dark-mode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Polling | Merdeka Warta</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Plus+Jakarta+Sans:wght@400;500;700;800&family=JetBrains+Mono:wght@700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
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
                    borderRadius: { DEFAULT: "0.125rem", lg: "0.25rem", xl: "0.75rem", "2xl": "1rem", full: "0.75rem" },
                    spacing: { "margin-mobile": "16px", gutter: "24px", "margin-desktop": "64px", "grid-unit": "8px" },
                    fontFamily: { "headline-lg-mobile": ["Anton"], "label-mono": ["JetBrains Mono"], "headline-lg": ["Anton"], "body-md": ["Plus Jakarta Sans"], "display-xl": ["Anton"] },
                    fontSize: {
                        "headline-lg-mobile": ["36px", { lineHeight: "100%", fontWeight: "400" }],
                        "label-mono": ["12px", { lineHeight: "1.2", fontWeight: "700" }],
                        "headline-lg": ["48px", { lineHeight: "100%", fontWeight: "400" }],
                        "body-md": ["16px", { lineHeight: "1.6", fontWeight: "500" }],
                        "display-xl": ["84px", { lineHeight: "90%", letterSpacing: "-0.02em", fontWeight: "400" }]
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
        * { box-sizing: border-box; }
        body { margin: 0; background-color: var(--background); font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; width: 100%; max-width: 100%; }
        .bento-shadow { box-shadow: 3px 3px 0px 0px #000; }
        .bento-card { border: 2px solid #000; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; vertical-align: middle; }
        .material-symbols-filled { font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        @keyframes pollSlideUp { 0% { opacity: 0; transform: translateY(8px); } 100% { opacity: 1; transform: translateY(0); } }
        .poll-result { animation: pollSlideUp 0.35s ease-out forwards; }
        :where(.dark) .card-border { border-color: #374151; }
        #mobile-sidebar { transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
        #mobile-sidebar.closed { transform: translateX(100%); }
        #mobile-sidebar:not(.closed) { transform: translateX(0); }
        #sidebar-overlay { transition: opacity 0.3s ease-in-out; }
        #sidebar-overlay.closed { opacity: 0 !important; pointer-events: none !important; }
        #sidebar-overlay:not(.closed) { opacity: 1 !important; pointer-events: auto !important; }
    </style>
    @include('layouts.partials.pattern-styles')
    @include('layouts.partials.seo-meta', [
        'title' => 'Polling | Merdeka Warta',
        'description' => 'Ikuti polling dan quiz interaktif dari SMK Merdeka Bandung. Berikan suaramu!',
    ])
</head>
<body class="bg-surface text-on-surface min-h-screen flex flex-col font-body-md">

    @include('layouts.partials.public-navbar', ['runningTexts' => $runningTexts ?? collect()])

    <main class="flex-grow max-w-7xl mx-auto w-full px-4 md:px-6 py-8 md:py-12 bg-paper">
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center gap-2 text-on-surface-variant font-label-mono text-xs uppercase mb-3">
                <a class="hover:text-primary transition-colors" href="{{ route('home') }}">Home</a>
                <span class="material-symbols-outlined text-sm">chevron_right</span>
                <span class="text-primary">Polling</span>
            </div>
            <div class="flex items-center gap-3">
                <span class="w-1.5 h-6 md:w-2 md:h-8 bg-gradient-to-b from-primary to-secondary rounded"></span>
                <h1 class="font-headline-lg text-2xl sm:text-3xl md:text-4xl uppercase tracking-tighter">POLLING</h1>
            </div>
            <div class="h-px bg-outline-variant flex-grow mt-3"></div>
        </div>

        @if($polls->isEmpty())
        <div class="text-center py-20">
            <span class="material-symbols-outlined text-5xl text-on-surface-variant mb-4">poll</span>
            <p class="font-headline-lg text-xl uppercase text-on-surface-variant">Belum ada polling</p>
            <p class="text-on-surface-variant text-sm mt-2">Nantikan polling menarik dari kami!</p>
        </div>
        @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-5">
            @foreach($polls as $poll)
            @php
                $bgColors = [
                    'bg-red-200 dark:bg-red-900',
                    'bg-blue-200 dark:bg-blue-900',
                    'bg-green-200 dark:bg-green-900',
                    'bg-yellow-200 dark:bg-yellow-900',
                    'bg-purple-200 dark:bg-purple-900',
                    'bg-pink-200 dark:bg-pink-900',
                    'bg-indigo-200 dark:bg-indigo-900',
                    'bg-orange-200 dark:bg-orange-900',
                    'bg-teal-200 dark:bg-teal-900',
                    'bg-cyan-200 dark:bg-cyan-900',
                ];
                $bg = $bgColors[$loop->index % count($bgColors)];
            @endphp
            <div data-poll-id="{{ $poll->id }}"
                 data-poll-type="{{ $poll->type }}"
                 data-poll-mode="{{ $poll->mode }}"
                 data-poll-question="{{ $poll->question }}"
                 class="poll-card group {{ $bg }} rounded-xl bento-shadow bento-card flex flex-col relative border-2 border-black dark:border-gray-700 transition-all duration-300 hover:-translate-y-1 hover:shadow-[4px_4px_0_0_#000] dark:hover:shadow-[4px_4px_0_0_#6366f1] cursor-pointer {{ $loop->first ? 'md:col-span-2 lg:col-span-2' : '' }}">

                <div class="flex-1 flex flex-col p-5">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary text-xl group-hover:scale-110 transition-transform">poll</span>
                            <span class="font-label-mono text-[10px] uppercase text-on-surface-variant">Polling</span>
                        </div>
                        @if($poll->mode === 'quiz')
                        <span class="bg-tertiary/10 text-tertiary px-2 py-0.5 font-label-mono text-[10px] rounded">QUIZ</span>
                        @endif
                    </div>
                    <h3 class="font-headline-lg text-sm md:text-base uppercase leading-tight mb-4 line-clamp-2 flex-1 [text-shadow:2px_2px_0_rgba(0,0,0,0.08)] dark:[text-shadow:2px_2px_0_rgba(0,0,0,0.3)]">{{ $poll->question }}</h3>
                    <div class="flex items-center gap-3 text-[10px] font-label-mono text-on-surface-variant mb-2 flex-wrap">
                        <span class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-[12px]">calendar_today</span>
                            {{ $poll->created_at->format('d M Y') }}
                        </span>
                        @if($poll->closes_at)
                        <span class="text-on-surface-variant">·</span>
                        <span class="flex items-center gap-1">
                            <span class="material-symbols-outlined text-[12px]">event_busy</span>
                            {{ $poll->closes_at->format('d M Y') }}
                        </span>
                        @endif
                    </div>
                    <div class="flex items-center justify-between mt-auto pt-3 border-t border-black/10 dark:border-gray-700">
                        <span class="font-label-mono text-[10px] text-on-surface-variant poll-votes-count">0 suara</span>
                        <span class="font-label-mono text-[10px] uppercase text-primary flex items-center gap-1 group-hover:gap-2 transition-all">
                            VOTE <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        @if($polls->hasPages())
        <div class="mt-8">
            {{ $polls->links() }}
        </div>
        @endif
        @endif
    </main>

    @include('layouts.partials.public-footer')

    {{-- Modal --}}
    <div id="pollModal" class="fixed inset-0 z-[100] items-center justify-center p-4 hidden" style="display:none">
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" id="pollModalBackdrop"></div>
        <div class="relative w-full max-w-lg max-h-[90vh] overflow-y-auto bg-white dark:bg-surface-container rounded-2xl bento-shadow border-2 border-black dark:border-gray-700 p-6 md:p-8">
            <button type="button" id="pollModalClose" class="absolute top-4 right-4 w-8 h-8 flex items-center justify-center rounded-xl hover:bg-surface-container-high transition-colors">
                <span class="material-symbols-outlined text-lg">close</span>
            </button>
            <div class="mb-6">
                <div class="flex items-center gap-2 mb-3">
                    <span class="material-symbols-outlined text-primary text-xl">poll</span>
                    <span class="font-label-mono text-[10px] uppercase text-on-surface-variant">Polling</span>
                    <span id="pollModalMode" class="hidden px-2 py-0.5 font-label-mono text-[10px] rounded bg-tertiary/10 text-tertiary">QUIZ</span>
                    <span id="pollModalType" class="font-label-mono text-[10px] uppercase px-2 py-0.5 rounded bg-surface-container-high"></span>
                </div>
                <h2 id="pollModalQuestion" class="font-headline-lg text-xl md:text-2xl uppercase leading-tight"></h2>
            </div>
            <div id="pollModalBody" class="text-center py-8 text-on-surface-variant font-label-mono text-xs">Memuat...</div>
            <div class="text-center mt-4">
                <button type="button" id="pollModalTutup" class="font-label-mono text-[10px] uppercase text-on-surface-variant hover:text-primary transition-colors">TUTUP</button>
            </div>
        </div>
    </div>

    <script>
        (function() {
            var pollModal = document.getElementById('pollModal');
            var pollModalBody = document.getElementById('pollModalBody');
            var pollModalQuestion = document.getElementById('pollModalQuestion');
            var pollModalType = document.getElementById('pollModalType');
            var pollModalMode = document.getElementById('pollModalMode');

            var currentPollId = null;
            var currentPollType = null;
            var currentPollMode = null;

            function closeModal() {
                pollModal.classList.add('hidden');
                pollModal.style.display = 'none';
                document.body.style.overflow = '';
            }

            document.getElementById('pollModalClose').addEventListener('click', closeModal);
            document.getElementById('pollModalTutup').addEventListener('click', closeModal);
            document.getElementById('pollModalBackdrop').addEventListener('click', closeModal);

            function openModal() {
                pollModal.classList.remove('hidden');
                pollModal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }

            function fetchResults(pollId) {
                return fetch('/polls/' + pollId + '/results').then(function(r) {
                    if (!r.ok) throw new Error('HTTP ' + r.status);
                    return r.json();
                });
            }

            function submitVote(pollId, pollType, optionIds) {
                var ids = pollType === 'single' ? optionIds[0] : optionIds;
                return fetch('/polls/' + pollId + '/vote', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                    },
                    body: JSON.stringify({ option_ids: ids }),
                }).then(function(r) { return r.json(); });
            }

            function renderResults(data, voteResult) {
                var userIds = voteResult ? (Array.isArray(voteResult) ? voteResult : [voteResult]) : [];
                var html = '<div class="space-y-3 mb-6">';
                if (data.options && data.options.length) {
                    data.options.forEach(function(opt) {
                        var pct = opt.percentage || 0;
                        var isMine = userIds.indexOf(opt.id) !== -1;
                        html += '<div class="rounded-xl p-4 ' + (isMine ? 'border-2 border-primary bg-primary/5' : 'bg-surface-container-low') + '">';
                        html += '<div class="flex items-center justify-between mb-2">';
                        html += '<div class="flex items-center gap-2">';
                        html += '<span class="font-bold text-sm">' + escapeHtml(opt.text) + '</span>';
                        if (isMine) {
                        }
                        if (opt.is_correct) {
                            html += '<span class="material-symbols-outlined text-tertiary text-sm">check_circle</span>';
                        }
                        html += '</div>';
                        html += '<span class="font-label-mono text-sm">' + opt.count + ' (' + pct + '%)</span>';
                        html += '</div>';
                        html += '<div class="w-full h-3 bg-surface-container-high rounded-full overflow-hidden">';
                        html += '<div class="h-full bg-gradient-to-r from-primary to-secondary rounded-full" style="width:' + pct + '%"></div>';
                        html += '</div></div>';
                    });
                }
                html += '<p class="font-label-mono text-[10px] text-on-surface-variant text-center">Total ' + data.total_votes + ' suara</p>';
                html += '<div class="text-center bg-surface-container-high rounded-xl py-2.5 mt-3"><span class="font-label-mono text-[10px] uppercase text-on-surface-variant">Kamu sudah melakukan polling</span></div>';

                if (data.mode === 'quiz' && voteResult) {
                    var isCorrect = false;
                    if (data.options) {
                        var correctIds = data.options.filter(function(o) { return o.is_correct; }).map(function(o) { return o.id; });
                        var userIds = Array.isArray(voteResult) ? voteResult : [voteResult];
                        isCorrect = userIds.some(function(id) { return correctIds.indexOf(id) !== -1; });
                    }
                    if (isCorrect) {
                        html += '<div class="text-center rounded-xl py-3 px-4 mt-4 poll-result" style="background:#f0fdf4;border:2px solid #22c55e"><span class="text-green-700 font-bold text-sm flex items-center justify-center gap-1.5"><span class="material-symbols-outlined text-green-600 text-base">check_circle</span> Jawaban kamu benar!</span></div>';
                    } else if (data.correct_votes > 0) {
                        html += '<div class="text-center rounded-xl py-3 px-4 mt-4 poll-result" style="background:#fef2f2;border:2px solid #ef4444"><span class="text-red-700 font-bold text-sm flex items-center justify-center gap-1.5"><span class="material-symbols-outlined text-red-500 text-base">cancel</span> Jawaban kamu salah!</span></div>';
                    }
                }
                html += '</div>';
                return html;
            }

            function renderForm(options, pollType) {
                if (!options || !options.length) {
                    return '<div class="text-center py-4 text-on-surface-variant font-label-mono text-xs">Belum ada opsi polling.</div>';
                }
                var html = '<div class="space-y-3 mb-4" id="pollOptionsContainer">';
                options.forEach(function(opt) {
                    var inputType = pollType === 'multiple' ? 'checkbox' : 'radio';
                    html += '<label class="flex items-start gap-3 p-4 rounded-xl hover:bg-surface-container-low cursor-pointer transition-all border-2 border-black/10 dark:border-gray-700 hover:border-primary/50 poll-option-label">';
                    html += '<input type="' + inputType + '" name="poll_option" value="' + opt.id + '" class="mt-0.5 w-5 h-5 ' + (inputType === 'checkbox' ? 'rounded' : '') + ' accent-primary poll-option-input">';
                    html += '<div class="flex-1"><span class="font-bold text-sm">' + escapeHtml(opt.text) + '</span></div>';
                    html += '</label>';
                });
                html += '</div>';
                html += '<button type="button" id="pollSubmitBtn" class="w-full bg-gradient-to-r from-primary to-secondary text-on-primary rounded-xl py-3.5 font-label-mono text-xs uppercase hover:brightness-110 transition-all bento-shadow">KIRIM VOTE</button>';
                html += '<p id="pollError" class="text-error font-label-mono text-[10px] mt-2 text-center hidden"></p>';
                return html;
            }

            function setupOptionToggles(pollType) {
                var container = document.getElementById('pollOptionsContainer');
                if (!container) return;
                var inputs = container.querySelectorAll('.poll-option-input');
                inputs.forEach(function(input) {
                    input.addEventListener('change', function() {
                        var label = this.closest('.poll-option-label');
                        if (this.checked) {
                            label.classList.add('border-primary', 'bg-primary/5');
                            label.classList.remove('border-black/10', 'dark:border-gray-700');
                        } else {
                            label.classList.remove('border-primary', 'bg-primary/5');
                            label.classList.add('border-black/10', 'dark:border-gray-700');
                        }
                    });
                });
                if (pollType === 'single') {
                    var lastChecked = null;
                    inputs.forEach(function(input) {
                        input.addEventListener('click', function() {
                            if (lastChecked === this) {
                                this.checked = false;
                                lastChecked = null;
                                var label = this.closest('.poll-option-label');
                                label.classList.remove('border-primary', 'bg-primary/5');
                                label.classList.add('border-black/10', 'dark:border-gray-700');
                            } else {
                                lastChecked = this;
                            }
                        });
                    });
                }
            }

            function escapeHtml(text) {
                var div = document.createElement('div');
                div.appendChild(document.createTextNode(text));
                return div.innerHTML;
            }

            function getSelectedOptions() {
                var checked = document.querySelectorAll('#pollOptionsContainer .poll-option-input:checked');
                var ids = [];
                checked.forEach(function(cb) { ids.push(parseInt(cb.value)); });
                return ids;
            }

            function updateVotesCount(pollId, count) {
                document.querySelectorAll('.poll-card[data-poll-id="' + pollId + '"] .poll-votes-count').forEach(function(el) {
                    el.textContent = count + ' suara';
                });
            }

            function loadPoll(pollId, pollType, pollMode, question) {
                currentPollId = pollId;
                currentPollType = pollType;
                currentPollMode = pollMode;

                pollModalQuestion.textContent = question;
                pollModalType.textContent = pollType === 'multiple' ? 'Pilih Banyak' : 'Pilih Satu';
                pollModalType.className = 'font-label-mono text-[10px] uppercase px-2 py-0.5 rounded bg-surface-container-high ' + (pollType === 'multiple' ? 'text-secondary' : 'text-primary');
                if (pollMode === 'quiz') { pollModalMode.classList.remove('hidden'); } else { pollModalMode.classList.add('hidden'); }

                pollModalBody.innerHTML = '<div class="text-center py-8 text-on-surface-variant font-label-mono text-xs">Memuat...</div>';
                openModal();

                fetchResults(pollId).then(function(data) {
                    if (data.has_voted) {
                        pollModalBody.innerHTML = renderResults(data, data.voted_option_ids || null);
                        updateVotesCount(pollId, data.total_votes);
                    } else {
                        pollModalBody.innerHTML = renderForm(data.options || [], pollType);
                        document.getElementById('pollSubmitBtn').addEventListener('click', function() { handleSubmit(pollId, pollType); });
                        setupOptionToggles(pollType);
                    }
                }).catch(function() {
                    pollModalBody.innerHTML = '<div class="text-center py-4 text-error font-label-mono text-xs">Gagal memuat polling.</div>';
                });
            }

            function handleSubmit(pollId, pollType) {
                var selected = getSelectedOptions();
                if (selected.length === 0) return;
                var btn = document.getElementById('pollSubmitBtn');
                btn.disabled = true;
                btn.textContent = 'MENGIRIM...';
                submitVote(pollId, pollType, selected).then(function(data) {
                    if (data.success) {
                        var results = data.results || { options: [], total_votes: 0, correct_votes: 0, mode: currentPollMode };
                        localStorage.setItem('poll_' + pollId, '1');
                        pollModalBody.innerHTML = renderResults(results, selected);
                        updateVotesCount(pollId, results.total_votes);
                    } else {
                        btn.disabled = false;
                        btn.textContent = 'KIRIM VOTE';
                        var err = document.getElementById('pollError');
                        if (err) { err.textContent = data.message || 'Gagal mengirim vote.'; err.classList.remove('hidden'); }
                    }
                }).catch(function() {
                    btn.disabled = false;
                    btn.textContent = 'KIRIM VOTE';
                    var err = document.getElementById('pollError');
                    if (err) { err.textContent = 'Terjadi kesalahan. Coba lagi.'; err.classList.remove('hidden'); }
                });
            }

            // Init
            document.querySelectorAll('.poll-card').forEach(function(card) {
                card.addEventListener('click', function() {
                    loadPoll(parseInt(card.dataset.pollId), card.dataset.pollType, card.dataset.pollMode, card.dataset.pollQuestion);
                });
                var id = parseInt(card.dataset.pollId);
                fetchResults(id).then(function(data) {
                    var el = card.querySelector('.poll-votes-count');
                    if (el) el.textContent = data.total_votes + ' suara';
                }).catch(function() {});
            });
        })();
    </script>

    <script>
        (function() {
            const openBtn = document.getElementById('open-sidebar');
            const closeBtn = document.getElementById('close-sidebar');
            const sidebar = document.getElementById('mobile-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            if (openBtn && closeBtn && sidebar && overlay) {
                function openSidebar() { sidebar.classList.remove('closed'); overlay.classList.remove('closed'); document.body.style.overflow = 'hidden'; }
                function closeSidebar() { sidebar.classList.add('closed'); overlay.classList.add('closed'); document.body.style.overflow = ''; }
                openBtn.addEventListener('click', openSidebar);
                closeBtn.addEventListener('click', closeSidebar);
                overlay.addEventListener('click', closeSidebar);
            }
        })();
    </script>

    @include('layouts.partials.scroll-to-top')
</body>
</html>
