<?php

use App\Http\Controllers\CategoriesControllers;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClubsController;
use App\Http\Controllers\LeaguesController;
use App\Http\Controllers\MatchesController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SportsController;
use App\Http\Controllers\Website\ContactUsController;
use App\Http\Controllers\Website\PageController;
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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/clear-cache', function (){
    \Illuminate\Support\Facades\Artisan::call('cache:clear');
    \Illuminate\Support\Facades\Artisan::call('view:clear');
    \Illuminate\Support\Facades\Artisan::call('route:clear');
    return 'Cache Cleared';
});

Route::get('/', [HomeController::class, 'index'])->name('/');
Route::post('/get-matches', [HomeController::class, 'getMatches']);
Route::get('admin/index', [DashboardController::class, 'index'])->name('dashboard');
Route::get('admin/change-password', [ProfileController::class, 'changePassword'])->name('changePassword');
Route::post('admin/change-password/store', [ProfileController::class, 'changePasswordStore'])->name('changePassword/Store');

//Website Routes
Route::controller(\App\Http\Controllers\Website\NewsController::class)->prefix('/news')->group(function (){
    Route::get('/', 'index')->name('website/news/index');
    Route::get('/{slug}', 'details')->name('website/news/details');
    Route::post('/comments', 'storeComments')->name('website/news/comments');
});

Route::controller(ContactUsController::class)->prefix('/contact-us')->group(function (){
    Route::get('/', 'index')->name('website/contact/index');
});

Route::get('match/{slug}', [PageController::class, 'match'])->name('website/match');

 //Dashboard Routes
Route::controller(SportsController::class)->prefix('admin/sports')->group(function (){
    Route::get('/', 'index')->name('sports/index');
    Route::get('/create', 'create')->name('sports/create');
    Route::post('/store', 'store')->name('sports/store');
    Route::get('/edit/{id}', 'edit')->name('sports/edit');
    Route::post('/update/{id}', 'update')->name('sports/update');
    Route::delete('/destroy/{id}', 'destroy')->name('sports/destroy');
});

//League Routes
Route::controller(LeaguesController::class)->prefix('admin/leagues')->group(function (){
    Route::get('/', 'index')->name('leagues/index');
    Route::get('/create', 'create')->name('leagues/create');
    Route::post('/store', 'store')->name('leagues/store');
    Route::get('/edit/{id}', 'edit')->name('leagues/edit');
    Route::post('/update/{id}', 'update')->name('leagues/update');
    Route::delete('/destroy/{id}', 'destroy')->name('leagues/destroy');
});

//Clubs Routes
Route::controller(ClubsController::class)->prefix('admin/clubs')->group(function (){
    Route::get('/', 'index')->name('clubs/index');
    Route::get('/create', 'create')->name('clubs/create');
    Route::post('/store', 'store')->name('clubs/store');
    Route::get('/edit/{id}', 'edit')->name('clubs/edit');
    Route::post('/update/{id}', 'update')->name('clubs/update');
    Route::delete('/destroy/{id}', 'destroy')->name('clubs/destroy');
});

//Matches Routes
Route::controller(MatchesController::class)->prefix('admin/matches')->group(function (){
    Route::get('/', 'index')->name('matches/index');
    Route::get('/create', 'create')->name('matches/create');
    Route::post('/store', 'store')->name('matches/store');
    Route::get('/edit/{id}', 'edit')->name('matches/edit');
    Route::post('/update/{id}', 'update')->name('matches/update');
    Route::delete('/destroy/{id}', 'destroy')->name('matches/destroy');
    Route::get('/highlight/{id}', 'highlight')->name('matches/highlight');
    Route::post('/get-leagues-clubs', 'getLeaguesAndClubs')->name('matches/getLeaguesAndClubs');
});

//Matches Routes
Route::controller(CategoriesControllers::class)->prefix('admin/categories')->group(function (){
    Route::get('/', 'index')->name('categories/index');
    Route::get('/create', 'create')->name('categories/create');
    Route::post('/store', 'store')->name('categories/store');
    Route::get('/edit/{id}', 'edit')->name('categories/edit');
    Route::post('/update/{id}', 'update')->name('categories/update');
    Route::delete('/destroy/{id}', 'destroy')->name('categories/destroy');
});

//News Routes
Route::controller(NewsController::class)->prefix('dashboard/news')->group(function (){
    Route::get('/', 'index')->name('news/index');
    Route::get('/create', 'create')->name('news/create');
    Route::post('/store', 'store')->name('news/store');
    Route::get('/edit/{id}', 'edit')->name('news/edit');
    Route::post('/update/{id}', 'update')->name('news/update');
    Route::delete('/destroy/{id}', 'destroy')->name('news/destroy');
});

Route::controller(CommentsController::class)->prefix('dashboard/comments')->group(function (){
    Route::get('/', 'index')->name('comments/index');
    Route::get('/approve-toggle/{id}', 'toggleApprove')->name('comments/toggleApprove');
    Route::delete('/destroy/{id}', 'destroy')->name('comments/destroy');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
