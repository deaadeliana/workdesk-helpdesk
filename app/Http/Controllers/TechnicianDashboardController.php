<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class TechnicianDashboardController extends Controller
{
    public function index()
    {
        $technicianId = auth()->id();

        $totalTickets = Ticket::where(
            'technician_id',
            $technicianId
        )->count();

        $openTickets = Ticket::where(
            'technician_id',
            $technicianId
        )
            ->where('status', 'open')
            ->count();

        $inProgressTickets = Ticket::where(
            'technician_id',
            $technicianId
        )
            ->where('status', 'in_progress')
            ->count();

        $completedTickets = Ticket::where(
            'technician_id',
            $technicianId
        )
            ->whereIn('status', ['resolved', 'closed'])
            ->count();

        return view('technician.dashboard', compact(
            'totalTickets',
            'openTickets',
            'inProgressTickets',
            'completedTickets'
        ));
    }
}