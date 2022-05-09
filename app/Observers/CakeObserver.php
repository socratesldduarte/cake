<?php

namespace App\Observers;

use App\Mail\OrderedCakeMail;
use App\Models\Cake;
use Illuminate\Support\Facades\Mail;

class CakeObserver
{
    /**
     * Handle the Cake "created" event.
     *
     * @param  \App\Models\Cake  $cake
     * @return void
     */
    public function created(Cake $cake)
    {
        $available = $cake->available;
        foreach($cake->orders as $order) {
            //CHECK IF IS E-MAIL STATUS IS NEW
            $isNew = false;
            if(isset($order["situation"]) && $order["situation"] == 'new' && $available >= 1) {
                $available--;
                $order["situation"] = 'notified';
                //SEND EMAIL TO REGISTERED CAKE
                Mail::to($order["email"])
                    ->queue(New OrderedCakeMail($cake, $order["email"]));
            }
            $newOrders[] = $order;
        }
        //UPDATE CAKE WITHOUT OBSERVER
        $cake->available = $available;
        $cake->orders = $newOrders;

        $cake->saveQuietly();
    }

    /**
     * Handle the Cake "updated" event.
     *
     * @param  \App\Models\Cake  $cake
     * @return void
     */
    public function updated(Cake $cake)
    {
        $available = $cake->available;
        foreach($cake->orders as $order) {
            //CHECK IF IS E-MAIL STATUS IS NEW
            $isNew = false;
            if(isset($order["situation"]) && $order["situation"] == 'new' && $available >= 1) {
                $available--;
                $order["situation"] = 'notified';
                //SEND EMAIL TO REGISTERED CAKE
                Mail::to($order["email"])
                    ->queue(New OrderedCakeMail($cake, $order["email"]));
            }
            $newOrders[] = $order;
        }
        //UPDATE CAKE WITHOUT OBSERVER
        $cake->available = $available;
        $cake->orders = $newOrders;

        $cake->saveQuietly();
    }

    /**
     * Handle the Cake "deleted" event.
     *
     * @param  \App\Models\Cake  $cake
     * @return void
     */
    public function deleted(Cake $cake)
    {
        //
    }

    /**
     * Handle the Cake "restored" event.
     *
     * @param  \App\Models\Cake  $cake
     * @return void
     */
    public function restored(Cake $cake)
    {
        //
    }

    /**
     * Handle the Cake "force deleted" event.
     *
     * @param  \App\Models\Cake  $cake
     * @return void
     */
    public function forceDeleted(Cake $cake)
    {
        //
    }
}
