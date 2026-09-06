<?php

namespace App\Http\Controllers;

use App\Models\Ticket;

class EmployeeDashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $totalTickets = Ticket::where('user_id', $userId)
            ->count();

        $openTickets = Ticket::where('user_id', $userId)
            ->where('status', 'open')
            ->count();

        $inProgressTickets = Ticket::where('user_id', $userId)
            ->where('status', 'in_progress')
            ->count();

        $completedTickets = Ticket::where('user_id', $userId)
            ->whereIn('status', ['resolved', 'closed'])
            ->count();

        return view('employee.dashboard', compact(
            'totalTickets',
            'openTickets',
            'inProgressTickets',
            'completedTickets'
        ));
    }
}