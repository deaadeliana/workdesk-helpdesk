<?php

namespace App\Http\Controllers;

use App\Models\TicketCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TicketCategoryController extends Controller
{
    public function index()
    {
        $categories = TicketCategory::latest()->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                'unique:ticket_categories,name',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        TicketCategory::create($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori tiket berhasil ditambahkan.');
    }

    public function edit(TicketCategory $ticketCategory)
    {
        return view(
            'admin.categories.edit',
            compact('ticketCategory')
        );
    }

    public function update(
        Request $request,
        TicketCategory $ticketCategory
    ) {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('ticket_categories', 'name')
                    ->ignore($ticketCategory->id),
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'is_active' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $ticketCategory->update($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori tiket berhasil diperbarui.');
    }

    public function destroy(TicketCategory $ticketCategory)
    {
        $ticketCategory->delete();

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori tiket berhasil dihapus.');
    }
}