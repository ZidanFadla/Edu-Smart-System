<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMapelRequest;
use App\Http\Requests\UpdateMapelRequest;
use App\Models\Mapel;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MapelController extends Controller
{
    public function index(): View
    {
        return view('admin.mapels.index', [
            'mapels' => Mapel::latest()->paginate(10),
        ]);
    }

    public function create(): View
    {
        return view('admin.mapels.create', [
            'mapel' => new Mapel(),
        ]);
    }

    public function store(StoreMapelRequest $request): RedirectResponse
    {
        Mapel::create($request->validated());

        return redirect()->route('admin.mapels.index')->with('success', 'Data mapel berhasil ditambahkan.');
    }

    public function edit(Mapel $mapel): View
    {
        return view('admin.mapels.edit', [
            'mapel' => $mapel,
        ]);
    }

    public function update(UpdateMapelRequest $request, Mapel $mapel): RedirectResponse
    {
        $mapel->update($request->validated());

        return redirect()->route('admin.mapels.index')->with('success', 'Data mapel berhasil diperbarui.');
    }

    public function destroy(Mapel $mapel): RedirectResponse
    {
        $mapel->delete();

        return redirect()->route('admin.mapels.index')->with('success', 'Data mapel berhasil dihapus.');
    }
}
