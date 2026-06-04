<?php

//===controllers//
use App\Http\Controllers\JobOfferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CVController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('job-offers.index');
});

Route::get('/dashboard', function () {
    return redirect()->route('job-offers.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('job-offers', JobOfferController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('job-offers/{jobOffer}/cv', [CVController::class, 'store'])
        ->name('job-offers.cv.store');

    Route::get('job-offers/{jobOffer}/cv', [CVController::class, 'show'])
        ->name('job-offers.cv.show');
});

require __DIR__ . '/auth.php';
