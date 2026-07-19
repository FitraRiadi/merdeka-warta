# User Info

- **Nama:** Fitra Riadi
- **Panggilan:** Fit
- **Sekolah:** SMK Merdeka Bandung, Kelas 12 RPL (Rekayasa Perangkat Lunak)

# Asisten

- **Nama:** Chapt
- Panggil saya Chapt, bukan opencode atau asisten.

# Gaya Bicara

- Santai, natural, gak kaku, gak kayak robot.
- Anggap aja lo partner project gue, bukan asisten resmi.
- Gausah terlalu humble, langsung cair aja.
- Gunakan bahasa Indonesia.



# MerdekaWarta — Agent Guide

## Stack
- Laravel 12, PHP ^8.2, Blade + Tailwind CSS 3 + Alpine.js, Vite
- MySQL (local), SQLite :memory: (tests)
- Auth: Laravel Breeze (Blade stack)

## Quick start
```bash
composer setup          # full install: composer install → .env → key → migrate → npm i → npm build
composer dev            # run all dev servers: artisan serve + queue:listen + pail + vite
composer test           # artisan config:clear && artisan test
npm run dev             # vite dev server only
npm run build           # vite build
```

## Testing
- `php artisan test` or `composer test` (runs config:clear first)
- `php artisan test --filter=SomeTest`
- `php artisan test tests/Unit/SomeTest.php`
- Tests use in-memory SQLite — no external DB needed
- Test suites: `tests/Unit` and `tests/Feature`

## Project structure
- `app/Http/Controllers/Admin/` — admin CRUD (articles, announcements, running-texts, users)
- `app/Http/Controllers/Public/` — public article listing/detail
- `app/Models/` — User, Article, Announcement, RunningText
- `app/Policies/ArticlePolicy.php` — gates article CRUD per role
- `app/Http/Middleware/` — SuperAdminMiddleware (alias `super_admin`), CheckRole (alias `role`)
- `app/Services/CdnService.php` — image upload to external CDN
- `routes/web.php` — public routes + admin group (`/admin`, auth gate) + profile
- `routes/auth.php` — Breeze auth routes (included from web.php)
- `resources/views/public/` — public-facing Blade views
- `resources/views/admin/` — admin panel Blade views
- `bootstrap/app.php` — middleware aliases registered here

## Roles & authorization
- **`super_admin`**: full access to all admin features (users, announcements, running texts, all articles)
- **`author`**: can create/edit/delete own articles only
- Role stored in `users.role` column (string)
- Middleware `super_admin` gates announcements, running-texts, user management
- `ArticlePolicy` gates article operations (super_admin = all; author = own only)
- `User::isSuperAdmin()`, `User::isAuthor()`, `User::canCreateArticle()` helper methods

## Seeders (run in order via `DatabaseSeeder`)
1. `SuperAdminSeeder` — `superadmin@merdekawarta.com` / `password`
2. `AuthorSeeder`
3. `ArticleSeeder`
4. `AnnouncementSeeder`
5. `RunningTextSeeder`

## Key routes
| URL | Method | Description |
|-----|--------|-------------|
| `/` | GET | Public home |
| `/article/{slug}` | GET | Public article detail |
| `/admin/dashboard` | GET | Admin dashboard (auth) |
| `/admin/articles` | CRUD | Article management (auth + policy) |
| `/admin/announcements` | CRUD | Super admin only |
| `/admin/running-texts` | CRUD | Super admin only |
| `/admin/users` | CRUD | Super admin only |
| `/login` | GET/POST | Login |
| `/profile` | GET/PATCH/DELETE | Profile management |


## Notable quirks
- `Article.content` stores JSON string (blocks format), decoded via `$article->content_array` accessor
- Image uploads go to external CDN (`https://cdn.ryzahen.web.id/upload`) via `CdnService` — CDN does not support DELETE
- Slug auto-generated from title with deduplication suffix
- **Login redirect**: ALL roles go to `admin.dashboard` after login (`AuthenticatedSessionController` line 34), author no longer sent to `admin.articles.index`
- Blade views use Indonesian language in UI text
- Indent: 4 spaces (`.editorconfig`), LF line endings
- No code formatter config found beyond `.editorconfig`
- Admin UI uses Tailwind CSS + Font Awesome 6 via CDN, Alpine.js for interactivity
