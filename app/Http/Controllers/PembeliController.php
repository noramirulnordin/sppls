<?php
namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Http\Request;

class PembeliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Pembeli::query())
                ->make(true);
        }

        return view('pembelis.index');

    }

    public function select2()
    {
        $pembelis = Pembeli::all();
        return response()->json($pembelis);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pembelis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'no_hp'  => 'nullable|string|max:11',
            'email'  => 'nullable|email|max:255',
        ], [
            'nama.required' => 'Nama pembeli diperlukan.',
            'no_hp.max'     => 'Nombor telefon tidak boleh melebihi 11 digit.',
            'email.email'   => 'Sila masukkan alamat email yang sah.',

        ]);

        Pembeli::create($request->only('nama', 'alamat', 'no_hp', 'email'));

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Berjaya tambah pembeli!',
                'data'    => Pembeli::all(),
            ]);
        }

        return redirect()->route('pembelis.index')->with('success', 'Berjaya tambah pembeli!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pembeli $pembeli)
    {
        $pembeli->load('resits.transaksi');

        return view('pembelis.show', compact('pembeli'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pembeli $pembeli)
    {
        return view('pembelis.edit', compact('pembeli'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pembeli $pembeli)
    {
        $request->validate([
            'nama'   => 'required|string|max:255',
            'alamat' => 'nullable|string|max:255',
            'no_hp'  => 'nullable|string|max:11',
            'email'  => 'nullable|email|max:255',
        ], [
            'nama.required' => 'Nama pembeli diperlukan.',
            'no_hp.max'     => 'Nombor telefon tidak boleh melebihi 11 digit.',
            'email.email'   => 'Sila masukkan alamat email yang sah.',

        ]);

        $pembeli->update($request->only('nama', 'alamat', 'no_hp', 'email'));

        return redirect()->route('pembelis.index')->with('success', 'Berjaya kemaskini pembeli!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pembeli $pembeli)
    {
        $pembeli->delete();
    }
}
