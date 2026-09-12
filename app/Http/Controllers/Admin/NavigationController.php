<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NavigationItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class NavigationController extends Controller
{
    public function index(): View
    {
        $items = NavigationItem::with('children')
            ->whereNull('parent_id')
            ->orderBy('sort_order')
            ->get();

        return view('admin.navigation.index', compact('items'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        $data['is_active'] = (bool) ($data['is_active'] ?? true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        NavigationItem::create($data);
        return back()->with('success', 'Menu berhasil ditambahkan.');
    }

    public function update(Request $request, NavigationItem $navigation): RedirectResponse
    {
        $data = $this->validatedData($request);
        abort_if((int) ($data['parent_id'] ?? 0) === $navigation->id, 422, 'Menu tidak dapat menjadi parent untuk dirinya sendiri.');
        $data['is_active'] = (bool) ($data['is_active'] ?? false);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        $navigation->update($data);
        return back()->with('success', 'Menu berhasil diperbarui.');
    }

    public function reorder(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'items' => ['required', 'array'],
            'items.*.id' => ['required', 'exists:navigation_items,id'],
            'items.*.parent_id' => ['nullable', 'exists:navigation_items,id'],
            'items.*.sort_order' => ['required', 'integer', 'min:0'],
        ]);

        DB::transaction(function () use ($data) {
            foreach ($data['items'] as $item) {
                NavigationItem::whereKey($item['id'])->update([
                    'parent_id' => $item['parent_id'] ?? null,
                    'sort_order' => $item['sort_order'],
                ]);
            }
        });

        return back()->with('success', 'Urutan navigasi berhasil diperbarui.');
    }

    public function destroy(NavigationItem $navigation): RedirectResponse
    {
        $navigation->delete();
        return back()->with('success', 'Menu berhasil dihapus.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'parent_id' => ['nullable', 'exists:navigation_items,id'],
            'label' => ['required', 'string', 'max:100'],
            'type' => ['required', Rule::in(['home','journal','page','category','external'])],
            'reference_id' => ['nullable', 'integer'],
            'url' => ['nullable', 'string', 'max:2048'],
            'target' => ['nullable', Rule::in(['_self','_blank'])],
            'is_active' => ['nullable', 'boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
