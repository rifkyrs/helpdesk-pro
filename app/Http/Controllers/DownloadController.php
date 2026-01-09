<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    public function download(Ticket $ticket, Attachment $attachment)
    {
        // Verify relationship
        if ($attachment->ticket_id !== $ticket->id) {
            abort(404);
        }

        // Authorization: Check if user owns the ticket
        if ($ticket->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this file.');
        }

        // Check file existence
        if (!Storage::exists($attachment->file_path)) {
            abort(404, 'File not found on server.');
        }

        return Storage::download($attachment->file_path, $attachment->filename);
    }
}
