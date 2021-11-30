<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class comprovanteVoto extends Mailable
{
    use Queueable, SerializesModels;


    protected $voto;

    public function __construct($voto)
    {
        $this->voto = $voto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.comprovante')->subject('Eleição - UEMG 2021')
            ->with([
            'voto' => $this->voto
        ]);
    }
}
