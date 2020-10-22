<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionReservaEliminada extends Mailable
{
    use Queueable, SerializesModels;
    public $subject = "Eliminacion Reserva";

    public $dato;
    public $usuario;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($dato,$usuario)
    {
        $this->dato = $dato;
        $this->usuario = $usuario;
        //dd($this->datos);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        
        return $this->view('emails.eliminacion_reserva');
    }
}
