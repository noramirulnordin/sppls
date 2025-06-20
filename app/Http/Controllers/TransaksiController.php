<?php
namespace App\Http\Controllers;

use App\Models\Balak;
use App\Models\Kawasan;
use App\Models\KawasanLori;
use App\Models\Pembeli;
use App\Models\Resit;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Transaksi::with(['pembeli', 'balak'])->get())
                ->make(true);
        }

        return view('transaksi.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pembelis = Pembeli::all();
        $balaks   = Balak::where('status', 'Tersedia')->get();
        $kawasans = Kawasan::all();
        return view('transaksi.create', compact('pembelis', 'balaks', 'kawasans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kawasanLori = KawasanLori::where('lori_id', $request->lori_id)
            ->where('kawasan_id', $request->kawasan_id)
            ->first();

        if (! $kawasanLori) {
            return response()->json([
                'success' => false,
                'message' => 'Kawasan lori tidak ditemui.',
            ], 404);
        }

        $resit = Resit::create([
            'tarikh'          => now(),
            'pembeli_id'      => $request->pembeli_id,
            'jumlah_balak'    => count($request->balaks),
            'kawasan_lori_id' => $kawasanLori->id,
        ]);

        foreach ($request->balaks as $balak) {
            Transaksi::create([
                'pembeli_id'    => $request->pembeli_id,
                'balak_id'      => $balak['id'],
                'tarikh_dibeli' => now(),
                'resit_id'      => $resit->id,
            ]);

            $balakModel = Balak::find($balak['id']);
            if ($balakModel) {
                $balakModel->update([
                    'status' => 'Dijual',
                ]);
            }

        }

        return response()->json([
            'success'  => true,
            'message'  => 'Berjaya tambah transaksi!',
            'resit_id' => $resit->id,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        $pembelis = Pembeli::all();
        $balaks   = Balak::where('status', 'Tersedia')->get();
        return view('transaksi.edit', compact('transaksi', 'pembelis', 'balaks'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'pembeli_id'    => 'required|exists:pembelis,id',
            'balak_id'      => 'required|exists:balaks,id',
            'tarikh_dibeli' => 'required|date',
        ]);

        $transaksi->update($request->all());

        return redirect()->route('transaksis.index')->with('success', 'Transaksi berjaya dikemaskini.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();

    }
}
