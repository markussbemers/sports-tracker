<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SportsTypeController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TrainingController;


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

Route::resource('create_team', TeamController::class);
Route::get('create_team', [TeamController::class, 'create'])->middleware(['auth'])->name('create_team');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/teams', function () {
    return view('teams');
})->middleware(['auth'])->name('teams');
/*
Route::get('/create_organization', function () {
    return view('create_organization');
})->middleware(['auth'])->name('create_organization');
*/

Route::resource('create_organization', OrganizationController::class);
Route::get('create_organization', [OrganizationController::class, 'store'])->middleware(['auth'])->name('create_organization');
Route::get('create_organization', [SportsTypeController::class, 'getSportsTypesforOrganization'])->middleware(['auth'])->name('create_organization');


require __DIR__.'/auth.php';
