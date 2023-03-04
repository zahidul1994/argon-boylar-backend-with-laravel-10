<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('backend/assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('backend/assets/img/favicon.png') }}">
    <title>@yield('title')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('backend/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('backend/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('backend/assets/css/argon-dashboard.css?v=2.0.5') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    @stack('css')
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>

    <!-- /sidebar menu  start-->
    @include('backend.includes.sidebar')
    <!-- /sidebar menu end -->

    <main class="main-content position-relative border-radius-lg ">
        <!-- header start -->
        @include('backend.includes.header')
        <!-- header end -->

        @yield('content')

        {{-- @include('backend.includes.footer') --}}

    </main>

    <!--   Core JS Files   -->
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script src="{{ asset('backend/assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <!-- Kanban scripts -->
    <script src="{{ asset('backend/assets/js/plugins/dragula/dragula.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugins/jkanban/jkanban.js') }}"></script>
    <script src="{{ asset('backend/assets/js/plugins/chartjs.min.js') }}"></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('backend/assets/js/livejs/buttons.js') }}"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('backend/assets/js/argon-dashboard.min.js?v=2.0.5') }}"></script>

    <script type="text/javascript">
        var url = "{{ URL::to('/') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {!! @Toastr::message() !!}


    <script>
        function showTime(){
         var date = new Date();
         var h = date.getHours(); // 0 - 23
         var m = date.getMinutes(); // 0 - 59
         var s = date.getSeconds(); // 0 - 59
         var session = "AM";
         
         if(h == 0){
             h = 12;
         }
         
         if(h > 12){
             h = h - 12;
             session = "PM";
         }
         
         h = (h < 10) ? "0" + h : h;
         m = (m < 10) ? "0" + m : m;
         s = (s < 10) ? "0" + s : s;
         
         var time = h + ":" + m + ":" + s + " " + session;
         document.getElementById("MyClockDisplay").innerText = time;
         document.getElementById("MyClockDisplay").textContent = time;
         
         setTimeout(showTime, 1000);
         
     }
     
     showTime();
        
        </script>
@stack('js')
</body>

</html>
