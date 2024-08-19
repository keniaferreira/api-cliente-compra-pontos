<?php

namespace App\Http\Controllers;

use App\Jobs\NotificarClientePontosResgate;
use Illuminate\Http\Request;

use function Psy\debug;

class JobController extends Controller
{
    public function dispatchNotificationJob()
    {
        // Dispara o job para notificar clientes
        NotificarClientePontosResgate::dispatch();

        return 'Job de notificação enviado!';
    }
}