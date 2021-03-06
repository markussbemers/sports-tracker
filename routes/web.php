<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SportsTypeController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\AppUserController;
use App\Http\Controllers\CoachController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/trainings', [TrainingController::class, 'index'])->middleware(['auth'])->name('trainings');

Route::get('sports-types', [SportsTypeController::class, 'index'])->middleware(['auth'])->name('sports_types');
Route::get('sports-types/{id}', [TeamController::class, 'getTeamsBySportsType'])->middleware(['auth'])->name('sports-types/{id}');

Route::get('/teams', function () {
    return view('teams');
})->middleware(['auth'])->name('teams');

Route::get('coach', [CoachController::class, 'index'])->middleware(['auth'])->name('coach');

Route::get('playing_teams', [TeamController::class, 'showPlayingTeams'])->middleware(['auth'])->name('playing_teams');
Route::get('coaching_teams', [TeamController::class, 'showCoachingTeams'])->middleware(['auth'])->name('coaching_teams');



Route::get('organizations', [OrganizationController::class, 'index'])->middleware(['auth'])->name('organizations');
Route::get('teams/organizations/{id}', [TeamController::class, 'getTeamsByOrganizations'])->middleware(['auth'])->name('teams/organizations/{id}');
Route::post('destroy_team/{id}', [TeamController::class, 'destroyTeam']);


Route::resource('create_organization', OrganizationController::class);
Route::get('create_organization', [OrganizationController::class, 'create'])->middleware(['auth'])->name('create_organization');

Route::resource('create_team', TeamController::class);
Route::get('create_team', [TeamController::class, 'create'])->middleware(['auth'])->name('create_team');

Route::get('edit_team/{id}/{message?}/{message2?}', [TeamController::class, 'edit'])->middleware(['auth'])->name('edit_team');

Route::post('add_player', [TeamController::class, 'addPlayer']);

Route::post('destroy_player/{id}/{team_id?}', [TeamController::class, 'destroyPlayer']);
Route::post('change_coach', [TeamController::class, 'changeCoach']);
Route::post('add_training', [TeamController::class, 'addTraining']);

Route::post('will_attend/{training_id?}', [TeamController::class, 'willAttend']);
Route::post('wont_attend/{training_id?}', [TeamController::class, 'wontAttend']);


Route::post('will_always_attend/{team_id?}', [TeamController::class, 'willAlwaysAttend']);
Route::post('will_never_attend/{team_id?}', [TeamController::class, 'willNeverAttend']);


require __DIR__.'/auth.php';

Route::get('lang/{locale}',LanguageController::class);
