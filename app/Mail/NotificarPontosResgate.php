<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificarPontosResgate extends Mailable
{
    use Queueable, SerializesModels;

    public $cliente;

    public function __construct($cliente)
    {
        $this->cliente = $cliente;
    }

    public function build()
    {
        return $this->view('emails.pontos_disponiveis_resgate')
                    ->with([
                        'nome' => $this->cliente->nome,
                    ]);
    }
}
