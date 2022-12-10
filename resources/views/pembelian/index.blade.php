@extends('layouts.main')
@section('content')
    <div class="orders">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Daftar Pembelian</h4>
                        <button type="button" class="btn btn-success btn-sm" id="btn-tambah" data-toggle="modal"
                            data-target="#modal-info"><i class="fa fa-plus-circle"></i>
                            Transaksi Baru
                        </button>
                        @empty(!session('id_pembelian'))
                            <a href="{{ route('pembelian-detail.index') }}" class="btn btn-info btn-sm"><i
                                    class="fa fa-edit"></i> Transaksi Aktif</a>
                        @endempty
                    </div>

                    <div class="card-body">
                        <div class="table-stats order-table ov-h">
                            <table class="table table-bordered" id="myTable">
                                <thed>
                                    <tr>
                                        <th>No</th>
                                        <th width="20%">Tanggal</th>
                                        <th>Supplier</th>
                                        <th>Total Item</th>
                                        <th>Total Harga</th>
                                        <th>Diskon</th>
                                        <th>Total Bayar</th>
                                        <th>Action</th>
                                    </tr>
                                </thed>
                                <tbody>
                                    @foreach ($pembelian as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ tanggal_indonesia($item->created_at) }}</td>
                                            <td>{{ $item->supplier->nama ?? '-' }}</td>
                                            <td>{{ format_uang($item->total_item) }}</td>
                                            <td>{{ 'Rp. ' . format_uang($item->total_harga) }}</td>
                                            <td>{{ $item->diskon . '%' }}</td>
                                            <td>{{ format_uang($item->bayar) }}</td>
                                            <td>
                                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                                    data-target="#modal-detail"><i class="fa fa-eye"></i>
                                                    Detail
                                                </button>
                                                {{-- <a href="{{ route('pembelian.show', $item->id_pembelian) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fa fa-eye"></i> Detail</a> --}}
                                                <form action="#" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="fa fa-trash"></i> Hapus
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
        </div>
    </div>

    {{-- Modal Tambah Data --}}
    <div class="modal fade" id="modal-info">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Data Supplier</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <th>No</th>
                            <th>Nama Supplier</th>
                            <th>Telepon</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($supplier as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->telepon }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>
                                        <a href="{{ route('pembelian.create', $item->id_supplier) }}"
                                            class="btn btn-primary btn-xs"><i class="fa fa-check"></i>
                                            Pilih</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal View Data --}}
    <div class="modal fade" id="modal-detail">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Data Supplier</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-striped" style="width: 100%">
                        <thead>
                            <th width="5%">No</th>
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Sub Total</th>
                        </thead>
                        <tbody>
                            @foreach ($detail as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><span class="badge badge-success">{{ $item->produk->kode_produk }}</span>
                                    </td>
                                    <td>{{ $item->produk->nama_produk }}</td>
                                    <td>{{ 'Rp. ' . format_uang($item->harga_beli) }}</td>
                                    <td>{{ $item->jumlah }}</td>
                                    <td>{{ 'Rp. ' . format_uang($item->subtotal) }}</td>
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
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.8/dist/sweetalert2.all.min.js"></script>

    {{-- <script>
        $(document).ready(function() {
            loaddata()
        });

        function loaddata() {
            $('#myTable').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                ajax: {
                    url: '{{ route('pembelian.data') }}',
                },
                columns: [{
                        data: null,
                        "sortable": false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'supplier',
                        name: 'supplier'
                    },
                    {
                        data: 'total_item',
                        name: 'total_item'
                    },
                    {
                        data: 'total_harga',
                        name: 'total_harga'
                    },
                    {
                        data: 'diskon',
                        name: 'diskon'
                    },
                    {
                        data: 'bayar',
                        name: 'bayar'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false
                    },
                ]
            })
        }
    </script> --}}
@endpush
