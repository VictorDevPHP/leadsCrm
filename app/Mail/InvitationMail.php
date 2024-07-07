<?php

namespace App\Mail;

use App\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invitation;

    public function __construct(Invitation $invitation)
    {
        $this->invitation = $invitation;
    }

    public function build()
    {
        return $this->view('emails.invitation')
            ->with([
                'token' => $this->invitation->token,
                'url' => url('/register?token=' . $this->invitation->token.'?customer_id='.$this->invitation->customer_id.'?profile='.$this->invitation->profile),
            ]);
    }
    
}