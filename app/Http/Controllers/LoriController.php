<?php
namespace App\Http\Controllers;

use App\Http\Requests\StoreLoriRequest;
use App\Http\Requests\UpdateLoriRequest;
use App\Models\Kawasan;
use App\Models\KawasanLori;
use App\Models\Lori;
use App\Models\Pembeli;

class LoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {

            $lori = Lori::with(['pemilik', 'kawasan'])->get();

            $table = datatables()->of($lori)
                ->addColumn('pemilik', function ($lori) {
                    return $lori->pemilik ? $lori->pemilik->nama : '-';
                })
                ->addColumn('kawasan', function ($lori) {
                    return $lori->kawasan->pluck('nama')->implode(', ');
                })
                ->make(true);
            return $table;

        }
        return view('loris.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pembelis = Pembeli::all();
        $kawasans = Kawasan::all();
        return view('loris.create', compact('pembelis', 'kawasans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLoriRequest $request)
    {
        $lori = Lori::create($request->validated());
        if ($request->kawasan_id) {
            foreach ($request->kawasan_id as $kawasanId) {
                KawasanLori::create([
                    'lori_id'    => $lori->id,
                    'kawasan_id' => $kawasanId,
                ]);
            }
        }

        return redirect()->route('loris.index')->with('success', 'Lori berjaya ditambah.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lori $lori)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lori $lori)
    {
        $pembelis         = Pembeli::all();
        $kawasans         = Kawasan::all();
        $selectedKawasans = $lori->kawasan->pluck('id')->toArray();
        return view('loris.edit', compact('lori', 'pembelis', 'kawasans', 'selectedKawasans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLoriRequest $request, Lori $lori)
    {
        $lori->update($request->validated());

        // Remove existing kawasan associations
        $lori->kawasan()->detach();

        // Attach new kawasan associations
        foreach ($request->kawasan_id as $kawasanId) {
            KawasanLori::create([
                'lori_id'    => $lori->id,
                'kawasan_id' => $kawasanId,
            ]);
        }

        return redirect()->route('loris.index')->with('success', 'Lori berjaya dikemaskini.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lori $lori)
    {
        $lori->kawasan()->detach();
        $lori->delete();
        return response()->json(['success' => 'Lori berjaya dipadam.']);
    }
}
