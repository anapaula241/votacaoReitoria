<?php

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

Route::get('/', 'LoginController@login')->name('home');

Route::get('/logout', 'LoginController@logout')->name('logout');

Route::post('/autentica', 'LoginController@autentica')->name('autentica');

Route::get('/voto/confirma', 'VotoController@confirmaVoto')->name('eleitor-confirma');

Route::post('solicitasenha', 'VotoController@solicitaSenha')->name('solicita-senha');

Route::middleware(['auth', 'verificavoto'])->prefix('eleitor')->group(function(){

    Route::get('/unidades', 'UnidadeController@index')->name('eleitor-unidade');
    Route::get('/chapas/{idunidade}', 'VotoController@index')->name('eleitor-chapas');

    Route::post('/voto/chapa/{idchapa}', 'VotoController@saveVote')->name('eleitor-voto');
    Route::post('/voto/branco', 'VotoController@saveVoteBranco')->name('eleitor-branco');
    Route::post('/voto/nulo', 'VotoController@saveVoteNulo')->name('eleitor-nulo');



});

