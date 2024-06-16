<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitationMail;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    /**
     * Send an invitation to a user.
     *
     * @param array $data The data containing the email, profile, customer_id, etc.
     * @return \Illuminate\Http\RedirectResponse The response redirecting back with a success message.
     */
    public function sendInvitation($data)
    {
        $token = Str::random(32);
        $invitation = Invitation::create([
            'email' => $data['email'],
            'token' => $token,
            'profile' => $data['profile'],
            'customer_id' => $data['customer_id'],
            'expires_at' => now()->addDays(7),
        ]);
        Mail::to($data['email'])->send(new InvitationMail($invitation));
        return back()->with('success', 'Convite enviado com sucesso!');
    }
}