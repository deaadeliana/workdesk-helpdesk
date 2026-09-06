@extends('layouts.admin')

@section('title', 'Tambah Pengguna')

@section('styles')
<style>
    .form-card {
        max-width: 700px;
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
<h1>Tambah Pengguna</h1>
<p>Tambahkan akun administrator, pegawai, atau teknisi.</p>

<div class="form-card">
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nama</label>

            <input
                type="text"
                id="name"
                name="name"
                class="form-control"
                value="{{ old('name') }}"
                required
            >

            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email</label>

            <input
                type="email"
                id="email"
                name="email"
                class="form-control"
                value="{{ old('email') }}"
                required
            >

            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="role">Role</label>

            <select id="role" name="role" class="form-control" required>
                <option value="">Pilih role</option>
                <option
                    value="employee"
                    {{ old('role') === 'employee' ? 'selected' : '' }}
                >
                    Pegawai
                </option>
                <option
                    value="technician"
                    {{ old('role') === 'technician' ? 'selected' : '' }}
                >
                    Teknisi
                </option>
                <option
                    value="admin"
                    {{ old('role') === 'admin' ? 'selected' : '' }}
                >
                    Administrator
                </option>
            </select>

            @error('role')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>

            <input
                type="password"
                id="password"
                name="password"
                class="form-control"
                required
            >

            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation">
                Konfirmasi Password
            </label>

            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                class="form-control"
                required
            >
        </div>

        <div class="button-group">
            <button type="submit" class="save-button">
                Simpan
            </button>

            <a
                href="{{ route('admin.users.index') }}"
                class="cancel-button"
            >
                Batal
            </a>
        </div>
    </form>
</div>
@endsection