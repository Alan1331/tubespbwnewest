<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Add Product
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
                    <li class="breadcrumb-item active" aria-current="page">Add Product</li>
                  </ol>
                </nav>
            </div>
            <div class="col-md-12 mt-1">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6 mt-5">
                                <form method="post" action="{{ route('admin.update-barang') }}" >
                                    @csrf
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td>Gambar Barang</td>
                                                <td>:</td>
                                                <td>
                                                    <input type="file" name="gambar" class="form-control" required autocomplete="gambar">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Nama Barang</td>
                                                <td>:</td>
                                                <td>
                                                    <input type="text" name="nama_barang" class="form-control" required autocomplete="nama_barang">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Harga</td>
                                                <td>:</td>
                                                <td>
                                                    <input type="text" name="harga" class="form-control" required autocomplete="harga">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Stok</td>
                                                <td>:</td>
                                                <td>
                                                    <input type="text" name="stok" class="form-control" required autocomplete="stok">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Keterangan</td>
                                                <td>:</td>
                                                <td>
                                                    <input type="text" name="keterangan" class="form-control" required autocomplete="keterangan">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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
