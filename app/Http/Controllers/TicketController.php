<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;

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

        $ticket = new Ticket();

        $ticket->customer_name = $request->customer_name;
        $ticket->email = $request->email;
        $ticket->phone = $request->phone;
        $ticket->description = $request->description;
        $ticket->ref = 'TCK-' . strtoupper(substr(sha1(time()), 0, 10)); // improved ref
        $ticket->status = 0;

        $ticket->save();

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
        $ticket = Ticket::where('ref', $request->reference)->first();

        if ($ticket) {
            return redirect()->route('tickets.show', $ticket->id);
        }

        return redirect()->back()->with('error', 'Ticket not found');
    }
}