<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;
use App\Events\TicketCreated;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::query();

        if ($request->ref) {
            $query->where('ref', $request->ref);
        }

        return response()->json([
            'data' => $query->latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|max:200',
            'email' => 'required|email',
            'description' => 'required',
        ]);

        $data = $request->only([
            'customer_name',
            'email',
            'phone',
            'description',
        ]);

        $data['ref'] = sha1(time());
        $data['status'] = 0;

        $ticket = Ticket::create($data);

        if ($ticket) {
            // dispatch event
            TicketCreated::dispatch($ticket);

            return response()->json([
                'data' => $ticket,
                'message' => 'Ticket created successfully'
            ], 201);
        }

        return response()->json([
            'data' => null,
            'message' => 'Failed to create ticket'
        ], 500);
    }
}