<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PontosGanhos extends Mailable
{
    use Queueable, SerializesModels;

    public $pontosGanhos;

    /**
     * Create a new message instance.
     *
     * @param int $pontosGanhos
     * @return void
     */
    public function __construct($pontosGanhos)
    {
        $this->pontosGanhos = $pontosGanhos;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Você ganhou pontos!')
        ->view('emails.pontos_ganhos')
        ->with([
            'pontosGanhos' => $this->pontosGanhos,
        ]);
    }
}