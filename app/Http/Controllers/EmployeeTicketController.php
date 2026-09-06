<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmployeeTicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with([
            'category',
            'technician',
        ])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view(
            'employee.tickets.index',
            compact('tickets')
        );
    }

    public function create()
    {
        $categories = TicketCategory::where(
            'is_active',
            true
        )
            ->orderBy('name')
            ->get();

        return view(
            'employee.tickets.create',
            compact('categories')
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'ticket_category_id' => [
                'required',
                'exists:ticket_categories,id',
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'required',
                'string',
            ],

            'priority' => [
                'required',
                'in:low,medium,high',
            ],
        ]);

        $validated['ticket_number'] =
            'TKT-' .
            now()->format('Ymd') .
            '-' .
            Str::upper(Str::random(6));

        $validated['user_id'] = auth()->id();
        $validated['technician_id'] = null;
        $validated['status'] = 'open';

        Ticket::create($validated);

        return redirect()
            ->route('employee.tickets.index')
            ->with(
                'success',
                'Tiket bantuan berhasil dikirim.'
                       );
    }
}