<?php

use App\Http\Controllers\Admin\ChatController as AdminChatController;
use App\Http\Controllers\Admin\ClaimController as AdminClaimController;
use App\Http\Controllers\Admin\FoundItemController as AdminFoundItemController;
use App\Http\Controllers\Admin\LostItemController as AdminLostItemController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\ChatController;
use App\Http\Controllers\User\ClaimController;
use App\Http\Controllers\User\FoundItemController;
use App\Http\Controllers\User\LostItemController;
use App\Http\Controllers\User\MatchController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::middleware(['auth', 'role:normal_user'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'user'])->name('user.dashboard');

    Route::get('/lost-items', [LostItemController::class, 'index'])->name('user.lost-items.index');
    Route::get('/lost-items/create', [LostItemController::class, 'create'])->name('user.lost-items.create');
    Route::post('/lost-items', [LostItemController::class, 'store'])->name('user.lost-items.store');
    Route::get('/lost-items/{lostItem}', [LostItemController::class, 'show'])->name('user.lost-items.show');

    Route::get('/found-items', [FoundItemController::class, 'index'])->name('user.found-items.index');
    Route::get('/found-items/{foundItem}', [FoundItemController::class, 'show'])->name('user.found-items.show');

    Route::get('/lost-items/{lostItem}/matches', [MatchController::class, 'index'])->name('user.lost-items.matches');

    Route::get('/claims', [ClaimController::class, 'index'])->name('user.claims.index');
    Route::get('/found-items/{foundItem}/claim', [ClaimController::class, 'create'])->name('user.claims.create');
    Route::post('/found-items/{foundItem}/claim', [ClaimController::class, 'store'])->name('user.claims.store');
    Route::get('/claims/{claim}', [ClaimController::class, 'show'])->name('user.claims.show');
    Route::post('/claims/{claim}/chat', [ChatController::class, 'store'])->name('user.claims.chat.store');
});

Route::middleware(['auth', 'role:security_admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

    Route::get('/admin/found-items', [AdminFoundItemController::class, 'index'])->name('admin.found-items.index');
    Route::get('/admin/found-items/create', [AdminFoundItemController::class, 'create'])->name('admin.found-items.create');
    Route::post('/admin/found-items', [AdminFoundItemController::class, 'store'])->name('admin.found-items.store');
    Route::get('/admin/found-items/{foundItem}', [AdminFoundItemController::class, 'show'])->name('admin.found-items.show');
    Route::patch('/admin/found-items/{foundItem}/status', [AdminFoundItemController::class, 'updateStatus'])->name('admin.found-items.update-status');

    Route::get('/admin/claims', [AdminClaimController::class, 'index'])->name('admin.claims.index');
    Route::get('/admin/claims/{claim}', [AdminClaimController::class, 'show'])->name('admin.claims.show');
    Route::post('/admin/claims/{claim}/approve', [AdminClaimController::class, 'approve'])->name('admin.claims.approve');
    Route::post('/admin/claims/{claim}/reject', [AdminClaimController::class, 'reject'])->name('admin.claims.reject');
    Route::post('/admin/claims/{claim}/chat', [AdminChatController::class, 'store'])->name('admin.claims.chat.store');

    Route::get('/admin/lost-items', [AdminLostItemController::class, 'index'])->name('admin.lost-items.index');
    Route::get('/admin/lost-items/{lostItem}', [AdminLostItemController::class, 'show'])->name('admin.lost-items.show');
    Route::delete('/admin/lost-items/{lostItem}', [AdminLostItemController::class, 'destroy'])->name('admin.lost-items.destroy');
});

Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::get('/super-admin/dashboard', [DashboardController::class, 'superAdmin'])->name('superadmin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
