<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome to Aduls Store!') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 mb-5 mt-5">
                <img src="{{ asset('images/logo.png') }}" class="rounded mx-auto d-block" width="400" alt="">
            </div>
            @foreach($barangs as $barang)
            <div class="col-md-4 mb-5">
                <div class="card">
                    <img src="{{ asset('storage/storage/uploads/' .$barang->gambar_barang)}}" width ="50%" class="card-img-top">
                  <div class="card-body">
                    <h5 class="card-title">{{ $barang->nama_barang }}</h5>
                    <p class="card-text">
                        <strong>Harga :</strong> Rp. {{ number_format($barang->harga)}} <br>
                        <strong>Stok :</strong> {{ $barang->stok }} <br>
                        <hr>
                        <strong>Keterangan :</strong> <br>
                        {{ $barang->keterangan }} 
                    </p>
                    <a href="{{ url('pesan') }}/{{ $barang->id }}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Pesan</a>
                  </div>
                </div> 
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
