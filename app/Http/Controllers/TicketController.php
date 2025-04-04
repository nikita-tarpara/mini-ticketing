<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index()
    {
        return response()->json(Ticket::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'status' => 'in:open,in_progress,closed'
        ]);

        $ticket = Ticket::create($request->all());

        return response()->json($ticket, 201);
    }

    public function show(Ticket $ticket)
    {
        return response()->json($ticket);
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes',
            'status' => 'in:open,in_progress,closed'
        ]);

        $ticket->update($request->all());

        return response()->json($ticket);
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return response()->json(null, 204);
    }
}
