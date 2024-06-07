<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Invitation;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class RegisteredUserController extends Controller{
    public function create(Request $request){
        $token = $request->query('token');
        $token = explode('?', $token)[0];
        $invitation = Invitation::where('token', $token)->first();
        if (!$invitation) {
            return redirect('/')->withErrors(['error' => 'Convite inválido ou expirado.']);
        }
        if (!$invitation->expires_at instanceof Carbon) {
            $invitation->expires_at = Carbon::parse($invitation->expires_at);
        }
        if ($invitation->expires_at->isPast()) {
            Log::error('Convite expirado em: ' . $invitation->expires_at);
            return redirect('/')->withErrors(['error' => 'Convite inválido ou expirado.']);
        }
        return view('auth.register', [
            'token' => $token,
            'email' => $invitation->email,
            'profile' => $invitation->profile,
            'customer_id' => $invitation->customer_id,
        ]);
    }
    

    public function store(Request $request){
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('profile_photos', 'public');
        }
        \Log::info($path);
        $messages = [
            'password.confirmed' => 'A senha e a confirmação de senha não coincidem.',
        ];
        $request->validate([
            'token' => 'required|exists:invitations,token',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], $messages);
        $token = $request->token;
        Log::info('Token recebido: ' . $token);
        $invitation = Invitation::where('token', $token)->first();
        if (!$invitation) {
            Log::error('Convite não encontrado ou expirado.');
            return redirect('/')->withErrors(['error' => 'Convite inválido ou expirado.']);
        }
        if (!$invitation->expires_at instanceof Carbon) {
            $invitation->expires_at = Carbon::parse($invitation->expires_at);
        }
        if ($invitation->expires_at->isPast()) {
            Log::error('Convite expirado em: ' . $invitation->expires_at);
            return redirect('/')->withErrors(['error' => 'Convite inválido ou expirado.']);
        }
        $user = User::create([
            'name' => $request->name,
            'email' => $invitation->email,
            'password' => Hash::make($request->password),
            'profile' => $request->profile,
            'customer_id' => $request->customer_id,
            'profile_photo_path' => $path
        ]);
        \Log::info("Usuário criado: $user");
        $invitation->delete();
        event(new Registered($user));
        return redirect(route('dashboard'));
    }
}
