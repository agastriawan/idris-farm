<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\UsermanagementController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\PublikController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Middleware\RoleMiddleware;


Route::get('/', [PublikController::class, 'index'])->name('index');
Route::get('artikels', [PublikController::class, 'artikel'])->name('artikel');
Route::get('katalogs', [PublikController::class, 'katalog'])->name('katalog');
Route::get('galeri', [PublikController::class, 'gallery'])->name('gallery');
Route::get('artikel-detail/{slug}', [PublikController::class, 'artikel_detail'])->name('artikel_detail');
Route::get('katalog-detail/{slug}', [PublikController::class, 'katalog_detail'])->name('katalog_detail');
Route::get('dashboard', [DashboardController::class, 'index'])->name('umkm')->middleware('auth');
Route::post('auth/_logout', [AuthController::class, '_logout']);

Route::prefix('auth')->middleware([RedirectIfAuthenticated::class . ':guest'])->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('_register', [AuthController::class, '_register'])->name('_register');
    Route::post('_login', [AuthController::class, '_login'])->name('_login');
});

Route::prefix('profile')->middleware('auth')->group(function () {
    Route::get('', [ProfileController::class, 'profile'])->name('profile');
    Route::post('_edit_user', [ProfileController::class, '_edit_user'])->name('_edit_user');
    Route::post('_edit_password', [ProfileController::class, '_edit_password'])->name('_edit_password');
});

Route::prefix('usermanagement')->middleware(['auth', RoleMiddleware::class . ':1'])->group(function () {
    Route::get('', [UsermanagementController::class, 'usermanagement'])->name('usermanagement');
    Route::get('tambah_user', [UsermanagementController::class, 'tambah_user'])->name('tambah_user');
    Route::get('edit_user/{id}', [UsermanagementController::class, 'edit_user'])->name('edit_user');
    Route::post('_tambah_user', [UsermanagementController::class, '_tambah_user'])->name('_tambah_user');
    Route::post('_list_user', [UsermanagementController::class, '_list_user'])->name('_list_user');
    Route::post('_edit_user', [UsermanagementController::class, '_edit_user'])->name('_edit_user');
    Route::delete('_delete_user/{id}', [UsermanagementController::class, '_delete_user'])->name('_delete_user');
});

Route::prefix('artikel')->middleware(['auth', RoleMiddleware::class . ':1'])->group(function () {
    Route::get('', [ArtikelController::class, 'artikel'])->name('artikel');
    Route::get('tambah_artikel', [ArtikelController::class, 'tambah_artikel'])->name('tambah_artikel');
    Route::get('edit_artikel/{id}', [ArtikelController::class, 'edit_artikel'])->name('edit_artikel');
    Route::post('_tambah_artikel', [ArtikelController::class, '_tambah_artikel'])->name('_tambah_artikel');
    Route::post('_list_artikel', [ArtikelController::class, '_list_artikel'])->name('_list_artikel');
    Route::post('_edit_artikel', [ArtikelController::class, '_edit_artikel'])->name('_edit_artikel');
    Route::delete('_delete_artikel/{id}', [ArtikelController::class, '_delete_artikel'])->name('_delete_artikel');
});

Route::prefix('animal')->middleware(['auth', RoleMiddleware::class . ':1'])->group(function () {
    Route::get('', [AnimalController::class, 'animal'])->name('animal');
    Route::get('tambah_animal', [AnimalController::class, 'tambah_animal'])->name('tambah_animal');
    Route::get('edit_animal/{id}', [AnimalController::class, 'edit_animal'])->name('edit_animal');
    Route::post('_tambah_animal', [AnimalController::class, '_tambah_animal'])->name('_tambah_animal');
    Route::post('_list_animal', [AnimalController::class, '_list_animal'])->name('_list_animal');
    Route::post('_edit_animal', [AnimalController::class, '_edit_animal'])->name('_edit_animal');
    Route::delete('_delete_animal/{id}', [AnimalController::class, '_delete_animal'])->name('_delete_animal');
});

Route::prefix('gallery')->middleware(['auth', RoleMiddleware::class . ':1'])->group(function () {
    Route::get('', [GalleryController::class, 'gallery'])->name('gallery');
    Route::get('tambah_gallery', [GalleryController::class, 'tambah_gallery'])->name('tambah_gallery');
    Route::get('edit_gallery/{id}', [GalleryController::class, 'edit_gallery'])->name('edit_gallery');
    Route::post('_tambah_gallery', [GalleryController::class, '_tambah_gallery'])->name('_tambah_gallery');
    Route::post('_list_gallery', [GalleryController::class, '_list_gallery'])->name('_list_gallery');
    Route::post('_edit_gallery', [GalleryController::class, '_edit_gallery'])->name('_edit_gallery');
    Route::delete('_delete_gallery/{id}', [GalleryController::class, '_delete_gallery'])->name('_delete_gallery');
});


Route::get('/404', function () {
    return view('404');
})->name('notFound');