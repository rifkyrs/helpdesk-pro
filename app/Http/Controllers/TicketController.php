<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $tickets = Ticket::with('user')->orderBy('created_at', 'desc');
        
        // Authorization: Users see only their own tickets
        $tickets = $tickets->where('user_id', Auth::id());

        // Search Logic
        if ($request->has('search')) {
            $search = $request->input('search');
            $tickets->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            });
        }

        return view('tickets.index', ['tickets' => $tickets->paginate(10)]);
    }

    public function create()
    {
        return view('tickets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx,txt|max:10240', // 10MB max, restricted types
        ]);

        $ticket = Ticket::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'open',
        ]);

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file->getClientOriginalName()); // Sanitize filename
            
            // Store securely in storage/app/private (not public)
            $path = $file->storeAs('attachments/' . $ticket->id, $filename);

            Attachment::create([
                'ticket_id' => $ticket->id,
                'filename' => $filename, // Original name sanitized
                'file_path' => $path,
                'mime_type' => $file->getMimeType(),
                'size' => $file->getSize(),
            ]);
        }



        \App\Models\AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'create_ticket',
            'description' => "Created ticket: {$ticket->title} (ID: {$ticket->id})",
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
        ]);

        return redirect()->route('tickets.index')->with('success', 'Ticket created successfully.');
    }

    public function show(Ticket $ticket)
    {
        // Authorization: User must own the ticket
        if ($ticket->user_id !== Auth::id()) {
            abort(403);
        }
        
        $ticket->load('attachments');
        return view('tickets.show', compact('ticket'));
    }
}
