    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fa fa-arrows-alt" aria-hidden="true"></i>
                </a>
            </li>
            <li class="nav-item">
                <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modal-logout">
                    <i class="fa fa-lg fa-sign-out"></i> Logout
                </button>
            </li>
        </ul>
    </nav>

    <div class="modal fade" id="modal-logout">
        <div class="modal-dialog modal-logout">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Logout</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Select "Logout" below if you are ready to end your current session.</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <form action="{{ route('logout') }}" method="POST" class="">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-lg fa-sign-out"></i> Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    