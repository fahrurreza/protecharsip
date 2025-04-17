<!DOCTYPE html>
<html>
<head>
    <title>Protech Academy</title>
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            font-family: "Times New Roman", Times, serif;
        }
        .center-text {
            text-align: center;
            font-weight: bold;
            padding-bottom: -20px;
            font-size : 14px
        }
        .data {
            margin-top : 50px;
        }

        table {
            width: 100%;
            border-collapse: collapse; /* Menggabungkan border tabel */
            font-size: 12px;
        }

        table, th, td {
            border: 1px solid black; /* Memberikan border pada tabel, th, dan td */
        }

        th, td {
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2; /* Warna latar belakang untuk header tabel */
            font-weight: bold;
        }

        .ttd table {
            border: none;
            width: 100%;
        }

        .ttd td {
            border: none;
        }

        .data table {
            margin-bottom: 40px; /* Adjust the value as needed */
        }

        .keterangan td {
        padding-bottom: 50px;
        }

        .nama td {
        padding-top: 20px;
        }

        
    </style>
</head>
<body>
<div class="header">
    <style>
        .header table {
            border-collapse: collapse;
            border: none;
            width: 100%;
            color : blue;
        }

        .header span {
            color: #FFCC00;
        }

        .header td {
            border: none;
            padding: 5px;
            vertical-align: top;
            border-bottom: 1px solid black;
        }

        .header .logo-cell {
            width: 100px;
        }

        .header .content-cell h3 {
            margin: 0;
            color: #17a2b8; /* warna biru info */
        }

        .header .contact-info {
            font-size: 0.9em;
            color: #555;
        }
    </style>

    <table>
        <tr>
            <td class="logo-cell">
                <img src="{{ asset('assets/img/logocop.png') }}" alt="Logo" width="100px">
            </td>
            <td class="content-cell">
                <h3 class="text-info">PT. PROTECH <span>ACADEMY</span></h3>
                <p>Jl. Danau Laut Tawar Lk. V Kel. Sumber Karya</p>
                <p>Kec. Binjai Timur Kota Binjai Prov. Sumatera Utara</p>
                <p class="contact-info">Telp: +62 823-6305-5002 | Email: protech.academy.binjai@gmail.com</p>
            </td>
        </tr>
    </table>
</div>

    <h5 class="center-text">LAPORAN ARSIP {{ $data['type'] }}</h5>
    <h5 class="center-text">PT. PROTECH ACADEMY BINJAI {{ $data['type'] }}</h5>
    <h5 class="center-text">TAHUN {{ $data['year'] }}</h5>

    <div class="data">
        <p>Bulan : {{ $data['month'] }}</p>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>No. Agenda</th>
                    @if($data['type'] === 'SURAT MASUK')
                    <th>Pengirim</th>
                    @else
                    <th>Tujuan</th>
                    @endif
                    <th>No. Surat</th>
                    <th>Perihal</th>
                    <th>Tanggal Surat</th>
                    <th>Tanggal Diterima</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['surat'] as $surat)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$surat->no_agenda}}</td>
                    <td>{{$surat->pengirim}}</td>
                    <td>{{$surat->no_surat}}</td>
                    <td>{{$surat->notes}}</td>
                    <td>{{date('Y-m-d', strtotime($surat->tgl_surat))}}</td>
                    <td>{{date('Y-m-d', strtotime($surat->tgl_dikirim))}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="ttd">
        <table>
            <tr class="keterangan">
                <td> 
                    <center> 
                        Mengetahui,
                        <p>Direktur</p>
                        PT. Protech Academy Binjai
                    </center>
                </td>
                <td> 
                    <center> 
                        Binjai, {{date('d F Y')}}
                        <p>Staff Administrasi</p>
                        PT. Protech Academy Binjai
                    </center>
                </td>
            </tr>

            <tr class="nama">
                <td> 
                    <center> 
                        <b>Mitra Pranata, S. Kom</b>
                    </center>
                </td>
                <td> 
                    <center> 
                        <b>Wisnu Wardhana</b>
                    </center>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>