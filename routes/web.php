<?php

use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

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

Route::resource('roles', App\Http\Controllers\RoleController::class);
Route::resource('users', App\Http\Controllers\UserController::class);

Route::resource('clinics', App\Http\Controllers\ClinicController::class);
Route::resource('hospitals', App\Http\Controllers\HospitalController::class);
Route::resource('frequencies', App\Http\Controllers\FrequencyController::class);
Route::resource('agencies', App\Http\Controllers\AgencyController::class);
Route::resource('veteranStatuses', App\Http\Controllers\VeteranStatusController::class);
Route::resource('salesPersons', App\Http\Controllers\SalesPersonController::class);
Route::resource('orderStatuses', App\Http\Controllers\OrderStatusController::class);
Route::resource('states', App\Http\Controllers\StateController::class);
Route::resource('quantityFormulas', App\Http\Controllers\QuantityFormulaController::class);
Route::resource('uOMs', App\Http\Controllers\UOMController::class);
Route::resource('armyTypes', App\Http\Controllers\ArmyTypeController::class);
Route::resource('patientRelations', App\Http\Controllers\PatientRelationController::class);
Route::resource('genders', App\Http\Controllers\GenderController::class);
Route::resource('instructions', App\Http\Controllers\InstructionController::class);
Route::resource('priceTypes', App\Http\Controllers\PriceTypeController::class);

Route::resource('armyCards', App\Http\Controllers\ArmyCardController::class);
Route::resource('armyCards.patients', App\Http\Controllers\PatientController::class)->except(['index']);
Route::resource('patients', App\Http\Controllers\PatientController::class)->only(['index']);