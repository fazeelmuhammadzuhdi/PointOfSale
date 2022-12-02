@extends('layouts.main')
@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Kategori</h1>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('kategori.update', $item->id_kategori) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" name="nama_kategori" placeholder="Inputkan Nama" class="form-control"
                            autofocus value="{{ $item->nama_kategori }}">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">
                        Update
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
