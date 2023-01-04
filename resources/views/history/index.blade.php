<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('dashboard') }}" class="btn btn-primary mt-3"><i class="fa fa-arrow-left"></i> Go Back</a>
            </div>
            <div class="col-md-12 mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">My Order</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3><i class="fa fa-history"></i> My Order</h3>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total Price</th>
                                    <th>Action</th>
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
                                        @switch($pesanan->status)
                                        @case('1')
                                            Belum Dibayar
                                            @break
                                        @case('2')
                                            Sudah Dibayar
                                            @break
                                        @case('3')
                                            Sedang Dikirim
                                            @break
                                        @case('4')
                                            Selesai
                                            @break
                                        @default
                                            Undefined
                                            @break
                                        @endswitch
                                    </td>
                                    <td>Rp. {{ number_format($pesanan->jumlah_harga+$pesanan->kode) }}</td>
                                    <td>
                                        <a href="{{ url('history') }}/{{ $pesanan->id }}" class="btn btn-primary"><i class="fa fa-info"></i> Detail</a>
                                        @if($pesanan->status == 3)
                                        <!-- Make Status to 4 -->
                                        <a href="{{ url('history/selesai') }}/{{ $pesanan->id }}" class="btn btn-primary"><i class="fa fa-check"></i> Selesai</a>
                                        @endif
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
