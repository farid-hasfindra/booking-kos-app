<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LandingInfoController extends Controller
{
    public function index()
    {
        $landingInfos = \App\Models\LandingInfo::all();
        return view('admin.landing_infos.index', compact('landingInfos'));
    }

    public function create()
    {
        return view('admin.landing_infos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'value' => 'required|string|max:255',
            'text' => 'required|string|max:255',
            'icon' => 'nullable|string', // Assuming icon might be added later or is optional
        ]);

        \App\Models\LandingInfo::create([
            'value' => $request->value,
            'text' => $request->text,
            'icon' => $request->icon,
        ]);

        return redirect()->route('admin.landing-infos.index')
            ->with('success', 'Informasi Beranda berhasil ditambahkan.');
    }

    public function edit(string $id)
    {
        $landingInfo = \App\Models\LandingInfo::findOrFail($id);
        return view('admin.landing_infos.edit', compact('landingInfo'));
    }

    public function destroy(string $id)
    {
        $landingInfo = \App\Models\LandingInfo::findOrFail($id);
        $landingInfo->delete();

        return redirect()->route('admin.landing-infos.index')
            ->with('success', 'Informasi Beranda berhasil dihapus.');
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'value' => 'required|string|max:255',
            'text' => 'required|string|max:255',
        ]);

        $landingInfo = \App\Models\LandingInfo::findOrFail($id);
        $landingInfo->update([
            'value' => $request->value,
            'text' => $request->text,
        ]);

        return redirect()->route('admin.landing-infos.index')
            ->with('success', 'Informasi Beranda berhasil diperbarui.');
    }
}
