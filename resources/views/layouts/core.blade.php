<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="user_id" content="{{ Auth::user()->id }}">
  <meta name="description" content="">

  <title>@yield('title')</title>
  <!-- Favicon -->
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.png')}}">
  <!-- Style CSS -->
  <link rel="stylesheet" href="{{ asset('css/splendor.css')}}">
  <link rel="stylesheet" href="{{ asset('style.css')}}">
  <link rel="stylesheet" href="{{ asset('css/main.min.css')}}">
  <!-- Modernizer JS -->
  <script src="{{ asset('js/vandor/modernizr-3.5.0.min.js')}}"></script>
  <link href="https://cdn.quilljs.com/1.3.4/quill.snow.css" rel="stylesheet">
  <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
  <script>
       (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-3183155544576437",
            enable_page_level_ads: true
       });
  </script>
</head>

<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<body>
  <!-- Preloader Start -->
  <div id="fadeout" class="loader w-100 h-100 position-absolute">
    <div class="h-100 d-flex justify-content-center align-items-center">
      <div class="one circle"></div>
      <div class="two circle"></div>
    </div>
  </div>
  <!-- Preloader End -->

  <!-- Header Start -->
  <header class="position-fixed bg-white w-100">
    <nav id="active-sticky" class="navbar navbar-light navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('logo.png')}}" alt="cod|trix"></a>
        <button class="navbar-toggler navber-toggler-right" data-toggle="collapse" data-target="#navbarToggler">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarToggler">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a href="{{ url('/') }}/home" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/') }}/about-us" class="nav-link">About Us</a>
            </li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" >Pages</a>
              <ul class="dropdown-menu">

                <li><a class="dropdown-item" href="{{ url('/') }}/faq">Faq</a></li>
              </ul>
            </li>

            <li class="nav-item">
              <a href="{{ url('/') }}/contact" class="nav-link">Contact Us</a>
            </li>
          </ul>
          <div class="pl-20">
              @guest
            <a class="btn btn-sm btn-primary rounded" href="{{ route('login') }}">{{ __('Login') }}</a>

            @if (Route::has('register'))
            <a class="btn btn-sm btn-primary rounded" href="{{ route('register') }}">{{ __('Register') }}</a>
            @endif
        @else
        <a class="btn btn-sm btn-primary rounded" href="{{ route('logout') }}" onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                     {{ __('Logout') }}</a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                         @csrf
                     </form>
          @endguest
          </div>
        </div>
      </div>
    </nav>
  </header>
  @section('sidebar')
  <div class="col-12 col-md-4 col-lg-3">
    <div class="sidebar" data-aos="fade-in">

      <!-- Widget End -->
      <div class="widget recent-post bg-white mb-30">

      </div>
      <!-- Widget End -->
      <div class="widget categories bg-white mb-30">

      </div>
      <!-- Widget End -->
      <div class="widget tags bg-white">
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
        <!-- sidebar -->
        <ins class="adsbygoogle"
             style="display:block"
             data-ad-client="ca-pub-3183155544576437"
             data-ad-slot="1106215881"
             data-ad-format="auto"
             data-full-width-responsive="true"></ins>
        <script>
             (adsbygoogle = window.adsbygoogle || []).push({});
        </script>

      </div>
      <!-- Widget End -->
    </div>
  </div>
@show
            @yield('content')

        <!-- Footer Secion Start -->
        <footer>
          <div class="footer-widget-area bg-light ptb-100">
            <div class="container">
              <div class="row">
                <div class="col-12 col-sm-12 col-md-4 col-lg-5 mb-sm-40">
                  <div class="footer-widget about">
                    <div class="footer-logo mb-20">
                      <a href="index.html"><img src="{{ asset('logo.png')}}" alt="RNR"></a>
                    </div>
                    <div class="widget-content">
                      <p>Remote Web Designing Course, Learn How To Build Web Application.</p>
                    </div>
                  </div>
                </div>
                <!-- Widget End -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-sm-40">
                  <div class="footer-widget">

                  </div>
                </div>
                <!-- Widget End -->
                <div class="col-6 col-sm-3 col-md-2 col-lg-2">
                  <div class="footer-widget">

                  </div>
                </div>
                <!-- Widget End -->
                <div class="col-6 col-sm-3 col-md-2 col-lg-2">
                  <div class="footer-widget">

                  </div>
                </div>
                <!-- Widget End -->
              </div>
            </div>
          </div>
          <div class="footer-copyright bg-white ptb-15">
            <div class="container d-sm-flex">
              <p class="mb-0">Copyrights &copy; 2019 All Rights Reserved by cod|trix</p>

            </div>
          </div>
        </footer>
        <!-- Footer Secion End -->

        <!-- JS Files -->
        <script src="{{ asset('js/vandor/jquery-3.2.1.min.js')}}"></script>
        <script src="{{ asset('js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('js/popper.min.js')}}"></script>
        <script src="{{ asset('js/plugins.js')}}"></script>
        <script src="{{ asset('js/main.js')}}"></script>
          <script src="{{ asset('js/main.min.js')}}"></script>
          <script src="{{ asset('js/vandor/stacked-menu/stacked-menu.min.js')}}"></script>

          <script type="text/javascript"> //<![CDATA[
            var tlJsHost = ((window.location.protocol == "https:") ? "https://secure.trust-provider.com/" : "http://www.trustlogo.com/");
            document.write(unescape("%3Cscript src='" + tlJsHost + "trustlogo/javascript/trustlogo.js' type='text/javascript'%3E%3C/script%3E"));
          //]]></script>
          <script language="JavaScript" type="text/javascript">
            TrustLogo("https://www.positivessl.com/images/seals/positivessl_trust_seal_md_167x42.png", "POSDV", "none");
          </script>
        </body>
        </html>
