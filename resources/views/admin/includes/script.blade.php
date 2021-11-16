	<!-- jQuery -->
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
        integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="{{ url('backend/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
	$.widget.bridge('uibutton', $.ui.button)
	</script>
	<!-- Bootstrap 4 -->
	<script src="{{ url('backend/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
	@stack('dataTable')
	{{-- stack script-editable --}}
	@stack('delete-modal')
	{{-- stack textarea-ckeditor --}}
	@stack('textarea-ckeditor')
	{{-- stack editable --}}
	@stack('script-editable')
	{{-- stack script table --}}
	@stack('script-table')
	{{-- stack script form --}}
	@stack('script-form')
	{{-- moments --}}
	<script src="{{ url('backend/plugins/moment/moment.min.js')}}"></script>
	{{-- date range picker --}}
	<script src="{{ url('backend/plugins/daterangepicker/daterangepicker.js')}}"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="{{ url('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
	<!-- overlayScrollbars -->
	<script src="{{ url('backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
	<!-- AdminLTE App -->
	<script src="{{ url('backend/dist/js/adminlte.js')}}"></script>
	{{-- AOS library --}}
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<script>AOS.init();</script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	@stack('modal-create')
	{{-- stack script form bottom --}}
	@stack('script-form-bottom')
	{{-- stack script form bottom --}}
	@stack('script-dashboard-bottom')
	{{-- modal show detail --}}
	<script>
		jQuery(document).ready(function($) {
			$('#mymodal').on('show.bs.modal', function(e){
			let button = $(e.relatedTarget);
			let modal = $(this);
			modal.find('.modal-body').load(button.data("remote"));
			modal.find('.modal-title').html(button.data("title"));
			});
		});
	</script>

	<div class="modal" id="mymodal" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title"></h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<i class="fa fa-spinner fa-spin"></i>
				</div>
			</div>
		</div>
	</div>
	