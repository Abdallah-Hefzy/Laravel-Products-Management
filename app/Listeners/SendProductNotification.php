<?php

namespace App\Listeners;

use App\Events\ProductChanged;
use App\Models\User;
use App\Notifications\NewProductNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendProductNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductChanged $event): void
    {
        $product = $event->product;
        $action = $event->action;
        $user = $event->user;
        $notification = new NewProductNotification($product,$action,$user);
        $superAdmins = User::superAdmins()->get();
        foreach ($superAdmins as $superAdmin) {
            $superAdmin->notify($notification);
        }
        $product->user->notify($notification);
    }
}
