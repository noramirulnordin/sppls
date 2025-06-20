<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>
        @yield('title', 'Dashboard') | SISTEM PENGURUSAN PEMBALAKAN & LIGA SEPAKAT
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/logo.png">

    <!-- third party css -->
    <link href="/assets/css/vendor/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- third party css end -->

    <!-- App css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
    <link href="/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />

    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" />

    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5rem 1rem;
            margin: 0 0.1rem;
            border-radius: 0.25rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background-color: #6169D0;
            color: white;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #6169D0;
            color: white;
        }

        .side-nav-link.active,
        .side-nav-link:active,
        .side-nav-link.selected {
            background: #9a8c98;
            /* Highlight color */
            color: #fff !important;
            /* Bright text */
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(74, 78, 105, 0.07);
            margin-left: 16px;
            margin-right: 16px;
        }

        body[data-leftbar-compact-mode="condensed"] .side-nav-link.active,
        body[data-leftbar-compact-mode="condensed"] .side-nav-link:active,
        body[data-leftbar-compact-mode="condensed"] .side-nav-link.selected {
            margin-left: 0;
            margin-right: 0;
        }


        .side-nav-link.active i,
        .side-nav-link:active i,
        .side-nav-link.selected i {
            color: #fff !important;
        }
    </style>

    @yield('styles')


</head>

<body class="loading"
    data-layout-config='{"leftSideBarTheme":"dark","layoutBoxed":false, "leftSidebarCondensed":false, "leftSidebarScrollable":false,"darkMode":false, "showRightSidebarOnStart": false}'>
    <!-- Begin page -->
    <div class="wrapper">
        @include('layouts.left-sidebar')

        <div class="content-page">
            <div class="content">
                @include('layouts.topbar')

                @yield('content')

            </div>

            <!-- Footer Start -->
            @include('layouts.footer')

        </div>

    </div>



    <script src="/assets/js/vendor.min.js"></script>
    <script src="/assets/js/app.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berjaya',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Ralat',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        @endif
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Ralat',
                text: '{{ $errors->first() }}',
                confirmButtonText: 'OK'
            });
        @endif
    </script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    @yield('scripts')


</body>

</html>
