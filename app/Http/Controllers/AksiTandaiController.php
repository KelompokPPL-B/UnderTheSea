<?php

namespace App\Http\Controllers;

use App\Models\AksiPelestarian;
use App\Models\AksiTandai;
use Illuminate\Http\Request;

class AksiTandaiController extends Controller
{
    /**
     * Owner: [Grace Magaretha Sirait]
     * PBI-26: Mark Completed Action
     * User menandai aksi yang telah dilakukan (tanpa perlu login)
     */
    public function store(Request $request, $id)
    {
        AksiPelestarian::findOrFail($id);

        $validated = $request->validate([
            'nama_peserta' => 'required|string|max:100',
        ], [
            'nama_peserta.required' => 'Name is required.',
            'nama_peserta.max'      => 'Name must not exceed 100 characters.',
        ]);

        $sessionId = session()->getId();

        // Cek apakah session ini sudah pernah menandai aksi ini
        $sudahTandai = AksiTandai::where('aksi_id', $id)
            ->where('session_id', $sessionId)
            ->exists();

        if ($sudahTandai) {
            return redirect()->route('aksi.show', $id)
                ->with('tandai_info', 'You have already marked this action before.');
        }

        AksiTandai::create([
            'aksi_id'      => $id,
            'nama_peserta' => $validated['nama_peserta'],
            'session_id'   => $sessionId,
        ]);

        // Simpan ke session supaya tombol berubah state
        session()->put("tandai_aksi_{$id}", true);
        session()->put("tandai_aksi_{$id}_nama", $validated['nama_peserta']);

        return redirect()->route('aksi.show', $id)
            ->with('tandai_success', 'Action successfully marked! Your progress has been recorded.');
    }

    /**
     * Owner: [Grace Magaretha Sirait]
     * PBI-26: Mark Completed Action
     * User membatalkan tanda aksi
     */
    public function destroy($id)
    {
        AksiPelestarian::findOrFail($id);

        $sessionId = session()->getId();

        AksiTandai::where('aksi_id', $id)
            ->where('session_id', $sessionId)
            ->delete();

        session()->forget("tandai_aksi_{$id}");
        session()->forget("tandai_aksi_{$id}_nama");

        return redirect()->route('aksi.show', $id)
            ->with('tandai_info', 'Your action mark has been removed.');
    }
}