<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegisteredEmail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user; //with public att, will be available in the view

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Conta criada com sucesso')
            ->replyTo('contato@laratenancy.com')
            ->view('emails.user-registered');
    }
}
