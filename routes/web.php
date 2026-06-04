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


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
        * Rutas para la gestión de CVs asociados a ofertas de trabajo.
        * Solo el propietario de la oferta puede crear, ver, editar o actualizar el CV.
    */
    Route::resource('job-offers', JobOfferController::class);
    Route::post('job-offers/{jobOffer}/cv', [CVController::class, 'store'])
        ->name('job-offers.cv.store');

    Route::get('job-offers/{jobOffer}/cv', [CVController::class, 'show'])
        ->name('job-offers.cv.show');

    Route::get('job-offers/{jobOffer}/cv/edit', [CVController::class, 'edit'])
        ->name('job-offers.cv.edit');

    Route::put('job-offers/{jobOffer}/cv', [CVController::class, 'update'])
        ->name('job-offers.cv.update');
});

require __DIR__ . '/auth.php';
