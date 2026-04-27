<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TicketCreatedNotification;
use App\Events\TicketCreated;
class TicketController extends Controller
{
    // Create Ticket
    public function create()
    {
        return view('tickets.create');
    }

    // Store Ticket (Updated)
    public function store(Request $request)
    {
    $request->validate([
        'customer_name' => 'required|max:200',
        'email' => 'required|email',
        'description' => 'required'
    ]);

    // Create Ticket
    $ticket = new Ticket();
    $ticket->customer_name = $request->customer_name;
    $ticket->email = $request->email;
    $ticket->phone = $request->phone;
    $ticket->description = $request->description;
    $ticket->ref = 'TCK-' . strtoupper(substr(sha1(time()), 0, 10));
    $ticket->status = 0;
    $ticket->save();

    // Send queued notification
    Notification::route('mail', $ticket->email)
        ->notify(new TicketCreatedNotification($ticket));

    return redirect()
        ->route('tickets.show', $ticket->id)
        ->with('success', 'Ticket created successfully. Reference: ' . $ticket->ref);
}

    // Show Ticket
    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);

        return view('tickets.show', compact('ticket'));
    }

    // Search Ticket
    public function search(Request $request)
    {
        $ticket = Ticket::where('ref', $request->ref)->first();

        if ($ticket) {
            return redirect()->route('tickets.show', $ticket->id);
        }

        return redirect()->back()->with('error', 'Ticket not found');
    }

    // Index Page
    public function index(Request $request)
    {
        $ticketsQuery = Ticket::query();

        $q = $request->query('q');
        $sortColumn = $request->query('sort', 'created_at');
        $sortDir = $request->query('sort_dir') == 'asc' ? 'asc' : 'desc';
        $sortableColumns = [
            'customer_name',
            'created_at',
            'updated_at',
            'status',
        ];

        // Searching
        if ($q) {
            $ticketsQuery->where('ref', 'LIKE', "%$q%")
                ->orWhere('customer_name', 'LIKE', "%$q%")
                ->orWhere('phone', 'LIKE', "%$q%")
                ->orWhere('description', 'LIKE', "%$q%");
        }

        // Sorting
        if (in_array($sortColumn, $sortableColumns)) {
            $ticketsQuery->orderBy($sortColumn, $sortDir);
        }

        $tickets = $ticketsQuery->paginate($request->query('per_page', 10));

        return view('tickets.index', [
            'tickets' => $tickets,
        ]);
    }
}