<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    {{-- Style --}}
    @stack('before-style')
    @include('includes.style')
    @stack('before-style')

</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

        {{-- Navbar --}}
        @include('includes.navbar')
        {{-- Sidebar --}}
        @include('includes.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>@yield('sub-judul')</h1>
                        </div>
                    </div>
                </div>
            </section>
            {{-- content --}}
            @yield('content')
        </div>
        @include('includes.footer')
    </div>
    {{-- script --}}
    @stack('before-script')
    @include('includes.script')
    @stack('after-script')

</body>

</html>
