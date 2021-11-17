        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        {{-- cdn fontawesome --}}
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        {{-- stack dataTable-style --}}
        @stack('dataTable-style')
        {{-- stack select2-style --}}
        @stack('style-form')
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ url('backend/dist/css/adminlte.min.css')}}">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="{{ url('backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="{{ url('backend/plugins/daterangepicker/daterangepicker.css')}}">
        {{-- AOS css --}}
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <link rel="icon" type="image/png" href="{{ url('backend/login/point-of-sale.png') }}"/>
        <style>
            html {
                scroll-behavior: smooth;
            }
            hr {
                border: 1px solid #fff;
            }

            .new1 {
                border: 1px dashed #000;
            }

            .error {
                color: rgb(212, 52, 52);
            }
        </style>
    
    