<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    CvthequeController,
    CompetenceController,
    MetierController,
    ProfessionnelController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [CvthequeController::class, 'index'])->name('accueil');

Route::get('/competence/search', [CompetenceController::class, 'index'])->name('competences.search');

Route::resource('competences', CompetenceController::class);

Route::get('/professionnels/search', [ProfessionnelController::class, 'index'])->name('professionnels.search');

Route::get('metier/{slug}/professionels', [ProfessionnelController::class, 'index'])->name('professionnels.metier');

Route::resource('professionnels', ProfessionnelController::class);

//Route pour une supression de métier indirecte (via la suppression d'un professionnel)

Route::get('/metiers/{metier}/delete', [MetierController::class, 'delete'])->name('metiers.delete');
Route::resource('metiers', MetierController::class);

