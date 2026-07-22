<?php

use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\RunningTextController;
use App\Http\Controllers\Admin\SpotlightController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PollController as AdminPollController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\AnnouncementController as PublicAnnouncementController;
use App\Http\Controllers\Public\ArticleController as PublicArticleController;
use App\Http\Controllers\Public\ContributorPermissionController;
use App\Http\Controllers\Public\GalleryController as PublicGalleryController;
use App\Http\Controllers\Public\PollController as PublicPollController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ============================================================
// 1. ROUTE PUBLIK (FRONTEND)
// ============================================================
Route::get('/', [PublicArticleController::class, 'index'])->name('home');
Route::get('/articles', [PublicArticleController::class, 'list'])->name('public.article.list');
Route::get('/articles/{slug}', [PublicArticleController::class, 'show'])->name('public.article.show');
Route::get('/announcements', [PublicAnnouncementController::class, 'list'])->name('public.announcement.list');
Route::get('/announcements/{id}', [PublicAnnouncementController::class, 'show'])->name('public.announcement.show');
Route::get('/galleries', [PublicGalleryController::class, 'index'])->name('public.gallery.list');
Route::post('/contributor/permission', [ContributorPermissionController::class, 'store'])->name('public.contributor.permission');

// Polling (public)
Route::post('/polls/{poll}/vote', [PublicPollController::class, 'vote'])->name('public.poll.vote');
Route::get('/polls/{poll}/results', [PublicPollController::class, 'results'])->name('public.poll.results');

// ============================================================
// 2. ROUTE ADMIN (harus login)
// ============================================================

// 2a. Restore Super Admin — hidden ONLY
Route::middleware(['auth', 'hidden'])->prefix('admin')->group(function () {
    Route::get('/restore', [\App\Http\Controllers\Admin\RestoreSuperAdminController::class, 'index'])->name('admin.restore.index');
    Route::post('/restore', [\App\Http\Controllers\Admin\RestoreSuperAdminController::class, 'restore'])->name('admin.restore.store');
});

// 2b. Admin panel — NOT hidden (SA1 + author)
Route::middleware(['auth', 'not_hidden'])->prefix('admin')->as('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Upload gambar & file untuk Editor.js
    Route::post('/editor/upload-image', [AdminArticleController::class, 'uploadImage'])->name('editor.upload-image');
    Route::post('/editor/upload-file', [AdminArticleController::class, 'uploadFile'])->name('editor.upload-file');

    // CRUD Artikel (author & super_admin)
    // Otorisasi diatur melalui Policy (author hanya milik sendiri)
    Route::resource('articles', AdminArticleController::class);
    Route::patch('/articles/{article}/approve', [AdminArticleController::class, 'approve'])->name('articles.approve');
    Route::patch('/articles/{article}/reject', [AdminArticleController::class, 'reject'])->name('articles.reject');
    Route::patch('/articles/{article}/resubmit', [AdminArticleController::class, 'resubmit'])->name('articles.resubmit');

    // CRUD Pemberitahuan (hanya super_admin)
    Route::resource('announcements', AnnouncementController::class)
        ->middleware('super_admin');

    // CRUD Running Text (hanya super_admin)
    Route::resource('running-texts', RunningTextController::class)
        ->middleware('super_admin');

    // Manajemen Author (hanya super_admin)
    Route::resource('users', UserController::class)
        ->middleware('super_admin');

    // Polling (hanya super_admin, tanpa edit/update)
    Route::resource('polls', AdminPollController::class)
        ->middleware('super_admin')
        ->except(['edit', 'update']);

    // Spotlight (hanya super_admin)
    Route::controller(SpotlightController::class)
        ->middleware('super_admin')
        ->prefix('spotlights')
        ->name('spotlights.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/manage', 'manage')->name('manage');
            Route::post('/', 'store')->name('store');
        });

    // Gallery (otorisasi via GalleryPolicy)
    Route::resource('galleries', GalleryController::class);
    Route::patch('/galleries/{gallery}/approve', [GalleryController::class, 'approve'])->name('galleries.approve');
    Route::patch('/galleries/{gallery}/reject', [GalleryController::class, 'reject'])->name('galleries.reject');

    // Category (hanya super_admin)
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)
        ->middleware('super_admin')
        ->except(['show']);

    // Announcement Category (hanya super_admin)
    Route::resource('announcement-categories', \App\Http\Controllers\Admin\AnnouncementCategoryController::class)
        ->middleware('super_admin')
        ->except(['show']);

});

// ============================================================
// 3. ROUTE PROFIL (dari Breeze)
// ============================================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/settings', [ProfileController::class, 'updateSettings'])->name('profile.settings.update');
});

// ============================================================
// 4. REDIRECT DASHBOARD (setelah login)
// ============================================================
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware('auth')->name('dashboard');

// ============================================================
// 5. SERTAKAN ROUTE AUTH DARI BREEZE
// ============================================================
require __DIR__.'/auth.php';