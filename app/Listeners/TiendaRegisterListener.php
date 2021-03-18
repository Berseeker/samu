<?php

namespace App\Listeners;

use App\Events\TiendaRegisterEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TiendaRegisterListener
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
     * @param  TiendaRegisterEvent  $event
     * @return void
     */
    public function handle(TiendaRegisterEvent $event)
    {
        //
    }
}
