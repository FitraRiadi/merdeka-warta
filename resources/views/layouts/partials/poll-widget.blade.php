@if($polls->isNotEmpty())
<style>
    @keyframes pollSlideUp {
        0% { opacity: 0; transform: translateY(8px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .poll-result { animation: pollSlideUp 0.35s ease-out forwards; }
</style>
<section class="mb-12 md:mb-16" data-intro-pop>
    <div class="flex items-center justify-between mb-5">
        <h2 class="font-headline-lg text-xl md:text-3xl uppercase flex items-center gap-3">
            <span class="material-symbols-outlined text-primary text-2xl">how_to_vote</span>
            POLLING
            <span class="font-label-mono text-[10px] text-on-surface-variant bg-surface-container-high px-2 py-0.5 rounded">{{ $polls->count() }}</span>
        </h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-5">
        @foreach($polls as $poll)
        <div data-poll-id="{{ $poll->id }}"
             data-poll-type="{{ $poll->type }}"
             data-poll-mode="{{ $poll->mode }}"
             data-poll-question="{{ $poll->question }}"
             class="poll-card group bg-white dark:bg-surface-container rounded-xl bento-shadow bento-card bento-card-static flex flex-col relative border-2 border-black dark:border-gray-700 transition-all duration-300 hover:-translate-y-1 hover:shadow-[4px_4px_0_0_#000] dark:hover:shadow-[4px_4px_0_0_#6366f1] cursor-pointer {{ $loop->first ? 'md:col-span-2 lg:col-span-2' : '' }}">

            <div class="h-1.5 w-full bg-gradient-to-r from-primary via-secondary to-tertiary shrink-0"></div>

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

                <h3 class="font-headline-lg text-sm md:text-base uppercase leading-tight mb-4 line-clamp-2 flex-1">
                    {{ $poll->question }}
                </h3>

                <div class="flex items-center justify-between mt-auto pt-3 border-t border-black/10 dark:border-gray-700">
                    <span class="font-label-mono text-[10px] text-on-surface-variant poll-votes-count">0 suara</span>
                    <span class="font-label-mono text-[10px] uppercase text-primary flex items-center gap-1 group-hover:gap-2 transition-all">
                        VOTE
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

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

        <div id="pollModalBody">
            <div class="text-center py-8 text-on-surface-variant font-label-mono text-xs">Memuat...</div>
        </div>

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
    var pollVotesCounts = document.querySelectorAll('.poll-votes-count');

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
        var html = '<div class="space-y-3 mb-6">';

        if (data.options && data.options.length) {
            data.options.forEach(function(opt) {
                var pct = opt.percentage || 0;
                html += '<div class="bg-surface-container-low rounded-xl p-4">';
                html += '<div class="flex items-center justify-between mb-2">';
                html += '<div class="flex items-center gap-2">';
                html += '<span class="font-bold text-sm">' + escapeHtml(opt.text) + '</span>';
                if (opt.is_correct) {
                    html += '<span class="material-symbols-outlined text-tertiary text-sm">check_circle</span>';
                }
                html += '</div>';
                html += '<span class="font-label-mono text-sm">' + opt.count + ' (' + pct + '%)</span>';
                html += '</div>';
                html += '<div class="w-full h-3 bg-surface-container-high rounded-full overflow-hidden">';
                html += '<div class="h-full bg-gradient-to-r from-primary to-secondary rounded-full" style="width:' + pct + '%"></div>';
                html += '</div>';
                html += '</div>';
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

        var html = '<div class="space-y-2 mb-4" id="pollOptionsContainer">';
        options.forEach(function(opt) {
            var inputType = pollType === 'multiple' ? 'checkbox' : 'radio';
            var inputName = 'poll_option';
            html += '<label class="flex items-start gap-3 p-3 rounded-xl hover:bg-surface-container-low cursor-pointer transition-colors border-2 border-transparent hover:border-primary/30">';
            html += '<input type="' + inputType + '" name="' + inputName + '" value="' + opt.id + '" class="mt-0.5 w-5 h-5 ' + (inputType === 'checkbox' ? 'rounded' : '') + ' accent-primary poll-option-input">';
            html += '<div class="flex-1"><span class="font-bold text-sm">' + escapeHtml(opt.text) + '</span></div>';
            html += '</label>';
        });
        html += '</div>';

        html += '<button type="button" id="pollSubmitBtn" class="w-full bg-gradient-to-r from-primary to-secondary text-on-primary rounded-xl py-3.5 font-label-mono text-xs uppercase hover:brightness-110 transition-all bento-shadow">KIRIM VOTE</button>';

        html += '<p id="pollError" class="text-error font-label-mono text-[10px] mt-2 text-center hidden"></p>';

        return html;
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

        if (pollMode === 'quiz') {
            pollModalMode.classList.remove('hidden');
        } else {
            pollModalMode.classList.add('hidden');
        }

        pollModalBody.innerHTML = '<div class="text-center py-8 text-on-surface-variant font-label-mono text-xs">Memuat...</div>';
        openModal();

        var storageKey = 'poll_' + pollId;
        var votedBefore = localStorage.getItem(storageKey) === '1';

        fetchResults(pollId).then(function(data) {
            if (votedBefore && data.total_votes > 0) {
                pollModalBody.innerHTML = renderResults(data, null);
                updateVotesCount(pollId, data.total_votes);
            } else {
                pollModalBody.innerHTML = renderForm(data.options || [], pollType);
                document.getElementById('pollSubmitBtn').addEventListener('click', function() {
                    handleSubmit(pollId, pollType);
                });
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
                if (err) {
                    err.textContent = data.message || 'Gagal mengirim vote.';
                    err.classList.remove('hidden');
                }
            }
        }).catch(function() {
            btn.disabled = false;
            btn.textContent = 'KIRIM VOTE';
            var err = document.getElementById('pollError');
            if (err) {
                err.textContent = 'Terjadi kesalahan. Coba lagi.';
                err.classList.remove('hidden');
            }
        });
    }

    // Init: attach click listeners to all poll cards
    document.querySelectorAll('.poll-card').forEach(function(card) {
        card.addEventListener('click', function() {
            var id = parseInt(card.dataset.pollId);
            var type = card.dataset.pollType;
            var mode = card.dataset.pollMode;
            var question = card.dataset.pollQuestion;
            loadPoll(id, type, mode, question);
        });

        // Load initial vote count
        var id = parseInt(card.dataset.pollId);
        fetchResults(id).then(function(data) {
            var el = card.querySelector('.poll-votes-count');
            if (el) el.textContent = data.total_votes + ' suara';
        }).catch(function() {});
    });
})();
</script>
@endif
