<?php

namespace App\Observers;

use App\Mail\UserCreated;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Snowfire\Beautymail\Beautymail;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        $beautymail = app()->make(Beautymail::class);
        $beautymail->send('mail.user.created',  ['user' => $user, 'password' => Session::get('password')], function ($message) use ($user) {
            $message
                ->from(env('MAIL_FROM_ADDRESS'))
                ->to($user->email, $user->name)
                ->subject('Welcome!');
        });
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        //
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
