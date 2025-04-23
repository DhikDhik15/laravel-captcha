<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets') }}/"
  data-template="vertical-menu-template">
  <head>
    <!-- PWA  -->
    <meta name="theme-color" content="#6777ef"/>
    <link rel="apple-touch-icon" href="{{ asset('logo.PNG') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <!-- END: PWA -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>{{ config('app.name', 'OPTIMA - Optimalization Inventory and Management of Asset') }}</title>

    <meta name="description" content="" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline';"> -->

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" />

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/js/jquery-toast/jquery.toast.min.css') }}" />

    <script type="text/javascript">
      window.addEventListener(
        "message",
        (event) => {
          // return false if window different from what we originally opened.
          if (event.origin !== document.location.origin) return;
        },
        false,
      );
    </script>

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>

    @yield('style')
  </head>

  <body>
    <div id="loading">
      <div class="spinner-grow text-primary spinner-loading" role="status">
        <span class="sr-only">Loading...</span>
      </div>
      <div class="loading-backdrop"></div>
    </div>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand logo">
            <a href="{{ route('home') }}" class="app-brand-link">
              <span class="">
              	<img class="img img-fluid" alt="OPTIMA" src="{{ asset('assets/img/logo-text.png') }}">
              </span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
              <em class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></em>
              <em class="ti ti-x d-block d-xl-none ti-sm align-middle"></em>
            </a>
          </div>

          @include('components.menu')
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->

          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar">
            @include('components.navbar')
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
	            @yield('content')
	        </div>

            @include('components.footer')

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>

      <!-- Drag Target Area To SlideIn Menu On Small Screens -->
      <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-toast/jquery.toast.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/jquery.timeago.js') }}"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

    <!-- endbuild -->
    @yield('script-plugins')

    <!-- Main JS -->
    <script type="text/javascript">
      var search_menu_url = '{{ route('search-menu') }}'
      var app_url = '{{ url('/') }}'
    </script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <script type="text/javascript">
    	$.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        xhrFields: {
          withCredentials: true
        },
        dataType: 'json'
      });
      $(document).ready(function() {

        $('#template-customizer').remove();

        $(document).on('keyup', '.input-rupiah', function() {
            $(this).val(RupiahFormat($(this).val()));
        });

      })
      let loading = $('#loading');
      $(document).ajaxStart(function () {
        loading.removeClass('d-none');
      }).ajaxStop(function () {
        loading.addClass('d-none');
      });
      function isNumberKey(evt) {
        let charCode = (evt.which) ? evt.which : evt.keyCode;
        if (
          charCode != 46 && charCode > 31 
          && (charCode < 48 || charCode > 57)
        ) return false;
        return true;
      }
      function encodeQuery(data) {
        const result = [];
        Object.keys(data).forEach(item => {
          if (data[item])
            result.push(encodeURIComponent(item) + '=' + encodeURIComponent(data[item]));
        });
        return result;
      }

      $(document).on('keypress', '.numeric-only', function (e){
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          return false;
        }
      })
      $(document).on('keypress', '.money-format', function (e){
        var charCode = (e.which) ? e.which : e.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
          return false;
        }
      });
      $(document).on('keyup', '.money-format', function(e) {
        this.value = this.value.replace(/\./g,'').toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.")
      })

      // Helper Func
      function RupiahFormat(str){
        str = str.toString();
        var numStr = str.replace(/[^,\d]/g, '').toString(),
          split = numStr.split(','),
          sisa = split[0].length % 3,
          rupiah = split[0].substr(0, sisa),
          ribuan = split[0].substr(sisa).match(/\d{3}/gi);
            
        if (ribuan) {
          let separator = sisa ? '.' : '';
          rupiah += separator + ribuan.join('.');
        }
        
        return rupiah ? rupiah : '';
      }

    </script>
    @stack('script')
    @yield('script')

    <script src="{{ asset('/sw.js') }}"></script>
    <script>
        if (navigator.serviceWorker != undefined) {
          if (!navigator.serviceWorker.controller) {
            navigator.serviceWorker.register("/sw.js").then(function (reg) {
                console.log("Service worker has been registered for scope: " + reg.scope);
            });
          }
        }
    </script>
    <!-- handle back button in mobile phone -->
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        if (window.history && window.history.pushState) {
          window.history.pushState('forward', null, '#forward');
          window.addEventListener('popstate', function() {
            if (window.location.hash === '#forward') {
              // Replace with your logic to close the PWA
              if (confirm("Apakah anda yakin akan keluar aplikasi?")) {
                window.close(); // This might not work on all browsers or devices
              } else {
                window.history.pushState('forward', null, '#forward');
              }
            }
          });
        }
      });
    </script>
  </body>
</html>
