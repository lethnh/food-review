<?php

namespace App\Providers;

use App\Events\RegisterEvent;
use App\Events\Reset_Password_Event;
use App\Listeners\SendMail\ForgotPasswordListener;
use App\Listeners\SendMail\RegisterSuccessListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Reset_Password_Event::class => [
            ForgotPasswordListener::class,
        ],
        RegisterEvent::class => [
            RegisterSuccessListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
