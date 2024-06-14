<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitationMail;
use Illuminate\Support\Str;

class InvitationController extends Controller
{
    public function sendInvitation(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:invitations,email',
        ]);

        $token = Str::random(32);

        $invitation = Invitation::create([
            'email' => $request->email,
            'token' => $token,
            'expires_at' => now()->addDays(7),
        ]);

        Mail::to($request->email)->send(new InvitationMail($invitation));

        return back()->with('success', 'Convite enviado com sucesso!');
    }
}