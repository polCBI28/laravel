<?php

use App\Http\Controllers\Admin\ProductoController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use Pest\Plugins\Only;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});
Route::prefix('admin')->group(function (){
    Route::resource('producto', ProductoController::class)
        ->only(['index', 'store', 'update', 'destroy'])
        ->names('admin.producto');

});

require __DIR__.'/auth.php';
