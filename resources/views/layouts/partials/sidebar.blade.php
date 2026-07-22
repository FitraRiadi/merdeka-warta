{{-- Dashboard --}}
<a href="{{ route('admin.dashboard') }}"
   class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
    <span class="material-symbols-outlined {{ request()->routeIs('admin.dashboard') ? 'material-symbols-filled' : '' }}">dashboard</span>
    <span>DASHBOARD</span>
</a>

{{-- Articles (all roles) --}}
<a href="{{ route('admin.articles.index') }}"
   class="sidebar-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
    <span class="material-symbols-outlined {{ request()->routeIs('admin.articles.*') ? 'material-symbols-filled' : '' }}">description</span>
    <span>ARTICLES</span>
</a>

{{-- Gallery (all roles, policy-gated) --}}
<a href="{{ route('admin.galleries.index') }}"
   class="sidebar-link {{ request()->routeIs('admin.galleries.*') ? 'active' : '' }}">
    <span class="material-symbols-outlined {{ request()->routeIs('admin.galleries.*') ? 'material-symbols-filled' : '' }}">imagesmode</span>
    <span>GALERI</span>
</a>

{{-- Super Admin only --}}
@if(Auth::user()->isSuperAdmin())
    <div class="pt-5 pb-1 px-3">
        <p class="font-label-mono text-[10px] uppercase tracking-wider opacity-40">Management</p>
    </div>

    <a href="{{ route('admin.announcements.index') }}"
       class="sidebar-link {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}">
        <span class="material-symbols-outlined {{ request()->routeIs('admin.announcements.*') ? 'material-symbols-filled' : '' }}">campaign</span>
        <span>ANNOUNCEMENTS</span>
    </a>

    <a href="{{ route('admin.running-texts.index') }}"
       class="sidebar-link {{ request()->routeIs('admin.running-texts.*') ? 'active' : '' }}">
        <span class="material-symbols-outlined {{ request()->routeIs('admin.running-texts.*') ? 'material-symbols-filled' : '' }}">format_list_bulleted</span>
        <span>RUNNING TEXT</span>
    </a>

    <a href="{{ route('admin.categories.index') }}"
       class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
        <span class="material-symbols-outlined {{ request()->routeIs('admin.categories.*') ? 'material-symbols-filled' : '' }}">label</span>
        <span>KATEGORI</span>
    </a>

    <a href="{{ route('admin.polls.index') }}"
       class="sidebar-link {{ request()->routeIs('admin.polls.*') ? 'active' : '' }}">
        <span class="material-symbols-outlined {{ request()->routeIs('admin.polls.*') ? 'material-symbols-filled' : '' }}">poll</span>
        <span>POLLING</span>
    </a>

    <a href="{{ route('admin.spotlights.index') }}"
       class="sidebar-link {{ request()->routeIs('admin.spotlights.*') ? 'active' : '' }}">
        <span class="material-symbols-outlined {{ request()->routeIs('admin.spotlights.*') ? 'material-symbols-filled' : '' }}">stars</span>
        <span>SOROTAN</span>
    </a>

    <a href="{{ route('admin.users.index') }}"
       class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        <span class="material-symbols-outlined {{ request()->routeIs('admin.users.*') ? 'material-symbols-filled' : '' }}">group</span>
        <span>KONTRIBUTOR</span>
    </a>
@endif

<div class="pt-5 pb-1 px-3">
    <p class="font-label-mono text-[10px] uppercase tracking-wider opacity-40">Others</p>
</div>

{{-- Profile / Settings --}}
<a href="{{ route('profile.edit') }}"
   class="sidebar-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
    <span class="material-symbols-outlined {{ request()->routeIs('profile.edit') ? 'material-symbols-filled' : '' }}">settings</span>
    <span>SETTINGS</span>
</a>

{{-- Dark Mode --}}
<a href="#"
   class="sidebar-link"
   onclick="event.preventDefault(); document.documentElement.classList.toggle('dark'); localStorage.setItem('dark-mode', document.documentElement.classList.contains('dark'));">
    <span class="material-symbols-outlined" id="sidebar-theme-icon">dark_mode</span>
    <span id="sidebar-theme-text">THEME</span>
</a>

<script>
    (function() {
        const icon = document.getElementById('sidebar-theme-icon');
        const text = document.getElementById('sidebar-theme-text');
        if (icon && text) {
            const isDark = document.documentElement.classList.contains('dark');
            icon.textContent = isDark ? 'light_mode' : 'dark_mode';
            text.textContent = isDark ? 'TERANG' : 'GELAP';
        }
        document.querySelector('.sidebar-link[onclick]')?.addEventListener('click', function() {
            setTimeout(() => {
                const isDark = document.documentElement.classList.contains('dark');
                icon.textContent = isDark ? 'light_mode' : 'dark_mode';
                text.textContent = isDark ? 'TERANG' : 'GELAP';
            }, 50);
        });
    })();
</script>

{{-- Back to Website --}}
<a href="{{ route('home') }}" target="_blank" class="sidebar-link">
    <span class="material-symbols-outlined">open_in_new</span>
    <span>WEBSITE</span>
</a>

{{-- Logout --}}
<form method="POST" action="{{ route('logout') }}" class="block">
    @csrf
    <button type="submit" class="sidebar-link w-full text-error hover:text-error hover:bg-error-container">
        <span class="material-symbols-outlined">logout</span>
        <span>LOGOUT</span>
    </button>
</form>
