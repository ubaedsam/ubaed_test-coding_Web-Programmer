    {{-- Box Modal Login --}}
    <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="modalLoginLabel1">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h5 class="modal-title" id="modalLoginLabel1">Login</h5>
				</div>
                <form id="loginMobil" action="{{ route('login.custom') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="merek" class="control-label mb-10">Email :</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Masukan alamat email">
                        </div>
                        <div class="form-group">
                            <label for="model" class="control-label mb-10">Password :</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukan password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-default" style="color: black;" data-dismiss="modal">Tutup</button>
                            <button type="submit" id="login-mobil" class="btn btn-primary">Login</button>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>

	{{-- Box Modal Register --}}
	<div class="modal fade" id="modalRegister" tabindex="-1" role="dialog" aria-labelledby="modalRegisterLabel1">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h5 class="modal-title" id="modalRegisterLabel1">Register</h5>
				</div>
                <form id="registerMobil" action="{{ route('register.custom') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group" style="margin-right: 30px;">
                            <select class="form-control" id="type" name="type">
                                <option value="">Pilih Tipe Pendaftaran</option>
                                <option value="merchant">Merchant</option>
                                <option value="costumer">Costumer</option>
                            </select>
                        </div>
                        <div class="panel panel-default card-view" id="merchant" style="display: none;">
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="form-group">
                                        <label for="merek" class="control-label mb-10">Nama Perusahaan :</label>
                                        <input type="text" class="form-control" id="nama_perusahaan" name="nama_perusahaan" placeholder="Masukan nama perusahaan">
                                    </div>
                                    <div class="form-group">
                                        <label for="model" class="control-label mb-10">Alamat Perusahaan :</label>
                                        <input type="text" class="form-control" id="alamat_perusahaan" name="alamat_perusahaan" placeholder="Masukan alamat lengkap perusahaan">
                                    </div>
                                    <div class="form-group">
                                        <label for="model" class="control-label mb-10">Kontak Perusahaan :</label>
                                        <input type="text" class="form-control" id="nomor_telepon_perusahaan" name="nomor_telepon_perusahaan" placeholder="Masukan nomor kontak perusahaan">
                                    </div>
                                    <div class="form-group">
                                        <label for="model" class="control-label mb-10">Deskripsi Perusahaan :</label>
                                        <input type="text" class="form-control" id="deskripsi_perusahaan" name="deskripsi_perusahaan" placeholder="Masukan deskripsi perusahaan">
                                    </div>
                                    <div class="form-group">
                                        <label for="model" class="control-label mb-10">Email :</label>
                                        <input type="email" class="form-control" id="email_perusahaan" name="email_perusahaan" placeholder="Masukan alamat email perusahaan">
                                    </div>
                                    <div class="form-group">
                                        <label for="model" class="control-label mb-10">Password :</label>
                                        <input type="password" class="form-control" id="password_perusahaan" name="password_perusahaan" placeholder="Masukan password">
                                    </div>
								</div>
							</div>
						</div>
                        <div class="panel panel-default card-view" id="costumer" style="display: none;">
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="form-group">
                                        <label for="merek" class="control-label mb-10">Nama :</label>
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukan nama lengkap">
                                    </div>
                                    <div class="form-group">
                                        <label for="model" class="control-label mb-10">Alamat :</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan alamat lengkap">
                                    </div>
                                    <div class="form-group">
                                        <label for="model" class="control-label mb-10">Nomor Handphone :</label>
                                        <input type="text" class="form-control" id="nomor_telepon" name="nomor_telepon" placeholder="Masukan nomor handphone">
                                    </div>
                                    <div class="form-group">
                                        <label for="model" class="control-label mb-10">Email :</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Masukan alamat email">
                                    </div>
                                    <div class="form-group">
                                        <label for="model" class="control-label mb-10">Password :</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Masukan password">
                                    </div>
								</div>
							</div>
						</div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-default" style="color: black;" data-dismiss="modal">Tutup</button>
                            <button type="submit" id="register-mobil" class="btn btn-primary">Register</button>
                        </div>
                    </div>
                </form>
			</div>
		</div>
	</div>

    @push('scripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function() {
            $('#type').change(function() {
                var selectedType = $(this).val();
                if (selectedType === 'merchant') {
                    $('#merchant').show();
                    $('#costumer').hide();
                } else if (selectedType === 'costumer') {
                    $('#merchant').hide();
                    $('#costumer').show();
                }
            });
        });

        // Proses Login
        $('#loginMobil').on('submit', function (e) {
            e.preventDefault();

            var token = $('meta[name="csrf-token"]').attr('content');
            var data = $(this).serialize();
            var url = $(this).attr('action');

            $.ajax({
                url: url,
                type: 'POST',
                data: data + '&_token=' + token,
                success: function(response) {
                    if (response.success) {
                        // window.location.href = response.redirect_url;
                        window.location.reload()
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message
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

        // Proses Registrasi
        $('#registerMobil').on('submit', function (e) {
            e.preventDefault();

            var token = $('meta[name="csrf-token"]').attr('content');
            var data = $(this).serialize();
            var url = $(this).attr('action');

            $.ajax({
                url: url,
                type: 'POST',
                data: data + '&_token=' + token,
                success: function (response) {
                    if (response.status == 'success') {
                        $('#modalRegister').modal('hide');
                        $('#registerMobil')[0].reset();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: response.message,
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
                error: function(response) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong!',
                        timer: 3000,
                        showConfirmButton: false
                    });
                }
            })
        });
    </script>
                            
    @endpush