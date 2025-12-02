<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Data Pondok</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Laporan Data Pondok Pesantren</h2>

    <h4>Data Santri</h4>
    <table>
        <thead>
            <tr><th>No</th><th>Nama</th><th>Alamat</th><th>No HP</th></tr>
        </thead>
        <tbody>
            @foreach($santri as $i => $s)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $s->nama }}</td>
                <td>{{ $s->alamat }}</td>
                <td>{{ $s->no_hp }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Data Ustadz</h4>
    <table>
        <thead>
            <tr><th>No</th><th>Nama</th><th>Alamat</th><th>No HP</th></tr>
        </thead>
        <tbody>
            @foreach($ustadz as $i => $u)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $u->nama }}</td>
                <td>{{ $u->alamat }}</td>
                <td>{{ $u->no_hp }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Data Kelas</h4>
    <table>
        <thead>
            <tr><th>No</th><th>Nama Kelas</th></tr>
        </thead>
        <tbody>
            @foreach($kelas as $i => $k)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $k->nama_kelas }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Data Pelajaran</h4>
    <table>
        <thead>
            <tr><th>No</th><th>Nama Pelajaran</th></tr>
        </thead>
        <tbody>
            @foreach($pelajaran as $i => $p)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $p->nama_pelajaran }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
