@extends('layouts.admin')

@section('title', 'Semua Tiket')

@section('styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 24px;
    }

    .page-header h1 {
        margin: 0 0 8px;
    }

    .page-header p {
        margin: 0;
    }

    .add-button {
        flex-shrink: 0;
        padding: 12px 20px;
        color: white;
        background: #2563eb;
        border-radius: 10px;
        text-decoration: none;
    }

    .table-card {
        overflow-x: auto;
        background: white;
        border-radius: 16px;
    }

    table {
        width: 100%;
        min-width: 1100px;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 16px;
        text-align: left;
        vertical-align: middle;
        border-bottom: 1px solid #e5e7eb;
    }

    th {
        color: #374151;
        white-space: nowrap;
        background: #f8fafc;
    }

    tbody tr:last-child td {
        border-bottom: none;
    }

    .badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 20px;
        font-size: 14px;
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

    .action-group {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .edit-button,
    .delete-button {
        display: inline-block;
        padding: 8px 12px;
        color: white;
        border: none;
        border-radius: 7px;
        text-decoration: none;
        cursor: pointer;
    }

    .edit-button {
        background: #f59e0b;
    }

    .delete-button {
        background: #dc2626;
    }

    @media (max-width: 700px) {
        .page-header {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <div>
        <h1>Semua Tiket</h1>
        <p>Kelola seluruh laporan bantuan pengguna.</p>
    </div>

    <a
        href="{{ route('admin.tickets.create') }}"
        class="add-button"
    >
        + Tambah Tiket
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
                <th>Pelapor</th>
                <th>Kategori</th>
                <th>Teknisi</th>
                <th>Prioritas</th>
                <th>Status</th>
                <th>Tindakan</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->ticket_number }}</td>

                    <td>{{ $ticket->title }}</td>

                    <td>{{ $ticket->user->name }}</td>

                    <td>{{ $ticket->category->name }}</td>

                    <td>
                        {{ $ticket->technician?->name ?? 'Belum ditentukan' }}
                    </td>

                    <td>
                        <span
                            class="badge priority-{{ $ticket->priority }}"
                        >
                            {{ ucfirst($ticket->priority) }}
                        </span>
                    </td>

                    <td>
                        <span
                            class="badge status-{{ $ticket->status }}"
                        >
                            {{ ucwords(str_replace('_', ' ', $ticket->status)) }}
                        </span>
                    </td>

                    <td>
                        <div class="action-group">
                            <a
                                href="{{ route('admin.tickets.edit', $ticket) }}"
                                class="edit-button"
                            >
                                Edit
                            </a>

                            <form
                                action="{{ route('admin.tickets.destroy', $ticket) }}"
                                method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus tiket ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="delete-button"
                                >
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td
                        colspan="8"
                        style="text-align: center;"
                    >
                        Belum ada tiket bantuan.
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