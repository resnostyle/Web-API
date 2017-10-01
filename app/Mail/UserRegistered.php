<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

/**
 * Class UserRegistered
 *
 * @package App\Mail
 */
class UserRegistered extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \App\User
     */
    public $user;

    /**
     * UserRegistered constructor.
     *
     * @param \App\User $user
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
        return $this->markdown('emails.welcome');
    }
}
