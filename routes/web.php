<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\LicenseExportController;
use App\Http\Controllers\LicenseRenewController;
use App\Http\Controllers\DashboardAnalyticController;
use App\Http\Controllers\LicenseSearchController;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

// Route::get('/', function () {
//     return redirect()->route('licenses.index');
// })->name('home');

Route::resource('licenses', LicenseController::class);
Route::patch('licenses/{license}/update-status', [LicenseController::class, 'updateStatus'])->name('licenses.updateStatus');
// Use the new controllers for export and renew
Route::get('export', [LicenseExportController::class, 'export'])->name('licenses.export');
Route::post('{license}/renew', [LicenseRenewController::class, 'renew'])->name('licenses.renew');
Route::get('analytics', [LicenseController::class, 'analytics'])->name('licenses.analytics');


// Add these routes before the auth middleware group
Route::get('/search', [LicenseSearchController::class, 'index'])->name('license.search');
Route::post('/search', [LicenseSearchController::class, 'search'])->name('license.search.result');
// Route::post('licenses/{license}/renew', [LicenseController::class, 'renew'])->name('licenses.renew');
// Route::get('licenses', [LicenseController::class, 'export'])->name('licenses.export');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
