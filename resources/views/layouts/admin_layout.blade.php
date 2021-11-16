
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <meta name="robots" content="noindex,nofollow">
        <meta name="author" content="Barnox Developer">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        	@include('admin.includes.style')
    </head>
    <body class="hold-transition sidebar-mini layout-navbar-fixed">
        <div class="wrapper">
            @include('admin.includes.navbar')
            @include('admin.includes.sidebar')
            @yield('admin_content')
            @include('admin.includes.footer')
        </div>
        @include('admin.includes.script')
    </body>
</html>
