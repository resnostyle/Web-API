<?php

namespace App\Mail;

use App\Invite;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Class InviteSent
 *
 * @package App\Mail
 */
class InviteSent extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \App\Invite
     */
    public $invite;

    /**
     * InviteSent constructor.
     *
     * @param \App\Invite $invite
     */
    public function __construct(Invite $invite)
    {
        $this->invite = $invite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.invite_sent');
    }
}
