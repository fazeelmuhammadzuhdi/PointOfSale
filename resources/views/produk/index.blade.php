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
                        <a href="{{ route('produk.create') }}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Tambah
                            Data</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Merk</th>
                                <th>Harga Beli</th>
                                <th>Harga Jual</th>
                                <th>Diskon</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($produk as $isi)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>
                                    <td><span class="badge badge-success">
                                            {{ $isi->kode_produk }}
                                        </span></td>
                                    <td>{{ $isi->nama_produk }}</td>
                                    <td>{{ $isi->kategori->nama_kategori }}</td>
                                    <td>{{ $isi->merk }}</td>
                                    <td>{{ $isi->harga_beli }}</td>
                                    <td>{{ $isi->harga_jual }}</td>
                                    <td>{{ $isi->diskon }}</td>
                                    <td>{{ $isi->stok }}</td>

                                    <td>
                                        <a href="{{ route('produk.edit', $isi->id_produk) }}"
                                            class="btn btn-success btn-sm">
                                            <i class="fa fa-edit"></i> Edit</a>
                                        <form action="{{ route('produk.destroy', $isi->id_produk) }}" method="POST"
                                            class="d-inline"
                                            onclick="return confirm('Apakah Anda Ingin Menghapus Data Ini')">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('after-script')
    <!-- alert -->
    @if (session('success') == true)
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endpush
