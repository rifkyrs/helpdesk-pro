<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use App\Models\AuditLog;
use Illuminate\Http\Request;

class LogUserActivity
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle($event)
    {
        $action = '';
        $description = '';

        if ($event instanceof Login) {
            $action = 'login';
            $description = 'User logged in successfully.';
        } elseif ($event instanceof Logout) {
            $action = 'logout';
            $description = 'User logged out.';
        }

        if ($action && $event->user) {
            AuditLog::create([
                'user_id' => $event->user->id,
                'action' => $action,
                'description' => $description,
                'ip_address' => $this->request->ip(),
                'user_agent' => $this->request->userAgent(),
            ]);
        }
    }
}
