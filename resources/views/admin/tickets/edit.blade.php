@extends('layouts.admin')

@section('title', 'Edit Tiket')

@section('styles')
<style>
    .form-card {
        max-width: 800px;
        padding: 30px;
        background: white;
        border-radius: 16px;
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

    textarea.form-control {
        min-height: 130px;
        resize: vertical;
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
<h1>Edit Tiket</h1>
<p>Perbarui informasi dan status tiket.</p>

<div class="form-card">
    <form
        action="{{ route('admin.tickets.update', $ticket) }}"
        method="POST"
    >
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Nomor Tiket</label>

            <input
                type="text"
                class="form-control"
                value="{{ $ticket->ticket_number }}"
                disabled
            >
        </div>

        <div class="form-group">
            <label for="user_id">Pelapor</label>

            <select
                id="user_id"
                name="user_id"
                class="form-control"
                required
            >
                @foreach ($employees as $employee)
                    <option
                        value="{{ $employee->id }}"
                        {{ old('user_id', $ticket->user_id) == $employee->id ? 'selected' : '' }}
                    >
                        {{ $employee->name }} — {{ $employee->email }}
                    </option>
                @endforeach
            </select>

            @error('user_id')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="ticket_category_id">Kategori</label>

            <select
                id="ticket_category_id"
                name="ticket_category_id"
                class="form-control"
                required
            >
                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ old('ticket_category_id', $ticket->ticket_category_id) == $category->id ? 'selected' : '' }}
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            @error('ticket_category_id')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="technician_id">Teknisi</label>

            <select
                id="technician_id"
                name="technician_id"
                class="form-control"
            >
                <option value="">Belum ditentukan</option>

                @foreach ($technicians as $technician)
                    <option
                        value="{{ $technician->id }}"
                        {{ old('technician_id', $ticket->technician_id) == $technician->id ? 'selected' : '' }}
                    >
                        {{ $technician->name }}
                    </option>
                @endforeach
            </select>

            @error('technician_id')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="title">Judul Masalah</label>

            <input
                type="text"
                id="title"
                name="title"
                class="form-control"
                value="{{ old('title', $ticket->title) }}"
                required
            >

            @error('title')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Deskripsi Masalah</label>

            <textarea
                id="description"
                name="description"
                class="form-control"
                required
            >{{ old('description', $ticket->description) }}</textarea>

            @error('description')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="priority">Prioritas</label>

            <select
                id="priority"
                name="priority"
                class="form-control"
                required
            >
                <option
                    value="low"
                    {{ old('priority', $ticket->priority) === 'low' ? 'selected' : '' }}
                >
                    Rendah
                </option>

                <option
                    value="medium"
                    {{ old('priority', $ticket->priority) === 'medium' ? 'selected' : '' }}
                >
                    Sedang
                </option>

                <option
                    value="high"
                    {{ old('priority', $ticket->priority) === 'high' ? 'selected' : '' }}
                >
                    Tinggi
                </option>
            </select>

            @error('priority')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="status">Status</label>

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

                <option
                    value="closed"
                    {{ old('status', $ticket->status) === 'closed' ? 'selected' : '' }}
                >
                    Ditutup
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
                href="{{ route('admin.tickets.index') }}"
                class="cancel-button"
            >
                Batal
            </a>
        </div>
    </form>
</div>
@endsection