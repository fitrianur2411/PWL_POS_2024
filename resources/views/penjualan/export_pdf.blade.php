<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 6px 20px 5px 20px;
            line-height: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            padding: 4px 3px;
        }

        th {
            text-align: left;
        }

        .d-block {
            display: block;
        }

        img.image {
            width: auto;
            height: 80px;
            max-width: 150px;
            max-height: 150px;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .p-1 {
            padding: 5px 1px 5px 1px;
        }

        .font-10 {
            font-size: 10pt;
        }

        .font-11 {
            font-size: 11pt;
        }

        .font-12 {
            font-size: 12pt;
        }

        .font-13 {
            font-size: 13pt;
        }

        .border-bottom-header {
            border-bottom: 1px solid;
        }

        .border-all,
        .border-all th,
        .border-all td {
            border: 1px solid;
        }
    </style>
</head>

<body>
    <table class="border-bottom-header">
        <tr>
            <td width="15%" class="text-center">
                <img src="{{ asset('polinema.png') }}" alt="Logo" style="max-height: 80px; width: auto;"> 
            </td>
            <td width="85%">
                <span class="text-center d-block font-11 font-bold mb-1">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</span>
                <span class="text-center d-block font-13 font-bold mb-1">POLITEKNIK NEGERI MALANG</span>
                <span class="text-center d-block font-10">Jl. Soekarno-Hatta No. 9 Malang 65141</span>
                <span class="text-center d-block font-10">Telepon (0341) 404424 Pes. 101-105, 0341-404420, Fax. (0341) 404420</span>
                <span class="text-center d-block font-10">Laman: www.polinema.ac.id</span>
            </td>
        </tr>
    </table>

    <h3 class="text-center">LAPORAN DATA TRANSAKSI PENJUALAN</h3>

    <table class="border-all">
        <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Kode Penjualan</th>
                <th>Pembeli</th>
                <th>User</th>
                <th>Tanggal Penjualan</th>
                <th>Nama Barang</th>
                <th class="text-right">Harga Barang</th>
                <th class="text-right">Jumlah</th>
                <th class="text-right">Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @php
            $grandTotal = 0; // Menyimpan Grand Total atau Omset
            $no = 1; // Menginisialisasi nomor
            @endphp
            @foreach($penjualan as $p)
                @foreach($p->detail as $detail) <!-- Loop melalui detail penjualan -->
                    @php 
                        $totalHarga = $detail->harga * $detail->jumlah; 
                        $grandTotal += $totalHarga; // Menambahkan total harga barang ke grand total
                    @endphp
                    <tr>
                        <td class="text-center">{{ $no++ }}</td> <!-- Menambah nomor setiap kali detail ditampilkan -->
                        <td>{{ $p->penjualan_kode }}</td>
                        <td>{{ $p->pembeli }}</td>
                        <td>{{ $p->user->nama }}</td> <!-- Mengambil petugas dari relasi user -->
                        <td>{{ $p->penjualan_tanggal }}</td>
                        <td>{{ $detail->barang->barang_nama }}</td> <!-- Mengambil nama barang dari relasi -->
                        <td class="text-right">{{ number_format($detail->harga, 0, ',', '.') }}</td>
                        <td class="text-right">{{ $detail->jumlah }}</td>
                        <td class="text-right">{{ number_format($totalHarga, 0, ',', '.') }}</td> <!-- Menghitung total harga -->
                    </tr>
                @endforeach
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="8" class="text-right">Grand Total</th>
                <th class="text-right">{{ number_format($grandTotal, 0, ',', '.') }}</th> <!-- Menampilkan Grand Total -->
            </tr>
        </tfoot>
    </table>
</body>

</html>
