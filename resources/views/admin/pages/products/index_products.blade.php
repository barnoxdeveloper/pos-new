@extends('layouts.admin_layout')
@section('products-open', 'menu-open')
@section('products-a', 'active')
@section('products-index', 'active')
@section('title', $title)
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
							<div class="col-6 text-left">{{ $title }}</div>
							<div class="col-6 text-right">
								<a href="javascript:void(0)" class="btn btn-sm btn-success" id="tombol-tambah">
									<i class="fa fa-plus"></i> 
									New Products
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
										<th>ID</th>
										<th>Name</th>
										<th>Price</th>
										<th>Descriptions</th>
										<th>Types</th>
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
					<form method="POST" enctype="multipart/form-data" id="form-tambah-edit">
						@csrf
						<input type="hidden" readonly name="type" id="type">
						<input type="hidden" readonly name="id" id="id">

						<div class="form-group">
							<label for="product_id">Product ID*</label>
							<input type="text" name="product_id" id="product_id" required="" class="form-control" autofocus placeholder="Product ID" value="{{ old('product_id') }}">
							<span class="text-danger error-text product_id_error"></span>
						</div>

						<div class="form-group">
							<label for="name">Name*</label>
							<input type="text" name="name" id="name" required="" class="form-control" autofocus placeholder="Name" value="{{ old('name') }}">
							<span class="text-danger error-text name_error"></span>
						</div>

						<div class="form-group">
							<label for="price">Price*</label>
							<input type="number" name="price" id="price" required="" class="form-control" autofocus placeholder="Price" value="{{ old('price') }}">
							<span class="text-danger error-text name_error"></span>
						</div>

						<div class="form-group">
							<label for="descriptions">Descriptions</label>
							<textarea name="descriptions" id="descriptions" class="form-control" autofocus placeholder="Descriptions" value="{{ old('descriptions') }}" rows="3"></textarea>
							<span class="text-danger error-text descriptions_error"></span>
						</div>
						
						<div class="form-group">
							<label for="types">Types*</label>
							<select name="types" class="form-control" required="" id="types">
								<option value="0" disabled selected>Pilih Type</option>
								<option value="MAKANAN">MAKANAN</option>
								<option value="MINUMAN">MINUMAN</option>
							</select>
							<span class="text-danger error-text types_error"></span>
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
					url : "{{ route('admin-products.index') }}",
					type : 'GET',
				},
				columns: [
					{ data: 'DT_RowIndex', name: 'DT_RowIndex', className: "text-center" },
					{ data: 'product_id', name: 'product_id', className: "text-center" },
					{ data: 'name', name: 'name', className: "text-center" },
					{ data: 'price', name: 'price', className: "text-center" },
					{ data: 'descriptions', name: 'descriptions', className: "text-center" },
					{ data: 'types', name: 'types', className: "text-center" },
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
			$('#type').val('tambah');
			$('#form-tambah-edit').trigger("reset");
			$('#modal-title').html("Create New Car (Tanda * Wajib Diisi!)");
			$('#tambah-edit-modal').modal('show');
			$('#label-simpan').html('Save');
		});

		if ($("#form-tambah-edit").length > 0) {
            $("#form-tambah-edit").validate({
                submitHandler: function (form) {
                    let actionType = $('#tombol-simpan').val();
                    let formData = new FormData(document.getElementById('form-tambah-edit'));
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Do you want to save data!",
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
                                type: "POST",
                                url: "{{ route('admin-products.store') }}",
                                data: formData,
                                dataType: 'json',
                                processData: false,
                                contentType: false,
                                beforeSend:function(){
                                    $(document).find('span.error-text').text('');
                                },
                                success: function (data) {
                                    if (data.status == 0) {
                                        $.each(data.error, function(prefix, val) {
                                            $('span.'+prefix+'_error').text(val[0]);
                                        });
                                    } else {
                                        // $('#tombol-simpan').html('Saving..');
                                        $('#tombol-simpan-icon').addClass('fa fa-paper-plane');
                                        $('#form-tambah-edit').trigger("reset");
                                        $('#tambah-edit-modal').modal('hide');
                                        $('#example1').DataTable().ajax.reload();
                                        
                                        Swal.fire(
                                            'Saved!',
                                            'Your Data has been Saved!',
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
			$('#type').val('edit');
			$('#form_status').attr("style", "display: auto;");
			$.get('admin-products/' + data_id + '/edit', function (data) {
				$('#modal-title').html("Edit Products (Tanda * Wajib Diisi!)");
				$('#tombol-simpan').val("edit-post");
				$('#tambah-edit-modal').modal('show');
				$('#label-simpan').html('Save');
				
				//set value masing-masing id berdasarkan data yg diperoleh dari ajax get request diatas               
				$('#id').val(data.id);
				$('#product_id').val(data.product_id);
				$('#name').val(data.name);
				$('#price').val(data.price);
				$('#descriptions').val(data.descriptions);
				$('#types').val(data.types);
				$('#status').val(data.status);
			});
		});

		// method delete
		$(document).on('click', '.delete', function () {
			dataId = $(this).attr('id');
			$('#konfirmasi-modal').modal('show');
		});

		$('#tombol-hapus').click(function () {
			$.ajax({
				url: "admin-products/" + dataId,
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
	</script>

@endpush
