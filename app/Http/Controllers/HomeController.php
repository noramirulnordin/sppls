<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $card = [
            [
                'name'  => 'Jumlah Resit',
                'value' => \App\Models\Resit::count(),
                'icon'  => 'mdi mdi-receipt',
            ],
            [
                'name'  => 'Jumlah Balak',
                'value' => \App\Models\Balak::count(),
                'icon'  => 'mdi mdi-tree',
            ],
            [
                'name'  => 'Transaksi Selesai',
                'value' => \App\Models\Transaksi::count(),
                'icon'  => 'mdi mdi-check-circle',
            ],
            [
                'name'  => 'Jumlah Lori',
                'value' => \App\Models\Lori::count(),
                'icon'  => 'mdi mdi-truck',
            ],
            [
                'name'  => 'Jumlah Kawasan',
                'value' => \App\Models\Kawasan::count(),
                'icon'  => 'mdi mdi-map-marker',
            ],
            [
                'name'  => 'Jumlah Pembeli',
                'value' => \App\Models\Pembeli::count(),
                'icon'  => 'mdi mdi-account-group',
            ],
        ];
        return view('home', compact('card'));
    }

    public function profile()
    {
        $user = auth()->user(); // Get the authenticated user
        return view('profile', compact('user'));
    }

    public function updateProfile()
    {
        $user = auth()->user();
        $data = request()->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'profile_image' => 'nullable|image|max:2048',
            'sign_image'    => 'nullable|image|max:2048',
        ]);

        $user->update($data);

        if (request()->hasFile('sign_image')) {
            if ($user->sign_image) {
                Storage::disk('public')->delete($user->sign_image);
            }
            $signImage        = request()->file('sign_image')->store('userImg', 'public');
            $user->sign_image = $signImage;
        }

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    public function changePassword()
    {
        $user = auth()->user();
        $data = request()->validate([
            'new_password'              => ['required', 'string', 'confirmed'],
            'new_password_confirmation' => ['required', 'string'],
        ], [
            'new_password.required'  => 'Sila masukkan kata laluan baru.',
            'new_password.confirmed' => 'Pengesahan kata laluan baru tidak sepadan.',
        ]);

        $user->password = bcrypt($data['new_password']);
        $user->save();

        return redirect()->route('profile')->with('success', 'Password updated successfully.');
    }
}
