<?php

namespace App\Observers;

use App\Mail\UserSubscriptionEmail;
use App\Models\WebsiteSubscribers;
use Illuminate\Support\Facades\Mail;

class WebsiteSubscriptionObserver
{
    /**
     * Handle the WebsiteSubscribers "created" event.
     *
     * @param  \App\Models\WebsiteSubscribers  $subscriber
     * @return void
     */
    public function created(WebsiteSubscribers $subscriber)
    {
        //
        Mail::to($subscriber)->queue(new UserSubscriptionEmail($subscriber));
    }

    /**
     * Handle the WebsiteSubscribers "updated" event.
     *
     * @param  \App\Models\WebsiteSubscribers  $subscriber
     * @return void
     */
    public function updated(WebsiteSubscribers $subscriber)
    {
        //
    }

    /**
     * Handle the WebsiteSubscribers "deleted" event.
     *
     * @param  \App\Models\WebsiteSubscribers  $subscriber
     * @return void
     */
    public function deleted(WebsiteSubscribers $subscriber)
    {
        //
    }

    /**
     * Handle the WebsiteSubscribers "restored" event.
     *
     * @param  \App\Models\WebsiteSubscribers  $subscriber
     * @return void
     */
    public function restored(WebsiteSubscribers $subscriber)
    {
        //
    }

    /**
     * Handle the WebsiteSubscribers "force deleted" event.
     *
     * @param  \App\Models\WebsiteSubscribers  $subscriber
     * @return void
     */
    public function forceDeleted(WebsiteSubscribers $subscriber)
    {
        //
    }
}
