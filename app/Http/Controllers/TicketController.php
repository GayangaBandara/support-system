<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Mail;
use App\Mail\TicketCreated;

class TicketController extends Controller
{
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

    // Send Email AFTER saving
    Mail::to($ticket->email)->queue(new TicketCreated($ticket));

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
        $tickets = Ticket::paginate($request->query('per_page', 10));

        return view('tickets.index', [
            'tickets' => $tickets,
        ]);
    }
}