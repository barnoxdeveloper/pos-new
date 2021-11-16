@extends('layouts.admin_layout')
@section('user-open', 'menu-open')
@section('user-a', 'active')
@section('user-index', 'active')
@section('title', 'Data User')
@section('admin_content')

	<div class="content-wrapper">
		<section class="content-header">
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-6">
						<h1>{{ $title }}</h1>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<ol class="breadcrumb">
							<li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Dashboard</a></li>
							<li class="breadcrumb-item active">{{ $title }}</li>
						</ol>
					</div>
				</div>
			</div>
		</section>
		<section class="content">
			<div class="container-fluid p-3">
				<div class="card" data-aos="fade-up">
					<div class="card-header">
						<div class="row">
							<div class="col-6 text-left"><div class="col-6"></div>{{ $title }}</div>
							<div class="col-6 text-right">
								<a href="javascript:void(0)" class="btn btn-sm btn-success" id="tombol-tambah">
									<i class="fa fa-plus"></i> 
									New User
								</a>
							</div>
						</div>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped w-100">
								<thead>
									<tr class="text-center">
										<th>#</th>
										<th>Name</th>
										<th>Username</th>
										<th>Email</th>
										<th>Roles</th>
										<th>Status</th>
										<th>Actions</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>

	{{-- modal create --}}
	<div class="modal fade" id="tambah-edit-modal">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="modal-title"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="" id="form-tambah-edit">
						@csrf
						<input type="hidden" readonly name="type" id="type" value="">
						<input type="hidden" readonly name="id" id="id">
						<div class="form-group">
							<label for="name">Name*</label>
							<input type="text" name="name" id="name" required="" class="form-control" autofocus placeholder="Name" value="{{ old('name') }}">
							<span class="text-danger error-text name_error"></span>
						</div>
						<div class="form-group">
							<label for="username">Username*</label>
							<input type="text" name="username" id="username" minlength="6" required="" class="form-control" placeholder="Username" value="{{ old('username') }}">
							<span class="text-danger error-text username_error"></span>
						</div>
						<div class="form-group">
							<label for="email">Email*</label>
							<input type="email" name="email" id="email" required="" class="form-control" placeholder="Email" value="{{ old('email') }}">
							<span class="text-danger error-text email_error"></span>
						</div>
						<div class="form-group">
							<label for="password">Password (min : 6 Character)*</label>
							<input type="password" name="password" id="password" class="form-control" placeholder="Password" value="{{ old('password') }}">
							<span class="text-danger error-text password_error"></span>
							<div style="display: none;" id="checkbox_password">
								<input type="checkbox" value="ACTIVE" id="change_password"> Change Password
							</div>
						</div>
						<div class="form-group">
							<label for="roles">Roles*</label>
							<select name="roles" class="form-control" required="" id="roles">
								<option value="0" selected disabled>Select Roles</option>
								<option value="ADMINISTRATOR">ADMINISTRATOR</option>
								<option value="KASIR">KASIR</option>
							</select>
							<span class="text-danger error-text roles_error"></span>
						</div>
						<div class="form-group" style="display: none;" id="form_status">
							<label for="status">Status*</label>
							<select name="status" class="form-control" required="" id="status">
								<option value="NON-ACTIVE">NON-ACTIVE</option>
								<option value="ACTIVE">ACTIVE</option>
							</select>
							<span class="text-danger error-text status_error"></span>
						</div>
						<div class="form-group text-center">
							<button type="submit" class="btn btn-primary btn-block" id="tombol-simpan" value="create">
								<i class="fa fa-paper-plane" id="tombol-simpan-icon"></i>
                                <label id="label-simpan"></label>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- MODAL DELETE-->
	<div class="modal fade" tabindex="-1" role="dialog" id="konfirmasi-modal" data-backdrop="false">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Delete Data?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p><b>Data yang telah dihapus tidak akan bisa di kembalikan lagi!</b></p>
				</div>
				<div class="modal-footer bg-whitesmoke br">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-danger" name="tombol-hapus" id="tombol-hapus">Delete</button>
				</div>
			</div>
		</div>
	</div>
	<!-- AKHIR MODAL -->
@endsection

@push('dataTable-style')
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endpush

@push('dataTable')
	<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#example1').DataTable({
				processing : true,
				serverSide : true,
				ordering: true,
				ajax : {
					url : "{{ route('admin-user.index') }}",
					type : 'GET',
				},
				columns: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex', className: "text-center" },
					{ data: 'name', name: 'name', className: "text-center" },
					{ data: 'username', name: 'username', className: "text-center" },
					{ data: 'email', name: 'email', className: "text-center" },
					{ data: 'roles', name: 'roles', className: "text-center" },
					{ data: 'status', name: 'status', className: "text-center" },
					{ data: 'action', name: 'action', className: "text-center" },
				],
			});
		});
	</script>
@endpush

@push('modal-create')
	<script>
		// method create
		$(document).ready(function () {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		});

		$('#tombol-tambah').click(function () {
			$('#button-simpan').val("create-post");
			$('#id').val('');
			$('#form-tambah-edit').trigger("reset");
			$('#modal-title').html("Create New User (Tanda * Wajib Diisi!)");
			$('#tambah-edit-modal').modal('show');
			$('#checkbox_password').attr("style", "display: none;");
			$('#password').removeAttr("disabled", "disabled");
			$('#password').attr("minlength", "6");
			$('#password').addClass("required");
			$('#type').val('tambah');
			$('#label-simpan').html('Save');
		});

		if ($("#form-tambah-edit").length > 0) {
			$("#form-tambah-edit").validate({
				submitHandler: function (form) {
					let actionType = $('#tombol-simpan').val();
					Swal.fire({
						title: 'Are you sure?',
						icon: 'info',
						showCancelButton: true,
						confirmButtonColor: '#3085d6',
						cancelButtonColor: '#d33',
						confirmButtonText: 'Yes, Save it!'
						}).then((result) => {
							if (result.isConfirmed) {
								$('#label-simpan').html('Saving. . .');
                                $('#tombol-simpan-icon').removeClass('fa fa-paper-plane');
                                $('#tombol-simpan-icon').addClass('fa fa-spinner');
								$.ajax({
								data: $('#form-tambah-edit').serialize(),
								url: "{{ route('admin-user.store') }}",
								type: "POST",
								dataType: 'json',
								beforeSend:function(){
									$(document).find('span.error-text').text('');
								},
								success: function (data) {
									if (data.status == 0) {
										$.each(data.error, function(prefix, val) {
											$('span.'+prefix+'_error').text(val[0]);
										});
									} else {
										$('#tombol-simpan').html('Sending..');
										$('#form-tambah-edit').trigger("reset");
										$('#tambah-edit-modal').modal('hide');
										$('#tombol-simpan').html('Simpan');
										$('#example1').DataTable().ajax.reload();
										Swal.fire(
											'Saved!',
											'Your Data has been Saved.',
											'success'
										);
									}
								},
								error: function (data) {
									console.log('Error:', data);
									$('#label-simpan').html('Save');
								}
							});
						}
					});
				}
			});
		}

		// method edit data
		$('body').on('click', '.edit-post', function () {
			let data_id = $(this).data('id');
			$('#form_status').attr("style", "display: auto;");
			$('#checkbox_password').attr("style", "display: auto;");
			$('#password').attr("disabled", "disabled");
			$('#type').val('edit');
			$.get('admin-user/' + data_id + '/edit', function (data) {
				$('#modal-title').html("Edit User (Tanda * Wajib Diisi!)");
				$('#tombol-simpan').val("edit-post");
				$('#tambah-edit-modal').modal('show');
				$('#label-simpan').html('Save');
				
				// set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
				$('#btn').val("button_update");
				$('#id').val(data.id);
				$('#name').val(data.name);
				$('#username').val(data.username);
				$('#email').val(data.email);
				$('#roles').val(data.roles);
				$('#status').val(data.status);
			})
		});

		// method delete
		$(document).on('click', '.delete', function () {
			dataId = $(this).attr('id');
			$('#konfirmasi-modal').modal('show');
		});
		$('#tombol-hapus').click(function () {
			$.ajax({
				url: "admin-user/" + dataId,
				type: 'delete',
				beforeSend: function () {
					$('#tombol-hapus').text('Deleting');
				},
				success: function (data) { //jika sukses
					setTimeout(function () {
						$('#konfirmasi-modal').modal('hide');
						let oTable = $('#example1').dataTable();
						Swal.fire(
							'Deleted!',
							'Your Data has been Deleted.',
							'success'
						);
						$('#example1').DataTable().ajax.reload();
					});
				}
			})
		});

		$('#change_password').click(function() {
			if( $(this).is(':checked')) {
				$('#password').attr('disabled', false);
				$('#password').attr('required', true);
				$('#password').attr("minlength", "6");
			} else {
				$('#password').attr('disabled', true);
				$('#password').attr('required', false);
				$('#password').removeAttr("minlength", "6");
			}
		});
	</script>

@endpush
