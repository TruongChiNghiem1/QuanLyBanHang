<!DOCTYPE html>
<html lang="zxx">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Đại lý Linh Chi</title>
    @include('admin.partials.head')
</head>

<body class="crm_body_bg">
    @include('admin.partials.header')
    <section class="main_content dashboard_part large_header_bg">
        @include('admin.partials.headerTop')
        <div class="main_content_iner ">
            <div class="container-fluid p-0">
                {{-- error --}}
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <input type="hidden" value="{{ $error }}" id="error" />
                    @endforeach
                @endif
                @if (Session::get('success'))
                    <input type="hidden" value="{{ Session::get('success') }}" id="success" />
                @endif
                <div class="row justify-content-center">
                    @yield('content')
                </div>
            </div>
        </div>
        @include('admin.partials.footer')
    </section>

    </div>
    <div id="back-top" style="display: none;">
        <a title="Go to Top" href="#">
            <i class="ti-angle-up"></i>
        </a>
    </div>
    @include('admin.partials.script')
</body>

</html>
