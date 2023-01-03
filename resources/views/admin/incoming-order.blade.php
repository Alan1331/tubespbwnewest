<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ url('dashboard') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <div class="col-md-12 mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Riwayat Pemesanan</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3><i class="fa fa-history"></i> Riwayat Pemesanan</h3>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                    <th>Jumlah Harga</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($pesanans as $pesanan)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $pesanan->tanggal }}</td>
                                    <td>
                                        <!-- 1 = belum, 2 = sudah, 3 = dikirim, 4 = selesai-->
                                        @if($pesanan->status == 1)
                                        Belum dibayar
                                        @else
                                        Sudah dibayar 
                                        @endif
                                    </td>
                                    <td>Rp. {{ number_format($pesanan->jumlah_harga+$pesanan->kode) }}</td>
                                    <td>
                                        <a href="{{ url('history') }}/{{ $pesanan->status }}" value="2" class="btn btn-primary"><i class="fa fa-info"></i> Konfirmasi Order</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>
