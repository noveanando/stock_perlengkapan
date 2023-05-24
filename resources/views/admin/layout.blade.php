<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <title>{{ $site_name }}</title>
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('packages/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/core.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/components.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/colors.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('packages/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/loading.css') }}">
    <style>
        @font-face {
            font-family: poppins;
            src: url({{ asset('packages/poppins/Poppins-Regular.ttf') }});
        }

        * {
            font-family: poppins;
        }

        .custom-scroll::-webkit-scrollbar {
            width: 4px;
        }

        .select2-container--default .select2-selection--single {
            height: 34px !important;
            border-color: #eaeaea !important;
        }

        label>span.required {
            color: red;
        }

        .has-error .select2-container--default .select2-selection--single {
            border-color: #a94442 !important;
        }

        .input-group-addon,
        .input-group-btn {
            vertical-align: top;
        }

        .parent-media {
            display: flex;
            align-items: center;
        }

        .profile-img {
            margin-right: 20px;
            border: 1px solid lightgray;
            width: 100px;
        }

        @media screen and (max-width: 768px) {
            .navbar-nav>li>a>i {
                color: #28343a;
            }
        }
    </style>
    @stack('styles')
</head>

<body class="navbar-top pace-done">
    @include('admin.components.header')
    <div class="page-container">
        <div class="page-content">
            @include('admin.components.sidebar', ['menus' => $menu])
            <div class="content-wrapper" id="target-html">
                {!! $content !!}
            </div>
        </div>
    </div>
    <div id="cover-spin"><img src="{{ asset('img/ellipsis.gif') }}" alt="" height="100"></div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/blockui.min.js') }}"></script>
    <script src="{{ asset('js/app-limitless.js') }}"></script>
    <script src="{{ asset('packages/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.js') }}"></script>
    <script>
        let siteName = '{{ $site_name }}';
        let siteMain = '{{ url('/') }}';
    </script>
    <script id="replace-script" src="{{ asset('js/main.js') }}?v={{ date('YmdHis') }}"></script>
    @stack('scripts')
</body>

</html>
