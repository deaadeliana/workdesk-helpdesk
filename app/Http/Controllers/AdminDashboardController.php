<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalTickets = Ticket::count();

        $openTickets = Ticket::where('status', 'open')
            ->count();

        $inProgressTickets = Ticket::where(
            'status',
            'in_progress'
        )->count();

        $completedTickets = Ticket::whereIn(
            'status',
            ['resolved', 'closed']
        )->count();

        return view('admin.dashboard', compact(
            'totalTickets',
            'openTickets',
            'inProgressTickets',
            'completedTickets'
        ));
    }
}