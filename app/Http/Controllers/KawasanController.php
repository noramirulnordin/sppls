<?php
namespace App\Http\Controllers;

use App\Models\Kawasan;
use App\Models\Lori;
use Illuminate\Http\Request;

class KawasanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $kawasan = Kawasan::with('lori')->get();

            $table = datatables()->of($kawasan)
                ->addColumn('no_pendaftaran_lori', function ($kawasan) {
                    return $kawasan->lori->pluck('no_pendaftaran')->implode(', ') ?: '-';
                })
                ->make(true);
            return $table;
        }
        return view('kawasans.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $loris = Lori::all();
        return view('kawasans.create', compact('loris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kawasan = Kawasan::create($request->only(['nama', 'no_permit']));
        foreach ($request->lori_id as $loriId) {
            $kawasan->lori()->attach($loriId);
        }
        return redirect()->route('kawasans.index')->with('success', 'Kawasan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kawasan $kawasan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kawasan $kawasan)
    {
        $loris = Lori::all();
        return view('kawasans.edit', compact('kawasan', 'loris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kawasan $kawasan)
    {
        $kawasan->update($request->only(['nama', 'no_permit']));
        $kawasan->lori()->sync($request->lori_id);
        return redirect()->route('kawasans.index')->with('success', 'Kawasan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kawasan $kawasan)
    {
        $kawasan->lori()->detach();
        $kawasan->delete();
        return response()->json(['success' => 'Kawasan deleted successfully.']);
    }

    public function loris(Kawasan $kawasan)
    {
        $kawasan->load('lori');
        $loris = $kawasan->lori;
        return response()->json($loris);
    }
}
