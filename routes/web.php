<?php

use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\RunningTextController;
use App\Http\Controllers\Admin\SpotlightController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\AnnouncementController as PublicAnnouncementController;
use App\Http\Controllers\Public\ArticleController as PublicArticleController;
use App\Http\Controllers\Public\ContributorPermissionController;
use App\Http\Controllers\Public\GalleryController as PublicGalleryController;
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

// ============================================================
// 2. ROUTE ADMIN (harus login)
// ============================================================
Route::middleware(['auth'])->prefix('admin')->as('admin.')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Upload gambar & file untuk Editor.js
    Route::post('/editor/upload-image', [AdminArticleController::class, 'uploadImage'])->name('editor.upload-image');
    Route::post('/editor/upload-by-url', [AdminArticleController::class, 'uploadImageByUrl'])->name('editor.upload-by-url');
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

    // Gallery (hanya super_admin)
    Route::resource('galleries', GalleryController::class)
        ->middleware('super_admin');

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