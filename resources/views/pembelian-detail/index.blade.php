@extends('layouts.main')
@section('content')
    <div class="orders">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2>Data Transaksi Pembelian</h2>
                        <table>
                            <tr>
                                <td style="font-weight: bold">Nama Supplier</td>
                                <td>&nbsp; : {{ $supplier->nama }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Nomor Telepon</td>
                                <td>&nbsp; : {{ $supplier->telepon }}</td>
                            </tr>
                            <tr>
                                <td style="font-weight: bold">Alamat Supplier</td>
                                <td>&nbsp; : {{ $supplier->alamat }}</td>
                            </tr>
                        </table>
                    </div>

                    <div class="card-body">
                        <form class="form-produk">
                            @csrf
                            <div class="form-group row">
                                <label for="kode_produk" class="col-lg-2">Kode Produk</label>
                                <div class="col-lg-4">
                                    <div class="input-group">
                                        <input type="hidden" name="id_pembelian" id="id_pembelian"
                                            value="{{ $id_pembelian }}">
                                        <input type="hidden" name="id_produk" id="id_produk">
                                        <input type="text" name="kode_produk" class="form-control" id="kode_produk" />
                                        <span class="input-group-btn">
                                            <button type="button" class="btn btn-info btn-flat" id="btn-tambah"
                                                data-toggle="modal" data-target="#modal-info">
                                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="table-stats order-table ov-h">
                            <table class="table table-bordered table-striped" id="myTable">
                                <thead>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama Produk</th>
                                    <th>Harga Beli</th>
                                    <th width="15%">Jumlah</th>
                                    <th>Sub Total</th>
                                    <th>Aksi</th>
                                </thead>
                                {{-- <tbody>
                                    @foreach ($produk as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kode_produk }}</td>
                                            <td>{{ $item->nama_produk }}</td>
                                            <td>{{ $item->harga_beli }}</td>
                                            <td>
                                                <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-check"></i>
                                                    Pilih</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody> --}}
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                            <th>Kode Produk</th>
                            <th>Nama Produk</th>
                            <th>Harga Beli</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            @foreach ($produk as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td><span class="badge badge-success">{{ $item->kode_produk }}</span></td>
                                    <td>{{ $item->nama_produk }}</td>
                                    <td>Rp. {{ number_format($item->harga_beli) }}</td>
                                    <td>
                                        <a href="#" class="btn btn-primary btn-xs"
                                            onclick="pilihProduk('{{ $item->id_produk }}', '{{ $item->kode_produk }}')"><i
                                                class="fa fa-check"></i>
                                            Pilih</a>
                                        {{-- <button class="btn btn-primary btn-xs"
                                            onclick="pilihProduk('{{ $item->id_produk }}', '{{ $item->kode_produk }}')"><i
                                                class="fa fa-check"></i>
                                            Pilih</button> --}}
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
    <script src="{{ asset('plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.8/dist/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function() {
            loaddata()
        });

        function loaddata(params) {
            $('#myTable').DataTable({
                serverside: true,
                processing: true,
                ajax: {
                    url: "{{ route('pembelian-detail.data', $id_pembelian) }}",
                },
                columns: [{
                        data: null,
                        "sortable": false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'kode_produk',
                        name: 'kode_produk'
                    },
                    {
                        data: 'nama_produk',
                        name: 'nama_produk'
                    },
                    {
                        data: 'harga_beli',
                        name: 'harga_beli'
                    },
                    {
                        data: 'jumlah',
                        name: 'jumlah'
                    },
                    {
                        data: 'subtotal',
                        name: 'subtotal'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false
                    },
                ]
            });

            $(document).on('input', '.quantity', function() {
                let id = $(this).data('id')

                let jumlah = parseInt($(this).val());

                if (jumlah < 1) {
                    $(this).val(1);
                    alert('Jumlah tidak boleh kurang dari 1');
                    return;
                }

                if (jumlah > 10000) {
                    $(this).val(10000);
                    alert('Jumlah tidak boleh lebih dari 10000');
                    return;
                }
                
                $.post(`{{ url('/pembelian-detail') }}/${id}`, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'PUT',
                        'jumlah': jumlah
                    })
                    .done(response => {
                        $('#myTable').DataTable().ajax.reload()
                    })
                    .fail(errors => {
                        alert('Tidak dapat menyimpan data');
                        return;
                    });
            });
        }

        function number(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        function pilihProduk(id, kode) {
            $('#id_produk').val(id);
            $('#kode_produk').val(kode);
            $('#modal-info').modal('hide');
            tambahProduk()
        }

        function tambahProduk() {
            $.post('{{ route('pembelian-detail.store') }}', $('.form-produk').serialize())
                .done(response => {
                    $('#kode_produk').focus();
                    $('#myTable').DataTable().ajax.reload()
                })
                .fail(errors => {
                    alert('Tidak dapat menyimpan data');
                    return;
                });
        }

        function deleteData(url) {
            if (confirm('Yakin ingin menghapus data terpilih?')) {
                $.post(url, {
                        '_token': $('[name=csrf-token]').attr('content'),
                        '_method': 'delete'
                    })
                    .done((response, status) => {
                        if (status = '200') {
                            setTimeout(() => {
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: response.text,
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((response) => {
                                    $('#myTable').DataTable().ajax.reload()
                                })
                            });
                        }
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        return;
                    });
            }
        }
    </script>
@endpush
