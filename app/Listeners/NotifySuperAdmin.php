<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminNotificationMail;
use App\Models\User;

class NotifySuperAdmin implements ShouldQueue
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
    public function handle(UserRegistered $event): void
    {
        // Get all super admin users
        $superAdmins = User::where('role', 'super_admin')->orWhere('role', 'superadmin')->get();

        foreach ($superAdmins as $admin) {
            Mail::to($admin->email)->send(new AdminNotificationMail($event->user));
        }
    }
}