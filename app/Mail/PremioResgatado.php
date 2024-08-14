<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PremioResgatado extends Mailable
{
    use Queueable, SerializesModels;

    public $premio;
    public $pontosNecessarios;

    /**
     * Create a new message instance.
     *
     * @param  string  $premio
     * @param  int  $pontosNecessarios
     * @return void
     */
    public function __construct($premio, $pontosNecessarios)
    {
        $this->premio = $premio;
        $this->pontosNecessarios = $pontosNecessarios;
    }

    /**
     * Build the message.
     *
     * @return \Illuminate\Mail\Mailable
     */
    public function build()
    {
        return $this->subject('Prêmio Resgatado com Sucesso')
        ->view('emails.premio_resgatado')
        ->with([
            'premio' => $this->premio,
            'pontosNecessarios' => $this->pontosNecessarios,
        ]);
    }
}