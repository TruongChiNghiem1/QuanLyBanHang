<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from storage.googleapis.com/theme-vessel-items/checking-sites/logdy-html/HTML/main/login-43.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Jan 2023 01:59:11 GMT -->

<head>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                        'gtm.start': new Date().getTime(),
                        event: 'gtm.js')
                }
            }
            '
        });
        var f = d.getElementsByTagName(s)[0],
            j = d.createElement(s),
            dl = l != 'dataLayer' ? '&l=' + l : '';
        j.async = true;
        j.src =
            '../../../../../../www.googletagmanager.com/gtm5445.html?id=' + i + dl;
        f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-TAGCODE');
    </script>
    <!-- End Google Tag Manager -->
    <title>Login |Đại lý Linh Chi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="{{ asset('login/assets/css/bootstrap.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('login/assets/fonts/font-awesome/css/font-awesome.min.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('login/assets/fonts/flaticon/font/flaticon.css') }}">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="{{ asset('login/assets/img/favicon.ico') }}" type="image/x-icon">

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPoppins:400,500,700,800,900%7CRoboto:100,300,400,400i,500,700">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="{{ asset('login/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="{{ asset('login/assets/css/skins/default.css') }}">

</head>

<body id="top">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TAGCODE" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="page_loader"></div>

    <!-- Login 43 start -->
    <div class="login-43">
        <div class="container">
            <div class="row login-box">
                <div class="col-lg-5 col-md-12 bg-img none-992">
                    <div class="info">
                        <div class="social-list">
                            <a href="https://www.facebook.com/profile.php?id=100011612625783"><i
                                    class="fa fa-facebook"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-12 bg-color-8 align-self-center">
                    <div class="form-section">
                        <!-- <h3>Sign Into Your Account</h3> -->
                        <img class="logodaily" src="{{ asset('login/assets/img/logo.png') }}" width="250px"
                            alt="logo">
                        @if ($errors->any())
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                @foreach ($errors->all() as $error)
                                    {{ $error }} <br/>
                                @endforeach
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif

                        @if (Session::get('error'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                {{ Session::get('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                        @endif

                        <div class="login-inner-form">
                            <form action="{{ route('postlogin') }}" method="POST">
                                @csrf
                                <div class="form-group form-box">
                                    <input type="email" name="email" class="form-control"
                                        placeholder="Email Address" aria-label="Email Address">
                                    <i class="flaticon-mail-2"></i>
                                </div>
                                <div class="form-group form-box">
                                    <input type="password" name="password" class="form-control" autocomplete="off"
                                        placeholder="Password" aria-label="Password">
                                    <i class="flaticon-password"></i>
                                </div>
                                <div class="checkbox form-group form-box">
                                    <div class="form-check checkbox-theme">
                                        <input class="form-check-input" type="checkbox" value="" id="rememberMe">
                                        <label class="form-check-label" for="rememberMe">
                                            Remember me
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <button type="submit" class="btn-md btn-theme w-100">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login 43 end -->

    <!-- External JS libraries -->
    <script src="{{ asset('login/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('login/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('login/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Custom JS Script -->
</body>

</html>
