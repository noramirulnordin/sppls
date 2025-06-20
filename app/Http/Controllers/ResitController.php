<?php
namespace App\Http\Controllers;

use App\Models\Resit;
use Dompdf\Dompdf;
use Illuminate\Http\Request;

class ResitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resits = Resit::with('pembeli')->get();
        return view('resit.index', compact('resits'));
    }

    public function download(Resit $resit)
    {
        $resit->load('kawasanLori.lori', 'kawasanLori.kawasan', 'transaksi.balak', 'pembeli');

        $options = new \Dompdf\Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);

        $logoPath = public_path('assets/images/logo.png');
        $logoType = pathinfo($logoPath, PATHINFO_EXTENSION);
        $logoData = base64_encode(file_get_contents($logoPath));
        $logo     = 'data:image/' . $logoType . ';base64,' . $logoData;

        $signData = '';
        if (auth()->user() && auth()->user()->sign_image) {
            $signPath = storage_path('app/public/' . auth()->user()->sign_image);
            if (file_exists($signPath)) {
                $signType = pathinfo($signPath, PATHINFO_EXTENSION);
                $signData = base64_encode(file_get_contents($signPath));
                $signData = 'data:image/' . $signType . ';base64,' . $signData;
            }
        }

        $html = view('resit.export', [
            'resit' => $resit,
            'logo'  => $logo,
            'sign'  => $signData,
        ])->render();

        $dompdf->setPaper([0, 0, 595.28, 841.89], 'portrait'); // A4 in points (72dpi)
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream('resit-' . $resit->id . '.pdf', [
            'Attachment' => true,
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Resit $resit, Request $request)
    {
        $resit->load('kawasanLori.lori', 'kawasanLori.kawasan', 'transaksi.balak', 'pembeli');
        if ($resit->transaksi->isEmpty()) {
            return redirect()->route('resits.index')->with('error', 'Resit ini tidak mempunyai transaksi.');
        }
        $logoPath = public_path('assets/images/logo.png');
        $logoType = pathinfo($logoPath, PATHINFO_EXTENSION);
        $logoData = base64_encode(file_get_contents($logoPath));
        $logo     = 'data:image/' . $logoType . ';base64,' . $logoData;

        $fromPrint = $request->input('from_print', false);
        return view('resit.show', compact('resit', 'logo', 'fromPrint'));
    }

    public function destroy(Resit $resit)
    {
        $resit->transaksi()->delete();
        $resit->delete();
        return redirect()->route('resits.index')->with('success', 'Resit berjaya dipadam.');
    }
}
