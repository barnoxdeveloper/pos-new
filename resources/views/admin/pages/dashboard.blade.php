@extends('layouts.admin_layout')
@section('dashboard-open', 'menu-open')
@section('dashboard-a', 'active')
@section('title', 'Dashboard')
@section('admin_content')

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <h1 class="m-0">
                            Hai {{ Auth::user()->name }} 
                            @if(Auth::user()->password_change_at == NULL)
                            |
                            <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                Please Update Your Password!
                            </a>
                            @endif
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                {{-- row card --}}
                <div class="row">
                    <div class="col-lg-3 col-6" data-aos="fade-up" data-aos-delay="100">
                        <a href="{{ route('admin-user.index') }}" class="btn btn-block">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>{{ $user }}</h3>
                                    <p>User</p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <p class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></p>
                            </div>
                        </a>
                    </div>
                </div>

                {{-- calendar --}}
                {{-- <div class="row">
                    <section class="col-lg-12 connectedSortable">
                        <div class="card bg-gradient-success" data-aos="fade-up" data-aos-delay="900">
                            <div class="card-header border-0">
                                <h3 class="card-title">
                                    <i class="fa fa-calendar"></i> 
                                    Calendar
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <div id="calendar" style="width: 100%"></div>
                            </div>
                        </div>
                    </section>
                </div> --}}
            </div>
        </section>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="update-password-form" action="{{ route('admin-user.update', encrypt(Auth::user()->id)) }}" method="POST" enctype="multipart/form-data" id="update-password">
                        @csrf
                        @method('PUT')
                        <input type="hidden" readonly name="id" id="id">
                        <div class="form-group">
                            <label for="password">Password (min: 6 Characters)</label>
                            <input type="password" name="password" id="password" required="" minlength="6" class="form-control" autofocus placeholder="Password" value="{{ old('password') }}">
                            <span class="text-danger error-text password_error"></span>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" onclick="showPassword()" id="checkPassword">
                            <label for="checkPassword">Show Password</label>
                        </div>

                        <div class="form-group">
                            <p class="text-danger">Note: Setelah Update Password anda akan di minta login ulang!</p>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-block" id="tombol-simpan" value="create">
                                <i class="fa fa-paper-plane"></i> Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script-dashboard-bottom')
    <script src="{{ url('backend/dist/js/pages/dashboard.js') }}"></script>
    <script>
        function showPassword() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
@endpush