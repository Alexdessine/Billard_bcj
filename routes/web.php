<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ComiteController;
use App\Http\Controllers\SnookerController;
use App\Http\Controllers\AdhesionController;
use App\Http\Controllers\GallerieController;
use App\Http\Controllers\BlackballController;
use App\Http\Controllers\CaramboleController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\User\Usercontroller;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\PresentationController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Compte\CompteController;
use App\Http\Controllers\Forget\ForgetController;
use App\Http\Controllers\Tournois\TournoisController;
use App\Http\Controllers\Licencies\LicenciesController;
use App\Http\Controllers\Evenements\EvenementsController;
use App\Http\Controllers\National\NationalCalendrierController;
use App\Http\Controllers\Regional\RegionalCalendrierController;
use App\Http\Controllers\Comite\ComiteAdminController;
use App\Http\Controllers\Gallerie\AdminGallerieController;
use App\Http\Controllers\Participants\ParticipantsController;
use App\Http\Controllers\Photos\PhotosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::middleware(['guest', 'block.mobile'])->group(function(){
    Route::get('/inscription', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/inscription', [RegisterController::class, 'store'])->name('register');

    Route::get('/connexion', [SessionController::class, 'index'])->name('login');
    Route::post('/connexion', [SessionController::class, 'login'])->name('login');

    Route::get('/forget', [ForgetController::class, 'index'])->name('forget');
    Route::post('/forget', [ForgetController::class, 'store'])->name('forget');
});

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/presentation', [PresentationController::class, 'index'])->name('presentation');
Route::get('/comite', [ComiteController::class, 'index'])->name('comite');
Route::get('/adhesion', [AdhesionController::class, 'index'])->name('adhesion');
Route::get('/blackball', [BlackballController::class, 'index'])->name('blackball');
Route::get('/carambole', [CaramboleController::class, 'index'])->name('carambole');
Route::get('/snooker', [SnookerController::class, 'index'])->name('snooker');
Route::get('/formation', [FormationController::class, 'index'])->name('formation');
Route::get('/gallerie', [GallerieController::class, 'index'])->name('gallerie');


route::middleware(['auth', 'block.mobile'])->group(function(){
    Route::post('/logout', [SessionController::class, 'destroy'])->name('logout');

    Route::get('/compte', [CompteController::class, 'index'])->name('compte');
    Route::post('/password', [CompteController::class, 'edit'])->name('password');

    Route::get('/utilisateurs', [Usercontroller::class, 'index'])->name('utilisateurs')->middleware('role:1');
    Route::get('/utilisateurs/create', [Usercontroller::class, 'create'])->name('utilisateurs.create')->middleware('role:1');
    Route::get('/utilisateurs/{id}', [Usercontroller::class, 'show'])->name('utilisateurs.show')->middleware('role:1');
    Route::post('/utilisateurs/{id}', [Usercontroller::class, 'update'])->name('utilisateurs.update')->middleware('role:1');
    Route::delete('/utilisateurs/{id}', [UserController::class, 'destroy'])->name('utilisateurs.destroy')->middleware('role:1');
    Route::post('/utilisateurs', [UserController::class, 'store'])->name('utilisateurs.store')->middleware('role:1');

    Route::get('/licencies', [LicenciesController::class, 'index'])->name('licencies')->middleware('role:1');
    Route::get('/licencies/update', [LicenciesController::class, 'update'])->name('licencies.update')->middleware('role:1');

    Route::get('/participants', [ParticipantsController::class, 'index'])->name('participants')->middleware('role:1');
    Route::get('/participants/show', [ParticipantsController::class, 'show'])->name('participants.show')->middleware('role:1');
    Route::post('/participants/update', [ParticipantsController::class, 'updateLinks'])->name('participants.updateLinks')->middleware('role:1');
    Route::get('/participants/download', [ParticipantsController::class, 'download'])->name('participants.download')->middleware('role:1');
    Route::get('/participants/generate', [ParticipantsController::class, 'generate'])->name('participants.generate')->middleware('role:1');

    Route::get('/tournois', [TournoisController::class, 'index'])->name('tournois')->middleware('role:1');
    Route::get('/tournois/update', [TournoisController::class, 'update'])->name('tournois.update')->middleware('role:1');
    Route::get('/tournois/show', [TournoisController::class, 'show'])->name('tournois.show')->middleware('role:1');
    Route::post('/tournois', [TournoisController::class, 'edit'])->name('tournois.edit')->middleware('role:1');
    Route::post('/tournois/updateLiens', [TournoisController::class, 'updateLiens'])->name('tournois.updateLiens')->middleware('role:1');

    Route::get('/national', [NationalCalendrierController::class, 'index'])->name('national');
    Route::get('/national/create', [NationalCalendrierController::class, 'create'])->name('national.create')->middleware('role:1,2');
    Route::get('/national/{id}', [NationalCalendriercontroller::class, 'show'])->name('national.show')->middleware('role:1,2');
    Route::get('/national/{id}/edit', [NationalCalendriercontroller::class, 'edit'])->name('national.edit')->middleware('role:1,2');
    Route::put('/national/{id}', [NationalCalendriercontroller::class, 'update'])->name('national.update')->middleware('role:1,2');
    Route::delete('/national/{id}', [NationalCalendriercontroller::class, 'destroy'])->name('national.destroy')->middleware('role:1,2');
    Route::post('/national', [NationalCalendrierController::class, 'store'])->name('national.store')->middleware('role:1,2');

    Route::get('/regional', [RegionalCalendrierController::class, 'index'])->name('regional');
    Route::get('/regional/create', [RegionalCalendrierController::class, 'create'])->name('regional.create')->middleware('role:1,2');
    Route::get('/regional/{id}', [RegionalCalendriercontroller::class, 'show'])->name('regional.show')->middleware('role:1,2');
    Route::get('/regional/{id}/edit', [RegionalCalendriercontroller::class, 'edit'])->name('regional.edit')->middleware('role:1,2');
    Route::put('/regional/{id}', [RegionalCalendriercontroller::class, 'update'])->name('regional.update')->middleware('role:1,2');
    Route::delete('/regional/{id}', [RegionalCalendriercontroller::class, 'destroy'])->name('regional.destroy')->middleware('role:1,2');
    Route::post('/regional', [RegionalCalendrierController::class, 'store'])->name('regional.store')->middleware('role:1,2');

    Route::get('/comites', [ComiteAdminController::class, 'index'])->name('comites');
    Route::get('/comites/create', [ComiteAdminController::class, 'create'])->name('comites.create')->middleware('role:1,2');
    Route::get('/comites/{id}', [ComiteAdminController::class, 'show'])->name('comites.show')->middleware('role:1,2');
    Route::get('/comites/{id}/edit', [ComiteAdminController::class, 'edit'])->name('comites.edit')->middleware('role:1,2');
    Route::put('/comites/{id}', [ComiteAdminController::class, 'update'])->name('comites.update')->middleware('role:1,2');
    Route::delete('/comites/{id}', [ComiteAdminController::class, 'destroy'])->name('comites.destroy')->middleware('role:1,2');
    Route::post('/comites', [ComiteAdminController::class, 'store'])->name('comites.store')->middleware('role:1,2');

    Route::get('/evenements', [EvenementsController::class, 'index'])->name('evenements');
    Route::get('/evenements/create', [EvenementsController::class, 'create'])->name('evenements.create')->middleware('role:1,2');
    Route::get('/evenements/{id}', [EvenementsController::class, 'show'])->name('evenements.show')->middleware('role:1,2');
    Route::post('/evenements', [EvenementsController::class, 'store'])->name('evenements.store')->middleware('role:1,2');
    Route::delete('/evenements/{id}', [EvenementsController::class, 'destroy'])->name('evenements.destroy')->middleware('role:1,2');

    Route::get('/photos', [PhotosController::class, 'index'])->name('photos');
    Route::get('/photos/create', [PhotosController::class, 'create'])->name('photos.create')->middleware('role:1,2');
    Route::get('/photos/{id}', [PhotosController::class, 'show'])->name('photos.show')->middleware('role:1,2');
    Route::post('/photos', [PhotosController::class, 'store'])->name('photos.store')->middleware('role:1,2');
    Route::delete('/photos/{id}', [PhotosController::class, 'destroy'])->name('photos.destroy')->middleware('role:1,2');

});

Route::get('/test-block', function() {
    return 'Accessible';
})->middleware('block.mobile');