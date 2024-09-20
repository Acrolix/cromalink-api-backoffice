<?php

namespace App\Listeners;

use App\Models\User;
use Laravel\Passport\Events\AccessTokenCreated;

class APILogin
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(AccessTokenCreated $event)
    {
        if (!empty($event->userId)) {

            $user = User::find($event->userId);
            $user->saveLogin();
        }
    }
}
