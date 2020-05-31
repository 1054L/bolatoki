<?php

// use App\Http\Controllers\Auth;
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

Route::get('/', 'LeagueController@getActualClassification')->name('home');
Route::get('/home', 'LeagueController@getActualClassification')->name('home');

Route::resource('ligak', 'LeagueController')->parameters(['ligak' => 'league'])->names('leagues');

Route::resource('tiraldiak', 'MatchController')->parameters(['tiraldiak' => 'matche'])->names('matches');

Route::resource('bolatokiak', 'CourtController')->parameters(['bolatokiak' => 'court'])->names('courts');

Route::resource('bolariak', 'PlayerController')->parameters(['bolariak' => 'player'])->names('players');


Auth::routes();
