<!-- Header Section -->
<table style="width: 100%; margin-bottom: 20px;">
    <tr>
        <td style="width: 130px; vertical-align: top;">
            <img src="{{ $logo }}" alt="Logo" style="height: 130px;">
        </td>
        <td style="vertical-align: top; text-align: center;">
            <h5 style="margin-bottom: 5px; text-decoration: underline;">NOTA EDARAN</h5>
            <h4 style="font-weight: bold; display: inline;">LIGA SEPAKAT SDN. BHD.</h4>
            <span style="margin-left: 10px;">(546297-T | 200101010541)</span>
            <hr style="margin: 5px 0;">
            <div style="font-size: 12px;">
                LOT 4633 A, KAMPUNG TAINI, 21700, KUALA BERANG, TERENGGANU<br>
                TEL: 013-384 2100 (ILHAM) | 016-745 8333 (SUBHAN) &nbsp; EMAIL: ligasepakat18@gmail.com
            </div>
        </td>
    </tr>
</table>

<!-- Info Section -->
<table style="width: 100%; margin-bottom: 20px;">
    <tr>
        <td style="width: 60%; vertical-align: top;">
            <strong>No. Permit:</strong> {{ $resit->kawasanLori->kawasan->no_permit }} <br>
            <strong>Nama Pembeli:</strong> {{ $resit->pembeli->nama }} <br>
            <strong>Alamat Hantaran:</strong> {{ $resit->pembeli->alamat }} <br>
        </td>
        <td style="width: 40%; text-align: right; vertical-align: top;">
            <strong>No.:</strong> <span style="color: red; font-size: 1.5em;">{{ $resit->id }}</span><br>
            <strong>Tarikh:</strong> {{ $resit->created_at->format('d/m/Y') }}
        </td>
    </tr>
</table>

<table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">
    <thead>
        <tr>
            <th colspan="2" style="border: 1px solid #000; text-align: center;">No. Balak</th>
            <th rowspan="2" style="border: 1px solid #000; text-align: center;">JENIS</th>
            <th colspan="2" style="border: 1px solid #000; text-align: center;">Ukuran</th>
            <th rowspan="2" style="border: 1px solid #000; text-align: center;">Tan</th>
            <th rowspan="2" style="border: 1px solid #000; text-align: center;">Potongan</th>
            <th rowspan="2" style="border: 1px solid #000; text-align: center;">Tan</th>
            <th rowspan="2" style="border: 1px solid #000; text-align: center;">Catatan</th>
        </tr>
        <tr>
            <th style="border: 1px solid #000; text-align: center;">PJ</th>
            <th style="border: 1px solid #000; text-align: center;">JH</th>
            <th style="border: 1px solid #000; text-align: center;">Panjang</th>
            <th style="border: 1px solid #000; text-align: center;">Perepang</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($resit->transaksi as $transaksi)
            <tr>
                <td style="border: 1px solid #000; text-align: center;"></td>
                <td style="border: 1px solid #000; text-align: center;"></td>
                <td style="border: 1px solid #000; text-align: center;">{{ $transaksi->balak->jenis_pokok }}</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $transaksi->balak->panjang }} m</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $transaksi->balak->diameter }} cm</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $transaksi->tan ?? '' }}</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $transaksi->potongan ?? '' }}</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $transaksi->tan_after ?? '' }}</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $transaksi->catatan ?? '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Footer Signatures -->
<table style="width: 100%; margin-top: 40px;">
    <tr>
        <td style="width: 33%; vertical-align: top;">
            <p style="font-weight: bold;">Liga Sepakat Sdn. Bhd.</p>
            @if (auth()->user() && auth()->user()->sign_image)
                <img src="{{ $sign }}" alt="Tandatangan" style="height:100px;"><br>
            @else
                <span
                    style="border-bottom: 1px dotted #000; display: inline-block; width: 100%; height: 20px;"></span><br>
            @endif
            (Kerani)
            <p>No. Lori: {{ $resit->kawasanLori->lori->no_pendaftaran }}</p>
            <p>Saya terima balak-balak seperti di atas</p>
            <p>Tandatangan: <span
                    style="border-bottom: 1px dotted #000; display: inline-block; width: 100px; height: 20px;"></span>
            </p>
            <p>Nama: <span
                    style="border-bottom: 1px dotted #000; display: inline-block; width: 100px; height: 20px;"></span>
            </p>
        </td>
        <td style="width: 34%;">&nbsp;</td>
        <td style="width: 33%; vertical-align: top;">
            <p style="font-weight: bold;">Saya terima balak-balak seperti di atas</p>
            <p>Pembekal/Wakil: <span
                    style="border-bottom: 1px dotted #000; display: inline-block; width: 100px; height: 20px;"></span>
            </p>
        </td>
    </tr>
</table>
