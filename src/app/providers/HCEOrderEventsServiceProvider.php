<?php

namespace interactivesolutions\honeycombecommerceorders\app\providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use interactivesolutions\honeycombecommerceorders\app\events\HCECOrderPaymentAccepted;
use interactivesolutions\honeycombecommerceorders\app\listeners\HCECGenerateInvoiceNumber;

class HCEOrderEventsServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        HCECOrderPaymentAccepted::class => [
            HCECGenerateInvoiceNumber::class,
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
    }
}





