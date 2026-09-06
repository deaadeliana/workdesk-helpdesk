@extends('layouts.employee')

@section('title', 'Tiket Saya')

@section('styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 25px;
    }

    .page-header h1 {
        margin-bottom: 8px;
    }

    .page-header p {
        margin: 0;
        color: #64748b;
    }

    .create-button {
        flex-shrink: 0;
        padding: 12px 20px;
        color: white;
        background: #2563eb;
        border-radius: 9px;
        text-decoration: none;
    }

    .table-card {
        overflow-x: auto;
        background: white;
        border-radius: 16px;
    }

    table {
        width: 100%;
        min-width: 950px;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 17px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }

    th {
        color: #374151;
        background: #f8fafc;
    }

    .badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        white-space: nowrap;
    }

    .priority-low {
        color: #166534;
        background: #dcfce7;
    }

    .priority-medium {
        color: #92400e;
        background: #fef3c7;
    }

    .priority-high {
        color: #991b1b;
        background: #fee2e2;
    }

    .status-open {
        color: #1d4ed8;
        background: #dbeafe;
    }

    .status-in_progress {
        color: #92400e;
        background: #fef3c7;
    }

    .status-resolved,
    .status-closed {
        color: #166534;
        background: #dcfce7;
    }

    .success-message {
        padding: 16px;
        margin-bottom: 20px;
        color: #166534;
        background: #dcfce7;
        border-radius: 10px;
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <div>
        <h1 class="page-title">Tiket Saya</h1>

        <p>
            Lihat seluruh laporan bantuan yang Anda buat.
        </p>
    </div>

    <a
        href="{{ route('employee.tickets.create') }}"
        class="create-button"
    >
        + Buat Tiket
    </a>
</div>

@if (session('success'))
    <div class="success-message">
        {{ session('success') }}
    </div>
@endif

<div class="table-card">
    <table>
        <thead>
            <tr>
                <th>No. Tiket</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Teknisi</th>
                <th>Prioritas</th>
                <th>Status</th>
                <th>Dibuat</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->ticket_number }}</td>

                    <td>{{ $ticket->title }}</td>

                    <td>{{ $ticket->category->name }}</td>

                    <td>
                        {{ $ticket->technician?->name ?? 'Belum ditentukan' }}
                    </td>

                    <td>
                        <span class="badge priority-{{ $ticket->priority }}">
                            {{ ucfirst($ticket->priority) }}
                        </span>
                    </td>

                    <td>
                        <span class="badge status-{{ $ticket->status }}">
                            {{ ucwords(str_replace('_', ' ', $ticket->status)) }}
                        </span>
                    </td>

                    <td>
                        {{ $ticket->created_at->format('d-m-Y H:i') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center;">
                        Anda belum membuat tiket.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 20px;">
    {{ $tickets->links() }}
</div>
@endsection