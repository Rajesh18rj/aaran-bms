<?php

namespace Aaran\Auth\Identity\Listeners;

use Aaran\Auth\Identity\Events\UserCreated;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeUserMail;

class SendUserWelcomeEmail
{
    public function handle(UserCreated $event)
    {
        Mail::to($event->user->email)->send(new WelcomeUserMail($event->user));
    }
}
