@extends('layouts.login')

@section('content')
		<!-- /Left Text -->
        <div class="d-none d-lg-flex col-lg-7 p-0">
          <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
            <img
              src="{{ asset('assets/img/illustrations/auth-login-illustration-light.png') }}"
              alt="auth-login-cover"
              class="img-fluid my-5 auth-illustration"
              data-app-light-img="illustrations/auth-login-illustration-light.png"
              data-app-dark-img="illustrations/auth-login-illustration-dark.png" />

            <img
              src="{{ asset('assets/img/illustrations/bg-shape-image-light.png') }}"
              alt="auth-login-cover"
              class="platform-bg"
              data-app-light-img="illustrations/bg-shape-image-light.png"
              data-app-dark-img="illustrations/bg-shape-image-dark.png" />
          </div>
        </div>
        <!-- /Left Text -->

        <!-- Login -->
        <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
          <div class="w-px-400 mx-auto">
            <!-- Logo -->
            <div class="app-brand mb-4">
              <a href="{{ url('/') }}" class="app-brand-link gap-2 w-100">
                <span class="app-brand-logo demo w-100 text-center">
                  <img class="img img-fluid w-50 d-inline" alt="Jasa Raharja Putra" src="{{ asset('assets/img/logo_jrp.png') }}">
                </span>
              </a>
            </div>
            <!-- /Logo -->
            {{-- <h3 class="mb-1 text-center">Welcome to OPTIMA</h3>
            <p class="mb-4 text-center">Optimalization Inventory and Management of Asset</p> --}}

            {{-- @if (session()->has('errors'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ $errors->first('username') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    {{ session()->get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif --}}

            @if ($errors->any())
                <ul style="color:red;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            
            <form id="form-standard" class="mb-3" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="username"
                    placeholder="Enter your username"
                    value="{{ old('username') }}"
                    autofocus
                    autocomplete="off" />
                </div>
                <div class="mb-3 form-password-toggle">
                  <label for="password" class="form-label">Password</label>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password"
                      autocomplete="off" />
                      <div class="input-group-append">
                          <span class="input-group-text">
                              <a role="button" id="password-visibility">
                                  <em class="fa fa-eye"></em>
                              </a>
                          </span>
                      </div>
                  </div>
                </div>
                {{-- <div class="mt-1 mb-1 text-center w-100">
                  @if ($captcha_is_active)
                      <div class="g-recaptcha" data-sitekey="{{ $google_site_key }}"></div>
                  @endif
                </div> --}}
                <button id="login-btn" class="btn btn-primary d-grid w-100">Sign in</button>
              </form>

          </div>
        </div>
        <!-- /Login -->
@endsection

@section('script')
    <script type="text/javascript">
        function resetInputPassword() {
            let val = $('#password').val()
            if (val == '') {
                $('#password').attr('type', 'text')
            } else {
                $('#password').attr('type', 'password')
            }
        }

        function resetInputSsoPassword() {
            let val = $('#sso-password').val()
            if (val == '') {
                $('#sso-password').attr('type', 'text')
            } else {
                $('#sso-password').attr('type', 'password')
            }
        }

        $(document).ready(function() {
            $('#password').on('focus', function() {
                let type = $(this).attr('type')
                if (type == 'text') {
                    $('#password').attr('type', 'password')
                    $('#password-visibility').find('i').removeClass('fa-eye-slash').addClass('fa-eye')
                }
            })
            $('#sso-password').on('focus', function() {
                let type = $(this).attr('type')
                if (type == 'text') {
                    $('#sso-password').attr('type', 'password')
                    $('#sso-password-visibility').find('i').removeClass('fa-eye-slash').addClass('fa-eye')
                }
            })

            $('#password').on('input', function() {
                resetInputPassword()
            })
            $('#password').on('focusout', function() {
                resetInputPassword()
            })

            $('#sso-password').on('input', function() {
                resetInputSsoPassword()
            })
            $('#sso-password').on('focusout', function() {
                resetInputSsoPassword()
            })

            $(document).on('click', '.btn-close', function() {
                $(this).closest('.alert').remove()
            })

            $('#password-visibility').on('click', function() {
                let type = $('#password').attr('type')
                if (type == 'text') {
                    $('#password').attr('type', 'password')
                    $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye')
                } else {
                    $('#password').attr('type', 'text')
                    $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash')
                }
            })

            $('#sso-password-visibility').on('click', function() {
                let type = $('#sso-password').attr('type')
                if (type == 'text') {
                    $('#sso-password').attr('type', 'password')
                    $(this).find('i').removeClass('fa-eye-slash').addClass('fa-eye')
                } else {
                    $('#sso-password').attr('type', 'text')
                    $(this).find('i').removeClass('fa-eye').addClass('fa-eye-slash')
                }
            })

            $('#login-btn').on('click', function() {
                if ($('#password').val() != null && $('#password').val() != '') {
                    $('#password').attr('type', 'password').val(btoa('{{ config('app.key') }}'+$('#password').val()))
                }
            })

            $('#login-sso-btn').on('click', function() {
                if ($('#sso-password').val() != null && $('sso-#password').val() != '') {
                    $('#sso-password').attr('type', 'password').val(btoa('{{ config('app.key') }}'+$('#sso-password').val()))
                }
            })
        })
    </script>
@endsection