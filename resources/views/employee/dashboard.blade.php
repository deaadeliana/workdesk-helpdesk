@extends('layouts.employee')

@section('title', 'Dashboard Pegawai')

@section('styles')
<style>
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 24px;
        margin-top: 30px;
    }

    .stat-card {
        padding: 28px;
        background: white;
        border-radius: 16px;
    }

    .stat-card p {
        margin: 0 0 15px;
        color: #64748b;
    }

    .stat-card h2 {
        margin: 0;
        font-size: 36px;
    }

    .action-card {
        margin-top: 30px;
        padding: 30px;
        background: white;
        border-radius: 16px;
    }

    .create-button {
        display: inline-block;
        margin-top: 10px;
        padding: 12px 20px;
        color: white;
        background: #2563eb;
        border-radius: 9px;
        text-decoration: none;
    }

    @media (max-width: 1000px) {
        .stat-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
@endsection

@section('content')
<h1 class="page-title">Dashboard Pegawai</h1>

<p class="page-description">
    Pantau seluruh tiket bantuan yang Anda laporkan.
</p>

<div class="stat-grid">
    <div class="stat-card">
        <p>Total Tiket</p>
        <h2>{{ $totalTickets }}</h2>
    </div>

    <div class="stat-card">
        <p>Tiket Baru</p>
        <h2>{{ $openTickets }}</h2>
    </div>

    <div class="stat-card">
        <p>Sedang Diproses</p>
        <h2>{{ $inProgressTickets }}</h2>
    </div>

    <div class="stat-card">
        <p>Tiket Selesai</p>
        <h2>{{ $completedTickets }}</h2>
    </div>
</div>

<div class="action-card">
    <h2>Butuh bantuan?</h2>

    <p>
        Buat tiket baru agar masalah Anda dapat ditangani oleh teknisi.
    </p>

    <a
        href="{{ route('employee.tickets.create') }}"
        class="create-button"
    >
        + Buat Tiket
    </a>
</div>
@endsection