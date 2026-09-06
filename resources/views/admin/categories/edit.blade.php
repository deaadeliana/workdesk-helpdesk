@extends('layouts.admin')

@section('title', 'Edit Kategori')

@section('page-title', 'Edit Kategori Tiket')

@section('styles')
    <style>
        .form-container {
            max-width: 750px;
            padding: 28px;
            border-radius: 12px;
            background: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-weight: bold;
        }

        .required {
            color: #dc2626;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-family: Arial, sans-serif;
            font-size: 15px;
        }

        .form-control:focus {
            border-color: #2563eb;
            outline: none;
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .checkbox-group input {
            width: 18px;
            height: 18px;
        }

        .error-message {
            margin-top: 7px;
            color: #dc2626;
            font-size: 14px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .cancel-button,
        .update-button {
            padding: 11px 18px;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            text-decoration: none;
            cursor: pointer;
        }

        .cancel-button {
            color: #334155;
            background: #e2e8f0;
        }

        .update-button {
            color: white;
            background: #f59e0b;
        }

        .update-button:hover {
            background: #d97706;
        }
    </style>
@endsection

@section('content')
    <div class="form-container">
        <form
            action="{{ route(
                'admin.categories.update',
                $ticketCategory
            ) }}"
            method="POST"
        >
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">
                    Nama Kategori
                    <span class="required">*</span>
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    class="form-control"
                    value="{{ old('name', $ticketCategory->name) }}"
                    required
                >

                @error('name')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">
                    Deskripsi
                </label>

                <textarea
                    id="description"
                    name="description"
                    class="form-control"
                >{{ old(
                    'description',
                    $ticketCategory->description
                ) }}</textarea>

                @error('description')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <div class="checkbox-group">
                    <input
                        type="checkbox"
                        id="is_active"
                        name="is_active"
                        value="1"
                        {{ old(
                            'is_active',
                            $ticketCategory->is_active
                        ) ? 'checked' : '' }}
                    >

                    <label for="is_active">
                        Kategori aktif
                    </label>
                </div>

                @error('is_active')
                    <div class="error-message">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-actions">
                <a
                    href="{{ route('admin.categories.index') }}"
                    class="cancel-button"
                >
                    Batal
                </a>

                <button type="submit" class="update-button">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
@endsection