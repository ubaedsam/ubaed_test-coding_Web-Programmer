@extends('home')
@section('content')
    <div class="container-fluid">
        <!-- Title -->
		<div class="row heading-bg">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			    <h5 class="txt-dark">Daftar Produk</h5>
			</div>
			<!-- Breadcrumb -->
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
				    <li><a href="/dashboard">Dashboard</a></li>
					<li class="active"><span>Produk</span></li>
				</ol>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->

        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-right">
                            <div class="button-list">
                                <button type="button" class="btn btn-sm btn-primary btn-outline fancy-button btn-0" data-toggle="modal" data-target="#modalTambahProduk" title="Tambah"><i class="fa fa-plus fs-10" style="color: white"></i></button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                                <div class="table-responsive">
                                    <table id="table_produk" class="table mb-0" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Foto Produk</th>
                                                <th class="text-center">Nama Produk</th>
                                                <th class="text-center">Jenis Produk</th>
                                                <th class="text-center">Harga Produk</th>
                                                <th class="text-center">Lokasi</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                </div>	
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahProduk" tabindex="-1" role="dialog" aria-labelledby="modalTambahProdukLabel1">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h5 class="modal-title" id="modalTambahProdukLabel1">Tambah Data Produk</h5>
				</div>
                <form id="tambahProduk" action="{{ route('data.produk.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" class="form-control" id="nama_perusahaan" name="nama_perusahaan" value="{{ Auth::user()->name }}" placeholder="Masukan nama produk">
                        <div class="form-group">
                            <label for="foto" class="control-label mb-10">Foto Produk :</label>
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>
                        <div class="form-group">
                            <label for="nama_produk" class="control-label mb-10">Nama Produk :</label>
                            <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Masukan nama produk">
                        </div>
                        <div class="form-group">
                            <label for="jenis_produk" class="control-label mb-10">Jenis Produk :</label>
                            <select class="form-control" id="jenis_produk" name="jenis_produk">
                                <option value="">Pilih Jenis Produk</option>
                                <option value="makanan_ringan">MAKANAN RINGAN</option>
                                <option value="makanan_berat">MAKANAN BERAT</option>
                                <option value="makanan_daerah">MAKANAN DAERAH</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_produk" class="control-label mb-10">Deskripsi Produk :</label>
                            <input type="text" class="form-control" id="deskripsi_produk" name="deskripsi_produk" placeholder="Masukan deskripsi produk">
                        </div>
                        <div class="form-group">
                            <label for="harga" class="control-label mb-10">Harga Produk :</label>
                            <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukan harga produk per 1 pcs contoh : 600000">
                        </div>
                        <div class="form-group">
                            <label for="lokasi" class="control-label mb-10">Lokasi :</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Masukan lokasi">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" id="simpan-produk" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>

    <div class="modal fade" id="modalUbahProduk" tabindex="-1" role="dialog" aria-labelledby="modalUbahProdukLabel1">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h5 class="modal-title" id="modalUbahProdukLabel1">Ubah Data Produk</h5>
				</div>
                <form id="ubahProduk" action="{{ url('produk/prosesUbahProduk/') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="id_produk" id="editProdukId">
                        <div class="form-group">
                            <label for="foto" class="control-label mb-10">Foto Produk :</label>
                            <input type="file" class="form-control" id="edit_foto" name="foto">
                        </div>
                        <div class="form-group">
                            <label for="nama_produk" class="control-label mb-10">Nama Produk :</label>
                            <input type="text" class="form-control" id="editNamaProduk" name="nama_produk" placeholder="Masukan nama produk">
                        </div>
                        <div class="form-group">
                            <label for="jenis_produk" class="control-label mb-10">Jenis Produk :</label>
                            <select class="form-control" id="editJenisProduk" name="jenis_produk">
                                <option value="">Pilih Jenis Produk</option>
                                <option value="makanan_ringan">MAKANAN RINGAN</option>
                                <option value="makanan_berat">MAKANAN BERAT</option>
                                <option value="makanan_daerah">MAKANAN DAERAH</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="deskripsi_produk" class="control-label mb-10">Deskripsi Produk :</label>
                            <input type="text" class="form-control" id="edit_deskripsi_produk" name="deskripsi_produk" placeholder="Masukan deskripsi produk">
                        </div>
                        <div class="form-group">
                            <label for="harga" class="control-label mb-10">Harga Produk :</label>
                            <input type="number" class="form-control" id="editHarga" name="harga" placeholder="Masukan harga produk per 1 pcs contoh : 600000">
                        </div>
                        <div class="form-group">
                            <label for="lokasi" class="control-label mb-10">Lokasi :</label>
                            <input type="text" class="form-control" id="editLokasi" name="lokasi" placeholder="Masukan lokasi">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            <button type="submit" id="ubah-produk" class="btn btn-primary">Ubah</button>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        function formatRupiah(number) {
            if (typeof number !== 'number') {
                number = parseFloat(number);
            }
            return 'Rp ' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        $(document).ready(function() {
            $('#table_produk').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('data.produk') }}",
                columns: [
                    {data: 'id_produk', name: 'id_produk', render: function (data, type, row, meta) {
                        return `<p class="text-center" style="color: white;">${meta.row + meta.settings._iDisplayStart + 1}</p>`
                    }},
                    {data: 'foto', name: 'foto', render: function (data, type, row) {
                        const folderPath = '/dist/img/produk/';
                        return `<p class="text-center" style="color: white;"><img src="${folderPath}${row.foto}" alt="Foto Produk" style="max-width: 100px; max-height: 100px;"></p>`;
                    }},
                    {data: 'nama_produk', name: 'nama_produk', render: function (data, type, row) {
                        return `<p class="text-center" style="color: white;">${row.nama_produk}</p>`
                    }},
                    {data: 'jenis_produk', name: 'jenis_produk', render: function (data, type, row) {
                        if (row.jenis_produk === 'makanan_ringan') {
                            return `
                            <div class="text-center">
                                <span style="color: white; margin-right: 25px; font-weight: bold; text-transform: uppercase;" class="label label-info">MAKANAN RINGAN</span>
                            </div>`;
                        } else if(row.jenis_produk === 'makanan_berat') {
                            return `
                            <div class="text-center">
                                <span style="color: black; margin-right: 25px; font-weight: bold; text-transform: uppercase;" class="label label-warning">MAKANAN BERAT</span>
                            </div>`;
                        } else {
                            return `
                            <div class="text-center">
                                <span style="color: white; margin-right: 25px; font-weight: bold; text-transform: uppercase;" class="label label-primary">MAKANAN DAERAH</span>
                            <div>`;
                        }
                    }},
                    {data: 'harga', name: 'harga', render: function (data, type, row) {
                        return `<p class="text-center" style="color: white;">${formatRupiah(row.harga)} ( 1 Pcs )</p>`
                    }},
                    {data: 'lokasi', name: 'lokasi', render: function (data, type, row) {
                        return `<p class="text-center" style="color: white;">${row.lokasi}</p>`
                    }},
                    {data: null, name: 'action', orderable: false, searchable: false, render: function (data, type, row) {
                        return `
                            <div class="text-center">
                                <a href="#" class="edit-produk mr-25" title="Ubah" data-id="${row.id_produk}"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                <a href="#" onclick="deleteProduk(this)" title="Hapus" data-id="${row.id_produk}"> <i class="fa fa-close text-danger"></i> </a>
                            </div>
                        `;
                    }}
                ],
                createdRow: function (row, data, dataIndex) {
                    $(row).addClass('iteration-row');
                }
            });
        });

        // Proses tambah produk
        $('#tambahProduk').on('submit', function (e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.status == 'success') {
                        $('#modalTambahProduk').modal('hide');
                        $('#tambahProduk')[0].reset();
                        $('#table_produk').DataTable().ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong!',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        });

        // Proses ubah produk
        // ambil satu data produk untuk di ubah
        $(document).on('click', '.edit-produk', function(e) {
                e.preventDefault();
                var button = $(this);
                var produkId = button.data('id');
                var editUrl = "{{ url('/produk/ubahProduk') }}/" + produkId;

                $('#ubahProduk')[0].reset();

                $.ajax({
                        url: editUrl,
                        type: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                var produk = response.produk;

                                $('#editProdukId').val(produk.id_produk);
                                $('#editNamaProduk').val(produk.nama_produk);
                                $('#editJenisProduk').val(produk.jenis_produk);
                                $('#edit_deskripsi_produk').val(produk.deskripsi_produk);
                                $('#editHarga').val(produk.harga);
                                $('#editLokasi').val(produk.lokasi);

                                $('#modalUbahProduk').modal('show');
                            } else {
                                Swal.fire('Error', response.message, 'error');
                            }
                        },
                        error: function(xhr) {
                            Swal.fire('Error', 'Terjadi kesalahan saat mengambil data produk.', 'error');
                        }
                });
        });

        // ambil semua data produk yang diubah lalu simpan
        $('#ubahProduk').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);
            var url = $(this).attr('action');
            var idUpdate = $('#editProdukId').val();
            url = url + '/' + idUpdate;

            $.ajax({
                url: url,
                type: 'POST', // Gunakan POST dengan method spoofing untuk PUT
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-HTTP-Method-Override': 'PUT' // Spoofing method PUT
                },
                success: function(response) {
                    if (response.status == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                        $('#modalUbahProduk').modal('hide');
                        $('#table_produk').DataTable().ajax.reload();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong!',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        });

        // Proses menghapus data produk
        function deleteProduk(e){

            let id_produk = e.getAttribute('data-id');

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Apakah anda yakin?',
                text: "Ingin menghapus data produk ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Tidak, Batalkan',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed){

                        $.ajax({
                            type:'DELETE',
                            url:'{{url("/produk/prosesHapusProduk")}}/' +id_produk,
                            data:{
                                "_token": "{{ csrf_token() }}",
                            },
                            success:function(data) {
                                if (data.success){
                                    swalWithBootstrapButtons.fire(
                                        'Dihapus!',
                                        'Data Produk berhasil dihapus.',
                                        "success"
                                    );
                                    $("#"+id_produk+"").remove();
                                    $('#table_produk').DataTable().ajax.reload();
                                }

                            }
                        });

                    }

                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Dibatalkan!',
                        'Proses menghapus data produk dibatalkan',
                        'error'
                    );
                }
            });

            $(".swal2-confirm, .swal2-cancel").css("margin", "10px 10px");
        }

    </script>
@endpush