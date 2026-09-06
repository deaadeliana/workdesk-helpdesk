<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $tickets = Ticket::with([
        'user',
        'category',
        'technician',
    ])
        ->latest()
        ->paginate(10);

    return view('admin.tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $employees = User::where('role', 'employee')
        ->orderBy('name')
        ->get();

    $technicians = User::where('role', 'technician')
        ->orderBy('name')
        ->get();

    $categories = TicketCategory::where('is_active', true)
        ->orderBy('name')
        ->get();

    return view('admin.tickets.create', compact(
        'employees',
        'technicians',
        'categories'
    ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'user_id' => [
            'required',
            Rule::exists('users', 'id')
                ->where('role', 'employee'),
        ],

        'ticket_category_id' => [
            'required',
            'exists:ticket_categories,id',
        ],

        'technician_id' => [
            'nullable',
            Rule::exists('users', 'id')
                ->where('role', 'technician'),
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
        'TKT-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6));

    $validated['status'] = 'open';

    Ticket::create($validated);

    return redirect()
        ->route('admin.tickets.index')
        ->with('success', 'Tiket berhasil ditambahkan.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
         $employees = User::where('role', 'employee')
        ->orderBy('name')
        ->get();

    $technicians = User::where('role', 'technician')
        ->orderBy('name')
        ->get();

    $categories = TicketCategory::orderBy('name')->get();

    return view('admin.tickets.edit', compact(
        'ticket',
        'employees',
        'technicians',
        'categories'
    ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
         $validated = $request->validate([
        'user_id' => [
            'required',
            Rule::exists('users', 'id')
                ->where('role', 'employee'),
        ],

        'ticket_category_id' => [
            'required',
            'exists:ticket_categories,id',
        ],

        'technician_id' => [
            'nullable',
            Rule::exists('users', 'id')
                ->where('role', 'technician'),
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

        'status' => [
            'required',
            'in:open,in_progress,resolved,closed',
        ],
    ]);

    $ticket->update($validated);

    return redirect()
        ->route('admin.tickets.index')
        ->with('success', 'Tiket berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

    return redirect()
        ->route('admin.tickets.index')
        ->with('success', 'Tiket berhasil dihapus.');
    }
}
