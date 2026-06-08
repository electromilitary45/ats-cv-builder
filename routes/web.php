<?php

//===controllers//
use App\Http\Controllers\JobOfferController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CVController;
use App\Http\Controllers\CVWorkExperienceController;
use App\Http\Controllers\CVEducationController;
use App\Http\Controllers\CVSkillController;
use App\Http\Controllers\CVCertificationController;
use App\Http\Controllers\CVLanguageController;


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

    Route::get('job-offers/{jobOffer}/cv/download', [CVController::class, 'downloadPdf'])
        ->name('job-offers.cv.download');

    //==work experience routes==//

    Route::post('job-offers/{jobOffer}/cv/work-experiences', [CVWorkExperienceController::class, 'store'])
        ->name('job-offers.cv.work-experiences.store');

    Route::delete('job-offers/{jobOffer}/cv/work-experiences/{workExperience}', [CVWorkExperienceController::class, 'destroy'])
        ->name('job-offers.cv.work-experiences.destroy');

    Route::put('job-offers/{jobOffer}/cv/work-experiences/{workExperience}', [CVWorkExperienceController::class, 'update'])
        ->name('job-offers.cv.work-experiences.update');

    //==education routes==//
    Route::post('job-offers/{jobOffer}/cv/educations', [CVEducationController::class, 'store'])
        ->name('job-offers.cv.educations.store');

    Route::delete('job-offers/{jobOffer}/cv/educations/{education}', [CVEducationController::class, 'destroy'])
        ->name('job-offers.cv.educations.destroy');

    Route::put('job-offers/{jobOffer}/cv/educations/{education}', [CVEducationController::class, 'update'])
        ->name('job-offers.cv.educations.update');

    //==skills routes==//

    Route::post('job-offers/{jobOffer}/cv/skills', [CVSkillController::class, 'store'])
        ->name('job-offers.cv.skills.store');

    Route::delete('job-offers/{jobOffer}/cv/skills/{skill}', [CVSkillController::class, 'destroy'])
        ->name('job-offers.cv.skills.destroy');

    //==certifications routes==//

    Route::post('job-offers/{jobOffer}/cv/certifications', [CVCertificationController::class, 'store'])
        ->name('job-offers.cv.certifications.store');

    Route::delete('job-offers/{jobOffer}/cv/certifications/{certification}', [CVCertificationController::class, 'destroy'])
        ->name('job-offers.cv.certifications.destroy');

    //==languages routes==//
    Route::post('job-offers/{jobOffer}/cv/languages', [CVLanguageController::class, 'store'])
        ->name('job-offers.cv.languages.store');

    Route::delete('job-offers/{jobOffer}/cv/languages/{language}', [CVLanguageController::class, 'destroy'])
        ->name('job-offers.cv.languages.destroy');
});

require __DIR__ . '/auth.php';
