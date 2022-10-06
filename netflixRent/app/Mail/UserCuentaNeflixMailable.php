<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserCuentaNeflixMailable extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     private $datosNeflix;

    public function __construct($datos)
    {
       $this->datosNeflix = $datos;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    { 
        
        return $this->view("nuevo", [
                            'email_account' =>  $this->datosNeflix['email_account'],
                            'password_account' => $this->datosNeflix['password_account'],
                            'user_netflix' => $this->datosNeflix['user_netflix'],
                            'pin_user_netflix' => $this->datosNeflix['pin_user_netflix']
                        ]);
    }


}
