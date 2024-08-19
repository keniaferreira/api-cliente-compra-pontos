<?php

namespace App\Jobs;

use App\Mail\NotificarPontosResgate;
use App\Models\Cliente;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

use function Psy\debug;

class NotificarClientePontosResgate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        $clients = Cliente::where('saldo_pontos', '>=', 5)->get();

        foreach ($clients as $client) {
            Mail::to($client->email)->send(new NotificarPontosResgate($client));
        }
    }
}
