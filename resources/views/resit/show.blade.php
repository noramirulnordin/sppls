<!DOCTYPE html>
<html lang="ms">

<head>
    <meta charset="UTF-8">
    <title>Nota Edaran - Liga Sepakat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-size: 14px;
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .table-bordered td,
        .table-bordered th {
            border: 1px solid #000 !important;
        }

        .signature-line {
            border-bottom: 1px dotted #000;
            width: 100%;
            height: 20px;
            display: inline-block;
        }

        .section-title {
            font-weight: bold;
            margin-top: 20px;
        }
    </style>
</head>

<body class="container mt-3" @if ($fromPrint) onload="window.print()" @endif>

    <div class="receipt-header d-flex align-items-center mb-3 justify-content-center">
        <div class="me-3">
            <img src="{{ $logo }}" alt="Logo" style="height: 130px;" class="img-fluid">
        </div>
        <div class="receipt-info">
            <h5 class="mb-1" style="text-decoration: underline;">NOTA EDARAN</h5>
            <h4 class="fw-bold mb-1 d-inline">LIGA SEPAKAT SDN. BHD.</h4>
            <p class="d-inline ms-2">(546297-T | 200101010541)</p>
            <hr class="my-0">
            <p class="my-0 py-0" style="font-size: 12px;">LOT 4633 A, KAMPUNG TAINI, 21700, KUALA BERANG, TERENGGANU</p>
            <p class="mb-0" style="font-size: 12px;">
                TEL: 013-384 2100 (ILHAM) | 016-745 8333 (SUBHAN) &nbsp; EMAIL: ligasepakat18@gmail.com
            </p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-6">
            <strong>No. Permit:</strong> {{ $resit->kawasanLori->kawasan->no_permit }} <br>
            <strong>Nama Pembeli:</strong> {{ $resit->pembeli->nama }} <br>
            <strong>Alamat Hantaran:</strong> {{ $resit->pembeli->alamat }} <br>
        </div>
        <div class="col-md-6 text-end">
            <strong>No.:</strong> <span style="color: red; font-size: 1.5em;">{{ $resit->id }}</span><br>
            <strong>Tarikh:</strong> {{ $resit->created_at->format('d/m/Y') }}
        </div>
    </div>

    <!-- Table -->
    <table class="table table-bordered">
        <thead class="text-center">
            <tr>
                <th colspan="2">No. Balak</th>
                <th rowspan="2">JENIS</th>
                <th colspan="2">Ukuran</th>
                <th rowspan="2">Tan</th>
                <th rowspan="2">Potongan</th>
                <th rowspan="2">Tan</th>
                <th rowspan="2">Catatan</th>
            </tr>
            <tr class="text-center">
                <th>PJ</th>
                <th>JH</th>
                <th>Panjang</th>
                <th>Perepang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($resit->transaksi as $transaksi)
                <tr>
                    <td class="text-center"></td>
                    <td class="text-center"></td>
                    <td class="text-center">{{ $transaksi->balak->jenis_pokok }}</td>
                    <td class="text-center">{{ $transaksi->balak->panjang }} m</td>
                    <td class="text-center">{{ $transaksi->balak->diameter }} cm</td>
                    <td class="text-center">{{ $transaksi->tan ?? '' }} </td>
                    <td class="text-center">{{ $transaksi->potongan ?? '' }}</td>
                    <td class="text-center">{{ $transaksi->tan_after ?? '' }} </td>
                    <td class="text-center">{{ $transaksi->catatan ?? '' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer Signatures -->
    <div class="row mt-5">
        <div class="col-md-3">
            <p class="fw-bold">Liga Sepakat Sdn. Bhd.</p>
            <p class="text-center">
                @if (auth()->user() && auth()->user()->sign_image)
                    <img src="{{ asset('storage/' . auth()->user()->sign_image) }}" alt="Tandatangan"
                        style="height:100px;"><br>
                @else
                    <span class="signature-line"></span><br>
                @endif
                (Kerani)
            </p>
            <p>No. Lori: {{ $resit->kawasanLori->lori->no_pendaftaran }}</p>
            <p>Saya terima balak-balak seperti di atas</p>
            <p>Tandatangan: <span class="signature-line"></span></p>
            <p>Nama: <span class="signature-line"></span></p>
        </div>
        <div class="col-md-6">

        </div>
        <div class="col-md-3 text-start">
            <p class="fw-bold">Saya terima balak-balak seperti di atas</p>
            <p>Pembekal/Wakil: <span class="signature-line"></span></p>
        </div>
    </div>

</body>

</html>
