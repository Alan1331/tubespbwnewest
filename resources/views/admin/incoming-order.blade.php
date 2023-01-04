<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mt-3"><i class="fa fa-arrow-left"></i> Go Back</a>
            </div>
            <div class="col-md-12 mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Incoming Order</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3><i class="fa fa-history"></i> Incoming Order</h3>
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
                                            Unpaid
                                            @break
                                        @case('2')
                                            Paid
                                            @break
                                        @case('3')
                                            On Shipping
                                            @break
                                        @case('4')
                                            Order Done
                                            @break
                                        @default
                                            Undefined
                                            @break
                                        @endswitch
                                    </td>
                                    <td>Rp. {{ number_format($pesanan->jumlah_harga+$pesanan->kode) }}</td>
                                    <td>
                                        <a href="{{ url('admin/order-detail') }}/{{ $pesanan->id }}" value="2" class="btn btn-primary"><i class="fa fa-info"></i> Order Detail</a>
                                        
                                        @if($pesanan->status == 1)
                                        <a href="{{ url('admin/confirm-order/' . $pesanan->id) }}" class="btn btn-primary"><i class="fa fa-check"></i> Confirm Order</a>
                                        @elseif($pesanan->status == 2)
                                        <a href="{{ url('admin/shipping/' . $pesanan->id) }}" class="btn btn-primary"><i class="fa fa-check"></i> Shipping</a>
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
