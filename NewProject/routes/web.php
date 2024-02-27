<?php

use App\Http\Controllers\ForecastController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeatherController;
use App\Http\Middleware\AdminCheckMiddleware;
use App\Models\Weather;
use Illuminate\Support\Facades\Route;

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

/*
Nova ruta za /home koja ce ispisati "Hello World"
*/

Route::get('/home', function () {
    return "Hello World";
});

Route::view("/about","about");

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', AdminCheckMiddleware::class])->prefix('admin')->group(function () {

    Route::get('/allWeather', [WeatherController::class, 'getAllWeather'])
    ->name('admin.allWeather');

    //----------------------------------------------------------------------

    Route::view("/add-weather","admin/addWeather")->name('admin.addWeather');

    Route::post("/create-new-weather", [WeatherController::class, 'createNewWeather'])
    ->name("NewWeather");

    //----------------------------------------------------------------------
    Route::get('weather/edit/{weather}', [WeatherController::class, 'editWeather'])
    ->name('editWeather');

    Route::put('/weather/{weather}', [WeatherController::class, 'updateWeather'])
    ->name('updateWeather');

    //----------------------------------------------------------------------

    Route::get("/delete-weather/{weather}", [WeatherController::class, 'deleteWeather'])->name("deleteWeather");


});

Route::get('/forecast/{city}', [ForecastController::class, 'index']);



Route::middleware('auth')->group(function () {
    Route::get('/weather', [WeatherController::class, 'showAllWeather'])->name('weather');

    //----------------------------------------------------------------------
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
