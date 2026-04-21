<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Mail;
use App\Mail\TicketCreated;

class TicketController extends Controller
{
    // Store Ticket
    public function store(Request $request)
    {
        $ticket = Ticket::create([
            'customer_name' => $request->customer_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'description' => $request->description,
            'ref' => 'TCK-' . strtoupper(uniqid()),
            'status' => 0
        ]);

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
}