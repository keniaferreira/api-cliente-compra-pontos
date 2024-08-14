<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * O caminho para o controlador principal da aplicação.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Registre os serviços de roteamento para a aplicação.
     *
     * @return void
     */
    public function boot()
    {
    	Route::prefix('api')
    	->middleware('api')
        ->namespace('App\Http\Controllers') // <---------
        ->group(base_path('routes/api.php'));
    }
}
