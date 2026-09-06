<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TechnicianTicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with([
            'user',
            'category',
        ])
            ->where('technician_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view(
            'technician.tickets.index',
            compact('tickets')
        );
    }

    public function edit(Ticket $ticket)
    {
        if ($ticket->technician_id !== auth()->id()) {
            abort(
                403,
                'Tiket ini tidak ditugaskan kepada Anda.'
            );
        }

        return view(
            'technician.tickets.edit',
            compact('ticket')
        );
    }

    public function update(Request $request, Ticket $ticket)
    {
        if ($ticket->technician_id !== auth()->id()) {
            abort(
                403,
                'Tiket ini tidak ditugaskan kepada Anda.'
            );
        }

        $validated = $request->validate([
            'status' => [
                'required',
                'in:open,in_progress,resolved',
            ],
        ]);

        $ticket->update($validated);

        return redirect()
            ->route('technician.tickets.index')
            ->with('success', 'Status tiket berhasil diperbarui.');
    }
}