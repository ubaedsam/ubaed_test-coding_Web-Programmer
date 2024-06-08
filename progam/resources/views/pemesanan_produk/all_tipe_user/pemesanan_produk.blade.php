@extends('home')
@section('content')
    <div class="container-fluid">
        <!-- Title -->
		<div class="row heading-bg">
			<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
			    <h5 class="txt-dark">Daftar Pemesanan Produk</h5>
			</div>
			<!-- Breadcrumb -->
			<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
				<ol class="breadcrumb">
				    <li><a href="/dashboard">Dashboard</a></li>
					<li class="active"><span>Pemesanan Produk</span></li>
				</ol>
			</div>
			<!-- /Breadcrumb -->
		</div>
		<!-- /Title -->

        @if(Auth::user()->type == 'Merchant')
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default card-view">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                    <div class="table-responsive">
                                        <table id="table_pemesanan_produk_merchant" class="table mb-0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th class="text-center">Nama</th>
                                                    <th class="text-center">Nama Produk</th>
                                                    <th class="text-center">Jenis Produk</th>
                                                    <th class="text-center">Harga Produk</th>
                                                    <th class="text-center">Jumlah Pemesanan</th>
                                                    <th class="text-center">Total Pemesanan</th>
                                                    <th class="text-center">Status Pemesanan</th>
                                                    <th class="text-center">Tanggal Pengiriman</th>
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
        @else
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default card-view">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                    <div class="table-responsive">
                                        <table id="table_pemesanan_produk_officer" class="table mb-0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">No</th>
                                                    <th class="text-center">Nama</th>
                                                    <th class="text-center">Nama Produk</th>
                                                    <th class="text-center">Jenis Produk</th>
                                                    <th class="text-center">Harga Produk</th>
                                                    <th class="text-center">Jumlah Pemesanan</th>
                                                    <th class="text-center">Total Pemesanan</th>
                                                    <th class="text-center">Status Pemesanan</th>
                                                    <th class="text-center">Tanggal Pengiriman</th>
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
        @endif
    </div>

    <div class="modal fade bs-example-modal-lg" id="modalUbahPemesananProduk" tabindex="-1" role="dialog" aria-labelledby="modalUbahPemesananProduk">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h5 class="modal-title" id="modalUbahPemesananProduk">Detail Pemesanan Produk</h5>
				</div>
                <form id="ubahPemesananProduk" action="{{ url('pembelian/prosesUbahPemesananProdukOfficer/') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default card-view" style="margin-left: 2px; margin-right: 2px; margin-bottom: 20px;">
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body">
                                            <p style="color: white; text-align: center; margin-bottom: 10px;">Detail Pembeli</p>
                                            <div class="d-flex justify-content-between">
                                                <p id="namaPembeli" style="color: white;"></p>
                                                <p id="nomorTeleponPembeli" style="color: white;"></p>
                                            </div>
                                            <p id="alamatPembeli" style="color: white; margin-top: 10px;"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="panel panel-default card-view" style="margin-left: 2px; margin-right: 2px; margin-bottom: 20px;">
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body">
                                            <p style="color: white; text-align: center; margin-bottom: 10px;">Detail Pemesanan</p>
                                            <div style="display: flex; justify-content: center; align-items: center; margin-bottom: 30px;" id="fotoProduk"></div>
                                            <p style="text-align: center; color: white;" id="statusPemesanan"></p>
                                            <div class="d-flex justify-content-between" style="margin-top: 10px;">
                                                <p id="nomorTransaksiPemesanan" style="color: white;"></p>
                                                <p id="tanggalPengirimanPemesanan" style="color: white;"></p>
                                            </div>
                                            <div class="d-flex justify-content-between" style="margin-top: 10px;">
                                                <p id="namaProduk" style="color: white;"></p>
                                                <p style="color: white;">Jenis Produk : <span id="jenisProduk" style="text-transform: uppercase;"></span></p>
                                            </div>
                                            <div class="d-flex justify-content-between" style="margin-top: 10px;">
                                                <p id="hargaProduk" style="color: white;"></p>
                                                <p style="color: white;">Lokasi : <span id="lokasiProduk" style="text-transform: uppercase;"></span></p>
                                            </div>
                                            <p id="deskripsiProduk" style="color: white; margin-top: 20px;"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                            {{-- <button type="submit" id="ubah-pemesanan-produk" class="btn btn-primary">Ubah</button> --}}
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script>
        // Untuk Merchant
        function formatRupiah(number) {
            if (typeof number !== 'number') {
                number = parseFloat(number);
            }
            return 'Rp ' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

        function formatRupiah2(angka) {
            var rupiah = '';
            var angkarev = angka.toString().split('').reverse().join('');
            for (var i = 0; i < angkarev.length; i++)
                if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + '.';
            return 'Rp ' + rupiah.split('', rupiah.length - 1).reverse().join('');
        }

        $(document).ready(function() {
            $('#table_pemesanan_produk_merchant').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                searching: false,
                ajax: "{{ route('data.pemesanan_produk_merchant') }}",
                columns: [
                    {data: 'id_pemesanan_produk', name: 'id_pemesanan_produk', render: function (data, type, row, meta) {
                        return `<p class="text-center" style="color: white">${meta.row + meta.settings._iDisplayStart + 1}</p>`
                    }},
                    {data: 'name', name: 'name', render: function (data, type, row) {
                        return `<p class="text-center" style="color: white">${row.user.name}</p>`
                    }},
                    {data: 'nama_produk', name: 'nama_produk', render: function (data, type, row) {
                        return `<p class="text-center" style="color: white">${row.produk.nama_produk}</p>`
                    }},
                    {data: 'jenis_produk', name: 'jenis_produk', render: function (data, type, row) {
                        let displayText = '';
                        if (row.produk.jenis_produk === 'makanan_ringan') {
                            displayText = 'MAKANAN RINGAN';
                        } else if (row.produk.jenis_produk === 'makanan_berat') {
                            displayText = 'MAKANAN BERAT';
                        } else if (row.produk.jenis_produk === 'makanan_daerah') {
                            displayText = 'MAKANAN DAERAH';
                        }
                        return `<p class="text-center" style="color: white">${displayText}</p>`;
                    }},
                    {data: 'harga', name: 'harga', render: function (data, type, row) {
                        return `<p class="text-center" style="color: white">${formatRupiah(row.produk.harga)} ( 1 Pcs )</p>`
                    }},
                    {data: 'jumlah_produk', name: 'jumlah_produk', render: function (data, type, row) {
                        return `<p class="text-center" style="color: white">${row.jumlah_produk}</p>`
                    }},
                    {data: 'biaya', name: 'biaya', render: function (data, type, row) {
                        const biaya = row.jumlah_produk * row.produk.harga; // Menghitung biaya
                        return `<p class="text-center" style="color: white">${formatRupiah2(biaya)}</p>`;
                    }},
                    {data: 'status', name: 'status', render: function (data, type, row) {
                        if (row.status === 'waiting') {
                            return `
                            <div class="text-center">
                                <span style="color: black; font-weight: bold; text-transform: uppercase;" class="label label-warning">Waiting</span>
                            </div>`;
                        } else {
                            return `
                            <div class="text-center">
                            <span style="color: white; font-weight: bold; text-transform: uppercase;" class="label label-success">Approved</span>
                            <div>`;
                        }
                    }},
                    {data: 'tanggal_pengiriman', name: 'tanggal_pengiriman', render: function (data, type, row) {
                        return `<p class="text-center" style="color: white">${moment(row.tanggal_pengiriman).format('DD MMMM YYYY')}</p>`;
                    }},
                    {data: null, name: 'action', orderable: false, searchable: false, render: function (data, type, row) {
                        if (row.status === 'waiting') {
                            return `
                                <div style="display: flex; justify-content: space-between;">
                                    <a href="#" class="ubah-pemesanan" title="Detail Pemesanan Produk" data-id="${row.id_pemesanan_produk}">
                                        <i class="fa fa-eye text-inverse m-r-10"></i>
                                    </a>
                                    <a href="#" class="approve_pemesanan" title="Approve Pemesanan Produk" data-id="${row.id_pemesanan_produk}">
                                        <i class="fa fa-check text-success m-r-10"></i>
                                    </a>
                                </div>
                            `;
                        } else {
                            return `
                                <div style="display: flex; justify-content: center;">
                                    <a href="#" class="ubah-pemesanan" title="Detail Pemesanan Produk" data-id="${row.id_pemesanan_produk}">
                                        <i class="fa fa-eye text-inverse m-r-10"></i>
                                    </a>
                                </div>
                            `;
                        }
                    }}
                ],
                createdRow: function (row, data, dataIndex) {
                    $(row).addClass('iteration-row');
                }
            });
        });

        $(document).on('click', '.approve_pemesanan', function () {
            approve_pemesanan(this);
        });

        function approve_pemesanan(e){

            let id_pemesanan_produk = e.getAttribute('data-id');

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: 'Apakah anda yakin?',
                text: "Ingin approve data pemesanan produk ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Approve',
                cancelButtonText: 'Tidak, Batalkan',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    if (result.isConfirmed){

                        $.ajax({
                            type:'GET',
                            url:'{{url("/pembelian/approveMerchant")}}/' + id_pemesanan_produk,
                            data:{
                                "_token": "{{ csrf_token() }}",
                            },
                            success:function(data) {
                                if (data.success){
                                    swalWithBootstrapButtons.fire({
                                        title: 'Berhasil!',
                                        text: 'Data pemesanan produk ini berhasil di approve.',
                                        icon: 'success',
                                        timer: 2000,
                                        showConfirmButton: false  // Fix here
                                    });
                                    $('#table_pemesanan_produk_merchant').DataTable().ajax.reload();
                                }

                            }
                        });

                    }

                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Dibatalkan!',
                        'Proses approve pemesanan produk ini dibatalkan',
                        'error'
                    );
                }
            });

            $(".swal2-confirm, .swal2-cancel").css("margin", "10px 10px");
        }

        // Untuk Costumer
        $(document).ready(function() {
            $('#table_pemesanan_produk_officer').DataTable({
                responsive: true,
                processing: true,
                serverSide: true,
                searching: false,
                ajax: "{{ route('data.pemesanan_produk_officer') }}",
                columns: [
                    {data: 'id_pemesanan_produk', name: 'id_pemesanan_produk', render: function (data, type, row, meta) {
                        return `<p class="text-center" style="color: white">${meta.row + meta.settings._iDisplayStart + 1}</p>`
                    }},
                    {data: 'name', name: 'name', render: function (data, type, row) {
                        return `<p class="text-center" style="color: white">${row.user.name}</p>`
                    }},
                    {data: 'nama_produk', name: 'nama_produk', render: function (data, type, row) {
                        return `<p class="text-center" style="color: white">${row.produk.nama_produk}</p>`
                    }},
                    {data: 'jenis_produk', name: 'jenis_produk', render: function (data, type, row) {
                        let displayText = '';
                        if (row.produk.jenis_produk === 'makanan_ringan') {
                            displayText = 'MAKANAN RINGAN';
                        } else if (row.produk.jenis_produk === 'makanan_berat') {
                            displayText = 'MAKANAN BERAT';
                        } else if (row.produk.jenis_produk === 'makanan_daerah') {
                            displayText = 'MAKANAN DAERAH';
                        }
                        return `<p class="text-center" style="color: white">${displayText}</p>`;
                    }},
                    {data: 'harga', name: 'harga', render: function (data, type, row) {
                        return `<p class="text-center" style="color: white">${formatRupiah(row.produk.harga)} ( 1 Pcs )</p>`
                    }},
                    {data: 'jumlah_produk', name: 'jumlah_produk', render: function (data, type, row) {
                        return `<p class="text-center" style="color: white">${row.jumlah_produk}</p>`
                    }},
                    {data: 'biaya', name: 'biaya', render: function (data, type, row) {
                        const biaya = row.jumlah_produk * row.produk.harga; // Menghitung biaya
                        return `<p class="text-center" style="color: white">${formatRupiah2(biaya)}</p>`;
                    }},
                    {data: 'status', name: 'status', render: function (data, type, row) {
                        if (row.status === 'waiting') {
                            return `
                            <div class="text-center">
                                <span style="color: black; font-weight: bold; text-transform: uppercase;" class="label label-warning">Waiting</span>
                            </div>`;
                        } else {
                            return `
                            <div class="text-center">
                            <span style="color: white; font-weight: bold; text-transform: uppercase;" class="label label-success">Approved</span>
                            <div>`;
                        }
                    }},
                    {data: 'tanggal_pengiriman', name: 'tanggal_pengiriman', render: function (data, type, row) {
                        return `<p class="text-center" style="color: white">${moment(row.tanggal_pengiriman).format('DD MMMM YYYY')}</p>`;
                    }},
                    {data: null, name: 'action', orderable: false, searchable: false, render: function (data, type, row) {
                        return `
                            <div class="text-center">
                                <a href="#" class="ubah-pemesanan" title="Detail Pemesanan Produk" data-id="${row.id_pemesanan_produk}">
                                    <i class="fa fa-eye text-inverse m-r-10"></i>
                                </a>
                            </div>
                        `;
                    }}
                ],
                createdRow: function (row, data, dataIndex) {
                    $(row).addClass('iteration-row');
                }
            });
        });

        // Proses ubah pemesanan produk
        // ambil satu data pemesanan produk untuk di ubah
        $(document).on('click', '.ubah-pemesanan', function(e) {
                e.preventDefault();
                var button = $(this);
                var pemesananProdukId = button.data('id');
                var editUrl = "{{ url('/pembelian/ubahPemesananProdukOfficer') }}/" + pemesananProdukId;

                $('#ubahPemesananProduk')[0].reset();

                $.ajax({
                        url: editUrl,
                        type: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            if (response.status == 'success') {
                                var pemesanan_produk = response.pemesanan_produk;
                                var hargaProduk = response.hargaProduk;

                                // Informasi Detail Data Pemesanan dan Pembeli

                                // Data Pembeli
                                $('#namaPembeli').text('Nama : ' + pemesanan_produk.user.name);
                                $('#nomorTeleponPembeli').text('Nomor Handphone : ' + pemesanan_produk.user.nomor_telepon);
                                $('#alamatPembeli').text('Alamat : ' + pemesanan_produk.user.alamat);

                                // Data Pemesanan
                                $('#statusPemesanan').text('Status Pemesanan : ' + pemesanan_produk.status);
                                $('#nomorTransaksiPemesanan').text('ID Transaksi : ' + pemesanan_produk.id_pemesanan_produk);
                                $('#tanggalPengirimanPemesanan').text(`Tanggal Pengiriman : ${moment(pemesanan_produk.tanggal_pengiriman).format('DD MMMM YYYY')}`);
                                $('#fotoProduk').html(`<img class="img-responsive" style="height: 200px;" src="/dist/img/produk/${pemesanan_produk.produk.foto}">`);
                                $('#namaProduk').text('Nama Produk : ' + pemesanan_produk.produk.nama_produk);
                                $('#jenisProduk').text(pemesanan_produk.produk.jenis_produk);
                                $('#hargaProduk').text('Total Pemesanan : ' + hargaProduk);
                                $('#lokasiProduk').text(pemesanan_produk.produk.lokasi);
                                $('#deskripsiProduk').text('Deskripsi Produk : ' + pemesanan_produk.produk.nama_produk);

                                $('#modalUbahPemesananProduk').modal('show');
                            } else {
                                Swal.fire('Error', response.message, 'error');
                            }
                        },
                        error: function(xhr) {
                            Swal.fire('Error', 'Terjadi kesalahan saat mengambil data pemesanan produk.', 'error');
                        }
                });
        });
    </script>
@endpush