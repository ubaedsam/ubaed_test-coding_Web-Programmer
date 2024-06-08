        @push('styles')
            <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        @endpush

            <div class="container-fluid">
				<div style="margin-top: 20px; margin-bottom: 20px;">
					<div class="text-center">
						<h2 class="txt-dark">Belanja Kuy</h2>
					</div>
					<div style="display: flex; justify-content: center; margin-top: 20px;">
						<div class="input-group" style="display: flex;">
							<input type="text" id="nama_produk" style="width: 500px;" name="nama_produk" class="form-control" placeholder="Masukan nama produk yang ingin di cari...">
						</div>
                        <div class="form-group" style="margin-right: 30px;">
                            <select class="form-control" id="jenis_produk" name="jenis_produk">
                                <option value="">Semua Jenis Produk</option>
                                <option value="makanan_ringan">MAKANAN RINGAN</option>
                                <option value="makanan_berat">MAKANAN BERAT</option>
                                <option value="makanan_daerah">MAKANAN DAERAH</option>
                            </select>
                        </div>
					</div>
				</div>

                <div id="DaftarDataProduk"></div>
                <div id="pagination" style="display: none; display: flex; justify-content: center; margin-top: 30px;"></div>
			</div>

            {{-- Box Modal Pemesanan Produk --}}
            <div class="modal fade" id="modalPemesanan" tabindex="-1" role="dialog" aria-labelledby="modalPemesananLabel1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h5 class="modal-title" id="modalPemesananLabel1">Pemesanan Produk</h5>
                        </div>
                        <form id="pemesananProduk" action="{{ route('data.pemesananProduk.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="panel panel-default card-view" style="margin-left: 2px; margin-right: 2px; margin-bottom: 30px;">
                                    <div class="panel-wrapper collapse in">
                                        <div class="panel-body">
                                            <div style="display: flex; justify-content: center; align-items: center; margin-bottom: 30px;" id="fotoProduk"></div>
                                            <div class="d-flex justify-content-between">
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
                                <input type="hidden" class="form-control" id="id_produk" name="id_produk">
                                <input type="hidden" class="form-control" id="id" name="id">
                                <input type="hidden" class="form-control" id="nama_perusahaan" name="nama_perusahaan">
                                <div class="form-group">
                                    <div style="display: flex; justify-content: space-between;">
                                        <label id="totalPemesanan" class="control-label" style="margin-bottom: 20px;">Total :</label>
                                        <label class="control-label" style="margin-bottom: 20px;">Jumlah Porsi : <span id="jumlahPemesanan"></span></label>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <button type="button" class="decrease btn btn-sm btn-danger"><i class="zmdi zmdi-minus"></i></button>
                                            <input type="text" name="jumlah_barang" id="jumlah_barang" class="form-control quantity-input" value="1" style="color: black" readonly>
                                        <button type="button" class="increase btn btn-sm btn-success"><i class="zmdi zmdi-plus"></i></button>
                                    </div>
                                    <div class="form-group" style="margin-top: 20px;">
                                        <label for="tanggal_pengiriman" class="control-label mb-10">Tanggal Pengiriman :</label>
                                        <input type="date" class="form-control" id="tanggal_pengiriman" name="tanggal_pengiriman" placeholder="Masukan tanggal pengiriman">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-default" style="color: black;" data-dismiss="modal">Tutup</button>
                                    <button type="submit" id="pemesanan-produk" class="btn btn-primary">Beli</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        @push('scripts')
            <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
            <script>
                $(document).ready(function () {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    var currentPage = 1; // Halaman saat ini
                    var dataPerPage = 10; // Jumlah data per halaman

                    // Memanggil fungsi getDataProduk() saat pertama kali akses halaman
                    getDataProduk(true);

                    $("#nama_produk").autocomplete({
                        source: function(request, response) {
                            getDataProduk();
                        }
                    });

                    $("#jenis_produk").change(function() {
                        getDataProduk();
                    });

                    function getDataProduk(isInitialLoad = false) {
                        var nama_produk = isInitialLoad ? '' : $('#nama_produk').val();
                        var jenis_produk = isInitialLoad ? '' : $('#jenis_produk').val();

                        $.ajax({
                            url: '{{ url("/getProduk/") }}',
                            type: 'post',
                            dataType: "json",
                            data: {
                                _token: '{{ csrf_token() }}',
                                nama_produk: nama_produk,
                                jenis_produk: jenis_produk,
                                page: currentPage
                            },
                            success: function(data) {
                                $('#DaftarDataProduk').empty();

                                if (data.data.length === 0) {
                                    $('#DaftarDataProduk').append('<p class="text-center">Tidak ada produk yang tersedia.</p>');
                                    $('#pagination').hide();
                                    return;
                                }

                                var dataDetailPertama = `
                                    <div class="row" style="margin-top: 20px; margin-left: 2px; margin-right: 2px;">
                                `;

                                $.each(data.data, function(index, item) {
                                    let pesanSekarangButton = `<button type="button" class="btn btn-warning btn-block btn-outline btn-anim pesan-sekarang" data-id="${item.id_produk}"><i class="fa fa-shopping-cart"></i><span class="btn-text">Pesan Sekarang</span></button>`;

                                    let jenisProdukText;

                                    if (item.jenis_produk === 'makanan_ringan') {
                                        jenisProdukText = 'MAKANAN RINGAN';
                                    } else if (item.jenis_produk === 'makanan_berat') {
                                        jenisProdukText = 'MAKANAN BERAT';
                                    } else if (item.jenis_produk === 'makanan_daerah') {
                                        jenisProdukText = 'MAKANAN DAERAH';
                                    }

                                    dataDetailPertama += `
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-6">
                                        <div class="panel panel-default card-view pa-0">
                                            <div class="panel-wrapper collapse in">
                                                <div class="panel-body pa-0">
                                                    <article class="col-item">
                                                        <div class="photo">
                                                            <img class="img-responsive" style="height: 200px;" src="/dist/img/produk/${item.foto}">
                                                        </div>
                                                        <div class="info">
                                                            <h6 class="text-center" style="text-transform: uppercase;">${jenisProdukText}</h6>
                                                            <p style="color: white; margin-top: 10px; margin-bottom: 5px;">${item.nama_produk}</p>
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div class="product-rating d-inline-block">
                                                                    <a href="javascript:void(0);" class="font-12 txt-success zmdi zmdi-star mr-1"></a>
                                                                    <a href="javascript:void(0);" class="font-12 txt-success zmdi zmdi-star mr-1"></a>
                                                                    <a href="javascript:void(0);" class="font-12 txt-success zmdi zmdi-star mr-1"></a>
                                                                    <a href="javascript:void(0);" class="font-12 txt-success zmdi zmdi-star mr-1"></a>
                                                                    <a href="javascript:void(0);" class="font-12 txt-success zmdi zmdi-star-outline mr-1"></a>
                                                                </div>
                                                            </div>
                                                            <span class="head-font block text-warning font-16" style="margin-top: 5px; margin-bottom: 10px;">${item.harga} ( 1 Pcs )</span>
                                                        </div>
                                                    </article>
                                                    ${pesanSekarangButton}
                                                </div>
                                            </div>    
                                        </div>    
                                    </div>
                                    `;
                                });

                                dataDetailPertama += `
                                    </div>
                                `;

                                $('#DaftarDataProduk').append(dataDetailPertama);
                                $('#DaftarDataProduk').show();

                                // Tampilkan pagination
                                $('#pagination').empty();
                                if (data.pagination.last_page > 1) {
                                    for (var i = 1; i <= data.pagination.last_page; i++) {
                                        var activeClass = (i === currentPage) ? 'btn btn-md btn-info' : 'btn btn-md';
                                        var activeColor = (i === currentPage) ? 'white' : 'black';
                                        $('#pagination').append('<button class="page-link ' + activeClass + '" style="color: ' + activeColor + ';" data-page="' + i + '">' + i + '</button>');
                                    }
                                    $('#pagination').show();

                                    $('.page-link').click(function() {
                                        currentPage = $(this).data('page');
                                        getDataProduk();
                                    });
                                } else {
                                    $('#pagination').hide();
                                }
                            }
                        });
                    }

                    $('.increase, .decrease').click(function() {
                        // let id = $(this).data('id');
                        let id = $('#id_produk').val();
                        let quantityInput = $('.quantity-input[data-id="' + id + '"]');
                        let currentQuantity = parseInt(quantityInput.val());
                        let newQuantity = $(this).hasClass('increase') ? currentQuantity + 1 : currentQuantity - 1;

                        if (newQuantity < 1) {
                            newQuantity = 1;
                        }

                        updateQuantity(id, newQuantity);
                    });

                    function updateQuantity(id, quantity) {
                        $.ajax({
                            url: '/update-quantity',
                            type: 'POST',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                id: id,
                                quantity: quantity
                            },
                            success: function(response) {
                                if (response.success) {
                                    $('#jumlahPemesanan').text('( ' + response.quantity + ' Pcs )');
                                    $('.quantity-input[data-id="' + id + '"]').val(response.quantity);
                                    $('#totalPemesanan[data-id="' + id + '"]').text('Total Harga : ' + response.newHarga);
                                } else {
                                    alert('Could not update quantity');
                                }
                            },
                            error: function() {
                                alert('An error occurred');
                            }
                        });
                    }
                });

                $(document).on('click', '.pesan-sekarang', function(e) {
                    e.preventDefault();

                    var button = $(this);
                    var id_produk = button.data('id');
                    var detailUrl = "{{ url('/checkProduk') }}/" + id_produk;

                    $('.quantity-input').removeAttr('data-id').val(1);

                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        url: detailUrl,
                        type: 'PUT',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        success: function(response) {
                            if(response.status === 'success') {
                                var produk = response.produk;
                                var user = response.user;
                                var hargaProduk = response.hargaProduk;

                                $('#id_produk').val(produk.id_produk);
                                $('#fotoProduk').html(`<img class="img-responsive" style="height: 200px;" src="/dist/img/produk/${produk.foto}">`);
                                $('#namaProduk').text('Nama Produk : ' + produk.nama_produk);
                                $('#deskripsiProduk').text('Deskripsi Produk : ' + produk.nama_produk);
                                $('#jenisProduk').text(produk.jenis_produk);
                                $('#lokasiProduk').text(produk.lokasi);
                                $('#hargaProduk').text('Harga : ' + hargaProduk + ' (1 Pcs)').attr('data-id', produk.id_produk);
                                $('#jumlahPemesanan').text('( 1 Pcs )');
                                $('#totalPemesanan').text('Total Harga : ' + hargaProduk).attr('data-id', produk.id_produk);
                                $('.decrease').attr('data-id', produk.id_produk);
                                $('.quantity-input').attr('data-id', produk.id_produk).val(1);
                                $('.increase').attr('data-id', produk.id_produk);
                                $('#id').val(user);
                                $('#nama_perusahaan').val(produk.nama_perusahaan);
                                $('#modalPemesanan').modal('show');
                            } else if(response.status === 'redirect') {
                                Swal.fire({
                                    icon: 'info',
                                    title: 'Info',
                                    text: 'Anda harus registrasi terlebih dahulu, jika ingin memesan',
                                });
                                $('#modalRegister').modal('show');
                            }
                        },
                        error: function(xhr) {
                            console.log('error');
                        }
                    });
                });

                $('#pemesananProduk').on('submit', function (e) {
                    e.preventDefault();

                    var token = $('meta[name="csrf-token"]').attr('content');
                    var data = $(this).serialize();
                    var url = $(this).attr('action');

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: data + '&_token=' + token,
                        success: function(response) {
                            if (response.status === 'success') {
                                $('#modalPemesanan').modal('hide');
                                $('#jumlah_barang').val('');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: response.message,
                                    showConfirmButton: true
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: response.message,
                                    timer: 3000,
                                    showConfirmButton: false
                                });
                            }
                        },
                        error: function(xhr) {
                            var errors = xhr.responseJSON.errors;
                            var errorMessage = '';
                            $.each(errors, function(key, value) {
                                errorMessage += value[0] + ' ';
                            });
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: errorMessage
                            });
                        }
                    })
                });
            </script>
        @endpush