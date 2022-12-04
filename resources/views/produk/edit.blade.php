@extends('layouts.main')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <h5>Data Buku</h5>
                    </div>
                    <div class="float-right">
                        <a href="{{ route('produk.index') }}" class="btn btn-warning btn-sm"><i class="fa fa-backward"></i>
                            Kembali</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('produk.update', $produk->id_produk) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                                {{-- <div class="form-group">
                                    <label for="">Kode</label>
                                    <input type="text" name="" class="form-control" placeholder="">
                                </div> --}}
                                <div class="form-group">
                                    <label for="">Nama Produk</label>
                                    <input type="text" name="nama_produk" id="nama_produk" class="form-control"
                                        placeholder="Inputkan Nama Produk" required autofocus
                                        value="{{ $produk->nama_produk }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Kategori</label>
                                    <select name="id_kategori" required class="form-control">
                                        {{-- <option value="{{ $kategori->id_kategori }}">Jangan DiUbah</option> --}}
                                        @foreach ($kategori as $kategoris)
                                            <option value="{{ $kategoris->id_kategori }}">
                                                {{ $kategoris->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Merk</label>
                                    <input type="text" name="merk" id="merk" class="form-control"
                                        placeholder="Inputkan Merk" required value="{{ $produk->merk }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Diskon</label>
                                    <input type="number" name="diskon" id="diskon" class="form-control"
                                        placeholder="Inputkan Diskon" value="{{ $produk->diskon }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Harga Beli</label>
                                    <input type="number" name="harga_beli" class="form-control"
                                        placeholder="Inputkan Harga Beli" required value="{{ $produk->harga_beli }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Harga Jual</label>
                                    <input type="number" name="harga_jual" id="harga_jual" class="form-control"
                                        placeholder="Inputkan Harga Jual" required value="{{ $produk->harga_jual }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Stok</label>
                                    <input type="number" name="stok" class="form-control" placeholder="Inputkan Stok"
                                        required value="{{ $produk->stok }}">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
