<table>
    <thead>
        <tr>
            <th colspan="17">Rekap Harian Penanaman dan Pembagian Bibit KPH TANAH LAUT</th>
        </tr>
        <tr>
            <th colspan="17">Tahun {{ $tahun }}</th>
        </tr>
        <tr>
            <th rowspan="2">NO</th>
            <th rowspan="2">HARI/TGL</th>
            <th colspan="5">PENANAMAN</th>
            <th colspan="2">Koordinat Penanaman</th>
            <th colspan="4">PEMBAGIAN BIBIT</th>
            <th colspan="2">Koordinat Pembagian</th>
        </tr>
        <tr>
            <th>Jenis Bibit</th>
            <th>Jumlah Bibit (Batang)</th>
            <th>Pelaksana</th>
            <th>Lokasi</th>
            <th>Keterangan</th>
            <th>X</th>
            <th>Y</th>
            <th>Jenis Bibit</th>
            <th>Jumlah Bibit (Batang)</th>
            <th>Lokasi</th>
            <th>Keterangan</th>
            <th>X</th>
            <th>Y</th>
        </tr>
    </thead>
    <tbody>
        @foreach($dataPenanaman as $index => $penanaman)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ \Carbon\Carbon::parse($penanaman->tanggal)->format('l, d-m-Y') }}</td>
            <td>{{ $penanaman->bibit->bibit }}</td>
            <td>{{ $penanaman->jumlah }}</td>
            <td>{{ $penanaman->pelaksana }}</td>
            <td>{{ $penanaman->lokasi }}</td>
            <td>{{ $penanaman->keterangan }}</td>
            <td></td>
            <td></td>
            <td>
                @if(isset($dataPembagian[$index]))
                    {{ $dataPembagian[$index]->bibit->bibit }}
                @endif
            </td>
            <td>
                @if(isset($dataPembagian[$index]))
                    {{ $dataPembagian[$index]->jumlah }}
                @endif
            </td>
            <td>
                @if(isset($dataPembagian[$index]))
                    {{ $dataPembagian[$index]->lokasi }}
                @endif
            </td>
            <td>
                @if(isset($dataPembagian[$index]))
                    {{ $dataPembagian[$index]->keterangan }}
                @endif
            </td>
            <td></td>
            <td></td>
        </tr>
        @endforeach
        @foreach($dataPembagian as $index => $pembagian)
        @if(!isset($dataPenanaman[$index]))
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>
