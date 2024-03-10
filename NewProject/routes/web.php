<?php

use App\Http\Controllers\Admin\AdminForecastController;
use App\Http\Controllers\Admin\AdminWeatherController;
use App\Http\Controllers\ForecastController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WeatherController;
use App\Http\Middleware\AdminCheckMiddleware;
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

Route::view('/', 'welcome')->name('welcome');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware(['auth', AdminCheckMiddleware::class])->prefix('admin')->group(function () {

    Route::get('/allWeather', [AdminWeatherController::class, 'getAllWeather'])
    ->name('admin.allWeather');

    //----------------------------------------------------------------------

    Route::view("/add-weather","admin/addWeather")->name('admin.addWeather');

    Route::post("/create-new-weather", [AdminWeatherController::class, 'createNewWeather'])
    ->name("NewWeather");

    //----------------------------------------------------------------------
    Route::get('weather/edit/{weather}', [AdminWeatherController::class, 'editWeather'])
    ->name('editWeather');

    Route::post('/weather/update', [AdminWeatherController::class, 'updateWeather'])
    ->name('weather.update');

    Route::get("/delete-weather/{weather}", [AdminWeatherController::class, 'deleteWeather'])->name("deleteWeather");


    //----------------------------------------------------------------------

    Route::view("/forecasts", "admin.allForecast")->name("admin.allForecast");

    Route::post('/forecast/add', [AdminForecastController::class, 'addForecast'])
    ->name('forecast.add');

});




Route::middleware('auth')->group(function () {

    Route::get('/forecast', [ForecastController::class, 'showAllForecast'])->name('forecast');

    Route::get('/forecast/search', [ForecastController::class, 'search'])->name('forecast.search');

    Route::get('/forecast/{city:name}', [ForecastController::class, 'showCityForecast'])
    ->name('cityForecast');

    //----------------------------------------------------------------------

    Route::get('/weather', [WeatherController::class, 'showAllWeather'])->name('weather');

    Route::get('/weather/{city:name}', [WeatherController::class, 'showCityWeatherToday'])
    ->name('cityWeather');


    //----------------------------------------------------------------------
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
