@extends('layouts.main')
@section('content')
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <h1 class="card-title" style="font-weight: bold; font-size: 18px">KATEGORI</h1>
        </div>


        <div class="card-body">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <a href="{{ route('kategori.create') }}" class="btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-plus fa-sm text-white"></i> Tambah Kategori
                </a>
            </div>
            @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <table class="table table-striped table-bordered" id="table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Nama Kategori</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($item as $items)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $items->nama_kategori }}</td>

                                        <td>
                                            <a href="{{ route('kategori.edit', $items->id_kategori) }}"
                                                class="btn btn-info">
                                                <i class="fa fa-pencil-alt"> Edit</i>
                                            </a>
                                            <form action="{{ route('kategori.destroy', $items->id_kategori) }}"
                                                method="POST" class="d-inline"
                                                onclick="return confirm('Apakah Anda Ingin Menghapus Data Ini')">
                                                @csrf
                                                @method('delete')
                                                <button class="btn btn-danger">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            Data Kosong
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection
