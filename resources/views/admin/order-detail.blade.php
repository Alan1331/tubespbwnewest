<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ url('history') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <div class="col-md-12 mt-2">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ url('history') }}">Riwayat Pemesanan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Detail Pemesanan</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3>Order to Check</h3>
                        <h5>Check the payment if it was successfully paid with nominal : <strong>Rp. {{ number_format($pesanan->kode+$pesanan->jumlah_harga) }}</strong></h5>
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-body">
                        <h3><i class="fa fa-shopping-cart"></i> Detail Pemesanan</h3>
                        @if(!empty($pesanan))
                        <p align="right">Tanggal Pesan : {{ $pesanan->tanggal }}</p>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Picture</th>
                                    <th>Product Name</th>
                                    <th>Unit(s)</th>
                                    <th>Price</th>
                                    <th>Total Price</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach($pesanan_details as $pesanan_detail)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        <img src="{{ url('uploads') }}/{{ $pesanan_detail->barang->gambar_barang }}" width="100" alt="...">
                                    </td>
                                    <td>{{ $pesanan_detail->barang->nama_barang }}</td>
                                    <td>{{ $pesanan_detail->jumlah }} Unit</td>
                                    <td align="right">Rp. {{ number_format($pesanan_detail->barang->harga) }}</td>
                                    <td align="right">Rp. {{ number_format($pesanan_detail->jumlah_harga) }}</td>
                                    
                                </tr>
                                @endforeach
    
                                <tr>
                                    <td colspan="5" align="right"><strong>Total Price :</strong></td>
                                    <td align="right"><strong>Rp. {{ number_format($pesanan->jumlah_harga) }}</strong></td>
                                    
                                </tr>
                                <tr>
                                    <td colspan="5" align="right"><strong>Unique Code :</strong></td>
                                    <td align="right"><strong>Rp. {{ number_format($pesanan->kode) }}</strong></td>
                                    
                                </tr>
                                 <tr>
                                    <td colspan="5" align="right"><strong>Total to be Paid :</strong></td>
                                    <td align="right"><strong>Rp. {{ number_format($pesanan->kode+$pesanan->jumlah_harga) }}</strong><br>
                                        <a href="{{ url('history') }}" class="btn btn-primary mt-2"><i class="fa fa-check"></i> Confirm Order</a>
                                    </td>
                                   
                                </tr>
                            </tbody>
                        </table>
                        @endif
    
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>