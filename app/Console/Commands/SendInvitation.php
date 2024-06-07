<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Invitation;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvitationMail;
use Illuminate\Support\Str;

class SendInvitation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:invitation {email} {--profile=} {--customer_id=}';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an invitation email to a user';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $email = $this->argument('email');
        $profile = $this->option('profile');
        $customer_id = $this->option('customer_id');
        
        // Validate email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Invalid email address');
            return 1;
        }
    
        // Check if email already has an invitation
        if (Invitation::where('email', $email)->exists()) {
            $this->error('An invitation has already been sent to this email address');
            return 1;
        }
    
        $token = Str::random(32);
    
        $invitation = Invitation::create([
            'email' => $email,
            'token' => $token,
            'expires_at' => now()->addDays(7),
            'profile' => $profile,
            'customer_id' => $customer_id,
        ]);
    
        Mail::to($email)->send(new InvitationMail($invitation));
    
        $this->info('Invitation sent successfully to ' . $email);
    
        return 0;
    }
    
}
