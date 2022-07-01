<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SportsTypeController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\AppUserController;

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

require __DIR__.'/auth.php';


Route::get('/teams', function () {
    return view('teams');
})->middleware(['auth'])->name('teams');

Route::resource('create_organization', OrganizationController::class);
Route::resource('organizations', OrganizationController::class);
Route::resource('create_team', TeamController::class);

Route::get('organizations', [OrganizationController::class, 'index'])->middleware(['auth'])->name('organizations');
Route::get('teams/organizations/{id}', [TeamController::class, 'getTeamsByOrganizations'])->middleware(['auth'])->name('teams/organizations/{id}');

Route::get('/trainings', [TrainingController::class, 'index'])->middleware(['auth'])->name('trainings');

Route::get('sports-types', [SportsTypeController::class, 'index'])->middleware(['auth'])->name('sports_types');
Route::get('sports-types/{id}', [TeamController::class, 'getTeamsBySportsType'])->middleware(['auth'])->name('sports-types/{id}');

Route::get('create_organization', [OrganizationController::class, 'create'])->middleware(['auth'])->name('create_organization');

Route::get('create_team', [TeamController::class, 'create'])->middleware(['auth'])->name('create_team');

Route::get('lang/{locale}',LanguageController::class);



