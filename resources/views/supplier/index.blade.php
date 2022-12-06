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
                        {{-- <a href="{{ route('produk.create') }}" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Tambah
                            Data</a> --}}
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-hover" id="myTable">
                        <thead>
                            <tr>
                                <th>Nama Supplier</th>
                                <th>Alamat</th>
                                <th>No Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                    </table>
                    <button type="button" class="btn btn-info" id="btn-tambah" data-toggle="modal"
                        data-target="#modal-info">
                        Tambah
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal-info">
        <div class="modal-dialog">
            <div class="modal-content bg-info">
                <div class="modal-header">
                    <h4 class="modal-title">Info Modal</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('supplier.store') }}" method="POST" id="forms">
                        @csrf
                        <div class="form-group">
                            <label for="nama">Nama Supplier</label>
                            <input type="text" class="form-control" name="nama" id="nama"
                                placeholder="Inputkan Nama Supplier">
                            <input type="text" hidden class="form-control" name="id" id="id"
                                placeholder="Inputkan Nama Supplier">
                        </div>

                        <div class="form-group">
                            <label for="telepon">No Telpon</label>
                            <input type="text" class="form-control" onkeypress="return number(event)" name="telepon"
                                id="telepon" placeholder="Inputkan No Telepon">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" id="alamat" rows="5" class="form-control" placeholder="Inputkan Alamat"></textarea>
                        </div>

                        <div class="modal-footer justify-content-between">
                            <button type="button" name="batal" id="btn-tutup" class="btn btn-outline-light"
                                data-dismiss="modal">Close</button>
                            <button type="submit" id="simpan" class="btn btn-outline-light">Save </button>
                        </div>
                    </form>
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
                    url: "{{ route('supplier.index') }}"
                },
                columns: [{
                        data: 'nama',
                        name: 'nama'
                    },
                    {
                        data: 'telepon',
                        name: 'telepon'
                    },
                    {
                        data: 'alamat',
                        name: 'alamat'
                    },
                    {
                        data: 'aksi',
                        name: 'aksi',
                        orderable: false
                    },
                ]
            })
        }

        function number(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

        $(document).on('submit', 'form', function(event) {
            event.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                typeData: "JSON",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    $('#btn-tutup').click()
                    $('#myTable').DataTable().ajax.reload()
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: response.text,
                        showConfirmButton: false,
                        timer: 1500
                    })
                },
                error: function(xhr) {
                    toastr.error(xhr.responseJSON.text, 'Gagal!')
                }
            });
        })
        //EDIT
        $(document).on('click', '.edit', function(data) {

            $('#btn-tambah').click()

        })
    </script>
@endpush
