<?php
namespace App\Http\Controllers;

use App\Models\Balak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BalakController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = Balak::query();

            if (request('from_transaksi') == 1) {
                $query->where('status', 'tersedia');
            }

            return datatables()->of($query)
                ->addColumn('gambar', function (Balak $balak) {
                    if ($balak->gambar) {
                        $imageUrl = url($balak->gambar);
                        return '
                    <div style="position: relative; display: inline-block; text-align: center; width: 100px; height: 100px;">
                        <img src="' . $imageUrl . '" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                        <a href="' . $imageUrl . '" target="_blank" style="position: absolute; left: 50%; bottom: 8px; transform: translateX(-50%); background: rgba(255,255,255,0.7); border-radius: 50%; padding: 4px 8px;" title="Lihat Gambar">
                            <i class="uil-focus"></i>
                        </a>
                    </div>
                ';
                    } else {
                        return '<div style="position: relative; display: inline-block; text-align: center; width: 100px; height: 100px;">
                        <img src="/assets/images/no-image.png" class="img-thumbnail" style="width: 100px; height: 100px; object-fit: cover; border-radius: 8px;">
                    </div>';
                    }
                })
                ->rawColumns(['gambar', 'status'])
                ->make(true);
        }

        return view('balaks.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('balaks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_pokok' => 'required|string|max:255',
            'panjang'     => 'nullable|numeric',
            'diameter'    => 'nullable|numeric',
            'status'      => 'required|string',
            'gambar'      => 'nullable|image|max:2048',
        ]);
        $data = $request->only('jenis_pokok', 'panjang', 'diameter', 'status');

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('balaks', 'public');
        }

        Balak::create($data);

        return redirect()->route('balaks.index')->with('success', 'Berjaya tambah balak!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Balak $balak)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Balak $balak)
    {
        return view('balaks.edit', [
            'balak' => $balak,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Balak $balak)
    {
        $request->validate([
            'jenis_pokok' => 'required|string|max:255',
            'panjang'     => 'nullable|numeric',
            'diameter'    => 'nullable|numeric',
            'status'      => 'required|string',
            'gambar'      => 'nullable|image|max:2048',
        ]);
        $data = $request->only('jenis_pokok', 'panjang', 'diameter', 'status');

        if ($request->hasFile('gambar')) {
            if ($balak->gambar) {
                Storage::disk('public')->delete($balak->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('balaks', 'public');
        }

        $balak->update($data);

        return redirect()->route('balaks.index')->with('success', 'Berjaya kemaskini balak!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Balak $balak)
    {
        if ($balak->gambar) {
            Storage::disk('public')->delete($balak->gambar);
        }
        $balak->delete();

    }
}
