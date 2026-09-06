@extends('layouts.employee')

@section('title', 'Buat Tiket')

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
<h1>Buat Tiket Baru</h1>
<p>Laporkan masalah agar dapat ditangani oleh teknisi.</p>

<div class="form-card">
    <form action="{{ route('employee.tickets.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label>Pelapor</label>

            <input
                type="text"
                class="form-control"
                value="{{ auth()->user()->name }} — {{ auth()->user()->email }}"
                disabled
            >
        </div>

        <div class="form-group">
            <label for="ticket_category_id">Kategori</label>

            <select
                id="ticket_category_id"
                name="ticket_category_id"
                class="form-control"
                required
            >
                <option value="">Pilih kategori</option>

                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        {{ old('ticket_category_id') == $category->id ? 'selected' : '' }}
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
            <label for="title">Judul Masalah</label>

            <input
                type="text"
                id="title"
                name="title"
                class="form-control"
                value="{{ old('title') }}"
                placeholder="Contoh: Laptop tidak dapat terhubung ke Wi-Fi"
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
                placeholder="Jelaskan masalah secara lengkap"
                required
            >{{ old('description') }}</textarea>

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
                <option value="">Pilih prioritas</option>
                <option value="low" {{ old('priority') === 'low' ? 'selected' : '' }}>
                    Rendah
                </option>
                <option value="medium" {{ old('priority') === 'medium' ? 'selected' : '' }}>
                    Sedang
                </option>
                <option value="high" {{ old('priority') === 'high' ? 'selected' : '' }}>
                    Tinggi
                </option>
            </select>

            @error('priority')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="button-group">
            <button type="submit" class="save-button">
                Kirim Tiket
            </button>

            <a
                href="{{ route('employee.tickets.index') }}"
                class="cancel-button"
            >
                Batal
            </a>
        </div>
    </form>
</div>
@endsection