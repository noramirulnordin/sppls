<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(User::query())
                ->make(true);
        }

        return view('users.index');
    }
    /**
     * Show the form for resetting the password of the specified resource.
     */
    public function resetPassword(User $user)
    {
        $user->password = bcrypt('12345678'); // Set default password
        $user->save();
        return redirect()->route('users.index')->with('success', 'Kata laluan pekerja telah ditetapkan semula.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'required|boolean',
        ], [
            'name.required'      => 'Nama pekerja diperlukan.',
            'email.required'     => 'Email pekerja diperlukan.',
            'email.email'        => 'Sila masukkan alamat email yang sah.',
            'email.unique'       => 'Email ini telah digunakan.',
            'password.required'  => 'Kata laluan diperlukan.',
            'password.min'       => 'Kata laluan mesti sekurang-kurangnya 8 aksara.',
            'password.confirmed' => 'Kata laluan tidak sepadan.',
            'is_admin.required'  => 'Sila pilih peranan pekerja.',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
            'is_admin' => $request->is_admin,
        ]);

        return redirect()->route('users.index')->with('success', 'Pekerja berjaya ditambah.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'is_admin' => 'required|boolean',
        ], [
            'name.required'     => 'Nama pekerja diperlukan.',
            'email.required'    => 'Email pekerja diperlukan.',
            'email.email'       => 'Sila masukkan alamat email yang sah.',
            'email.unique'      => 'Email ini telah digunakan.',
            'is_admin.required' => 'Sila pilih peranan pekerja.',
        ]);

        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'is_admin' => $request->is_admin,
        ]);

        return redirect()->route('users.index')->with('success', 'Pekerja berjaya dikemaskini.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['success' => 'Pekerja berjaya dipadam.']);
    }
}
