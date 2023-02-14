<?php

namespace App\Listeners;

use App\Events\SendMail;
use App\Mail\CourtCreate;
use App\Models\court;
use Illuminate\Support\Facades\Mail;

class SendMailFired
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
     * @param SendMail $event
     * @return void
     */
    public function handle(SendMail $event)
    {
        $body = court::find($event->courtid)->toArray();
        Mail::to('devrahuldholariya@gmail.com', 'Mail From Rahul')->send(new \App\Mail\sendMail($body));
    }
}
