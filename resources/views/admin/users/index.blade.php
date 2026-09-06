@extends('layouts.admin')

@section('title', 'Data Pengguna')

@section('styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 24px;
    }

    .add-button {
        display: inline-block;
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
        border-collapse: collapse;
    }

    th,
    td {
        padding: 18px 20px;
        text-align: left;
        border-bottom: 1px solid #e5e7eb;
    }

    th {
        color: #374151;
        background: #f8fafc;
    }

    .role-badge {
        display: inline-block;
        padding: 6px 12px;
        color: #1d4ed8;
        background: #dbeafe;
        border-radius: 20px;
        text-transform: capitalize;
    }

    .edit-button,
    .delete-button {
        display: inline-block;
        padding: 8px 14px;
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

    .delete-form {
        display: inline;
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
        <h1>Data Pengguna</h1>
        <p>Kelola akun administrator, pegawai, dan teknisi.</p>
    </div>

    <a href="{{ route('admin.users.create') }}" class="add-button">
        + Tambah Pengguna
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
                <th>No.</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
                <th>Tindakan</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>
                        {{ $users->firstItem() + $loop->index }}
                    </td>

                    <td>{{ $user->name }}</td>

                    <td>{{ $user->email }}</td>

                    <td>
                        <span class="role-badge">
                            {{ $user->role }}
                        </span>
                    </td>

                    <td>
                        <a
                            href="{{ route('admin.users.edit', $user) }}"
                            class="edit-button"
                        >
                            Edit
                        </a>

                        @if ($user->id !== auth()->id())
                            <form
                                action="{{ route('admin.users.destroy', $user) }}"
                                method="POST"
                                class="delete-form"
                                onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="delete-button">
                                    Hapus
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center;">
                        Belum ada data pengguna.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div style="margin-top: 20px;">
    {{ $users->links() }}
</div>
@endsection