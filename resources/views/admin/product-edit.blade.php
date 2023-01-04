<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $barang->nama_barang }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <a href="{{ url('admin/dashboard') }}" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
            </div>
            <div class="col-md-12 mt-2">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $barang->nama_barang }}</li>
                  </ol>
                </nav>
            </div>
            <div class="col-md-12 mt-1">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <img src="{{ url('uploads') }}/{{ $barang->gambar_barang }}" class="rounded mx-auto d-block" width="100%" alt=""> 
                            </div>
                            <div class="col-md-6 mt-5">
                                <form method="post" action="{{ route('admin.update-barang') }}" >
                                    @csrf
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td>Harga</td>
                                                <td>:</td>
                                                <td>
                                                    <input type="text" name="harga" class="form-control" value="{{ number_format($barang->harga) }}" required autocomplete="harga">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Stok</td>
                                                <td>:</td>
                                                <td>
                                                    <input type="text" name="stok" class="form-control" value="{{ number_format($barang->stok) }}" required autocomplete="stok">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Keterangan</td>
                                                <td>:</td>
                                                <td>
                                                    <input type="text" name="keterangan" class="form-control" value="{{ $barang->keterangan }}" required autocomplete="keterangan">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <input type="hidden" name="id" value="{{ $barang->id }}">
                                    <button type="submit" class="btn btn-outline-primary mt-2">
                                        Save
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
