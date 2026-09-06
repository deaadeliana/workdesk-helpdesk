@extends('layouts.technician')

@section('title', 'Tangani Tiket')

@section('styles')
<style>
    .ticket-card {
        max-width: 850px;
        padding: 30px;
        background: white;
        border-radius: 16px;
    }

    .ticket-information {
        display: grid;
        grid-template-columns: 180px 1fr;
        gap: 14px;
        padding-bottom: 24px;
        margin-bottom: 24px;
        border-bottom: 1px solid #e5e7eb;
    }

    .information-label {
        color: #64748b;
        font-weight: bold;
    }

    .description-box {
        padding: 16px;
        margin: 10px 0 24px;
        line-height: 1.6;
        white-space: pre-wrap;
        background: #f8fafc;
        border-radius: 10px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
    }

    .form-control {
        box-sizing: border-box;
        width: 100%;
        padding: 12px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
    }

    .error-message {
        margin-top: 6px;
        color: #dc2626;
        font-size: 14px;
    }

    .button-group {
        display: flex;
        gap: 10px;
    }

    .save-button,
    .cancel-button {
        padding: 12px 20px;
        border: none;
        border-radius: 8px;
        text-decoration: none;
        cursor: pointer;
    }

    .save-button {
        color: white;
        background: #2563eb;
    }

    .cancel-button {
        color: #1e293b;
        background: #e2e8f0;
    }
</style>
@endsection

@section('content')
<h1>Tangani Tiket</h1>
<p>Lihat laporan dan perbarui status pengerjaan tiket.</p>

<div class="ticket-card">
    <div class="ticket-information">
        <div class="information-label">Nomor Tiket</div>
        <div>{{ $ticket->ticket_number }}</div>

        <div class="information-label">Pelapor</div>
        <div>{{ $ticket->user->name }}</div>

        <div class="information-label">Kategori</div>
        <div>{{ $ticket->category->name }}</div>

        <div class="information-label">Judul</div>
        <div>{{ $ticket->title }}</div>

        <div class="information-label">Prioritas</div>
        <div>{{ ucfirst($ticket->priority) }}</div>
    </div>

    <strong>Deskripsi Masalah</strong>

    <div class="description-box">{{ $ticket->description }}</div>

    <form
    action="{{ route('technician.tickets.update', $ticket) }}"
    method="POST"
>
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="status">Status Tiket</label>

        <select
            id="status"
            name="status"
            class="form-control"
            required
        >
            <option
                value="open"
                {{ old('status', $ticket->status) === 'open' ? 'selected' : '' }}
            >
                Open
            </option>

            <option
                value="in_progress"
                {{ old('status', $ticket->status) === 'in_progress' ? 'selected' : '' }}
            >
                Sedang Diproses
            </option>

            <option
                value="resolved"
                {{ old('status', $ticket->status) === 'resolved' ? 'selected' : '' }}
            >
                Selesai Ditangani
            </option>
        </select>

        @error('status')
            <div class="error-message">{{ $message }}</div>
        @enderror
    </div>

    <div class="button-group">
        <button type="submit" class="save-button">
            Simpan Perubahan
        </button>

        <a
            href="{{ route('technician.tickets.index') }}"
            class="cancel-button"
        >
            Batal
        </a>
    </div>
    </form>
</div>
@endsection