@extends('layouts.admin')

@section('title', 'Kategori Tiket')

@section('page-title', 'Kategori Tiket')

@section('styles')
    <style>
        .page-actions {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 20px;
        }

        .add-button {
            padding: 11px 18px;
            border-radius: 8px;
            color: white;
            background: #2563eb;
            text-decoration: none;
        }

        .add-button:hover {
            background: #1d4ed8;
        }

        .alert-success {
            margin-bottom: 20px;
            padding: 14px;
            border-radius: 8px;
            color: #166534;
            background: #dcfce7;
        }

        .table-container {
            overflow-x: auto;
            border-radius: 12px;
            background: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 16px;
            border-bottom: 1px solid #e2e8f0;
            text-align: left;
        }

        th {
            color: #475569;
            background: #f8fafc;
        }

        .badge {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
        }

        .badge-active {
            color: #166534;
            background: #dcfce7;
        }

        .badge-inactive {
            color: #991b1b;
            background: #fee2e2;
        }

        .action-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .edit-button,
        .delete-button {
            padding: 7px 12px;
            border: none;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            cursor: pointer;
        }

        .edit-button {
            background: #f59e0b;
        }

        .delete-button {
            background: #dc2626;
        }

        .empty-message {
            padding: 32px;
            color: #64748b;
            text-align: center;
        }

        .pagination {
            margin-top: 20px;
        }
    </style>
@endsection

@section('content')
    @if (session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="page-actions">
        <a
            href="{{ route('admin.categories.create') }}"
            class="add-button"
        >
            + Tambah Kategori
        </a>
    </div>

    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Status</th>
                    <th>Tindakan</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>
                            {{ $loop->iteration }}
                        </td>

                        <td>
                            {{ $category->name }}
                        </td>

                        <td>
                            {{ $category->description ?? '-' }}
                        </td>

                        <td>
                            @if ($category->is_active)
                                <span class="badge badge-active">
                                    Aktif
                                </span>
                            @else
                                <span class="badge badge-inactive">
                                    Tidak Aktif
                                </span>
                            @endif
                        </td>

                        <td>
                            <div class="action-group">
                                <a
                                    href="{{ route(
                                        'admin.categories.edit',
                                        $category
                                    ) }}"
                                    class="edit-button"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route(
                                        'admin.categories.destroy',
                                        $category
                                    ) }}"
                                    method="POST"
                                    onsubmit="return confirm(
                                        'Yakin ingin menghapus kategori ini?'
                                    )"
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
                        <td colspan="5" class="empty-message">
                            Belum ada kategori tiket.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $categories->links() }}
    </div>
@endsection