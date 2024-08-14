<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckTokenPermissions;
use Illuminate\Http\Request;

// Token: 4b5f8f32c96a9aa152e0c6615d4e632f
Route::middleware([CheckTokenPermissions::class.':001,002,003,004,005,006'])->group(function () {
    Route::post('/clientes', 'App\Http\Controllers\ClienteController@store');
    Route::get('/clientes/{id}', 'App\Http\Controllers\ClienteController@show');
    Route::get('/clientes', 'App\Http\Controllers\ClienteController@index');
    Route::get('/clientes/{id}/saldo', 'App\Http\Controllers\ClientePontosController@saldo');
    Route::post('/clientes/{id}/resgatar', 'App\Http\Controllers\ClientePontosController@resgatar');
    Route::post('/clientes/{id}/pontuar', 'App\Http\Controllers\ClientePontosController@pontuar');
});

// Token: 117ae721e424e7f819893edb2c0c5fd6
Route::middleware([CheckTokenPermissions::class.':002,003,004'])->group(function () {
    Route::get('/clientes/{id}', 'App\Http\Controllers\ClienteController@show');
    Route::get('/clientes', 'App\Http\Controllers\ClienteController@index');
    Route::get('/clientes/{id}/saldo', 'App\Http\Controllers\ClientePontosController@saldo');
});

// Token: 3b7d6e2cb06ba79a9c9744f8e256a39e
Route::middleware([CheckTokenPermissions::class.':005,006'])->group(function () {
    Route::post('/clientes/{id}/resgatar', 'App\Http\Controllers\ClientePontosController@resgatar');
    Route::post('/clientes/{id}/pontuar', 'App\Http\Controllers\ClientePontosController@pontuar');
});
