@extends('layouts.admin')

@section('title', 'Dashboard')

@section('page-title', 'Dashboard Admin')

@section('content')
    <section class="cards">
        <div class="card">
            <p>Total Tiket</p>
            <h2>{{ $totalTickets }}</h2>
        </div>

        <div class="card">
            <p>Tiket Baru</p>
            <h2>{{ $openTickets }}</h2>
        </div>

        <div class="card">
            <p>Sedang Diproses</p>
            <h2>{{ $inProgressTickets }}</h2>
        </div>

        <div class="card">
            <p>Tiket Selesai</p>
            <h2>{{ $completedTickets }}</h2>
        </div>
    </section>

    <section class="content-box">
        <h2>Selamat datang di WorkDesk</h2>

        <p>
            Melalui halaman ini, Admin dapat mengelola kategori,
            pengguna, teknisi, dan tiket bantuan.
        </p>
    </section>
@endsection