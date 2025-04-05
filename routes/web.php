<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MikroTikController;
use App\Http\Controllers\OltDeviceController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Authentication Routes

Route::get('/', function () {
    // If the user is logged in, redirect to the appropriate dashboard
    if (Auth::check()) {
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    }
    // If not logged in, show the login page
    return redirect()->route('login');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes (protected by auth middleware)
Route::middleware(['auth'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');

    // MikroTik Device Routes
    Route::get('/admin/mikrotik/devices', [MikroTikController::class, 'showDevices'])->name('admin.mikrotik.devices');
    Route::get('/admin/mikrotik/device/add', [MikroTikController::class, 'addDeviceForm'])->name('admin.mikrotik.device.add');
    Route::post('/admin/mikrotik/device/add', [MikroTikController::class, 'addDevice'])->name('admin.mikrotik.device.store');
    Route::get('/admin/mikrotik/stats/{deviceId}', [MikroTikController::class, 'showMikrotikStats'])->name('admin.mikrotik.stats');
    Route::post('/admin/mikrotik/adduser', [MikroTikController::class, 'addUserToMikrotik'])->name('admin.mikrotik.adduser');
    Route::get('/admin/mikrotik/deleteuser/{username}', [MikroTikController::class, 'deleteUserFromMikrotik'])->name('admin.mikrotik.deleteuser');
    Route::get('/admin/mikrotik/userstats/{deviceId}', [MikroTikController::class, 'showUserStats'])->name('admin.mikrotik.userstats');

    // OLT Device Routes
//    Route::get('/admin/olt/devices/{deviceId}', [OltDeviceController::class, 'showOltStats'])->name('admin.olt.device.stats');

    Route::get('/admin/olt/devices', [OltDeviceController::class, 'showDevices'])->name('admin.olt.devices');
    Route::get('/admin/olt/device/add', [OltDeviceController::class, 'addDeviceForm'])->name('admin.olt.device.add');
    Route::post('/admin/olt/device/add', [OltDeviceController::class, 'addDevice'])->name('admin.olt.device.store');
    Route::get('/admin/olt/devices/{deviceId}', [OltDeviceController::class, 'showOltStats'])->name('admin.olt.device.stats');
    Route::get('/admin/olt/devices/{deviceId}/edit', [OltDeviceController::class, 'editDevice'])->name('admin.olt.device.edit');
    Route::put('/admin/olt/devices/{deviceId}', [OltDeviceController::class, 'updateDevice'])->name('admin.olt.device.update');
    Route::get('/admin/olt/devices/{deviceId}/delete', [OltDeviceController::class, 'deleteDevice'])->name('admin.olt.device.delete');
});
