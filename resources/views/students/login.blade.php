<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login V18</title>
    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href=" {{ asset('images1/icons/favicon.ico') }}" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href=" {{ asset('vendor2/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href=" {{ asset('fonts2/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href=" {{ asset('fonts2/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href=" {{ asset('vendor2/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href=" {{ asset('vendor2/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href=" {{ asset('vendor2/animsition/css/animsition.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href=" {{ asset('vendor2/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href=" {{ asset('vendor2/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css2/util.css') }}">
    <link rel="stylesheet" type="text/css" href=" {{ asset('css2/main.css') }}">
    <!--===============================================================================================-->
</head>

<body style="background-color: #666666;">

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form method="POST" action="{{ route('student.login') }}"class="login100-form validate-form">
                    @csrf
                    <span class="login100-form-title p-b-43">
                        Student Login
                    </span>


                    <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email"@error('email') isinvalid @enderror
                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <span class="focus-input100"></span>
                        <span class="label-input100">Email</span>
                    </div>


                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" @error('password') is-invalid @enderror name="password"
                            required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <span class="focus-input100"></span>
                        <span class="label-input100">Password</span>
                    </div>

                    <div class="flex-sb-m w-full p-t-3 p-b-32">
                        <div class="contact100-form-checkbox">
                            <input class="input-checkbox100" id="ckb1" type="checkbox" type="checkbox"
                                name="remember" id="remember"
                                {{ old('remember') ? 'checked' : '' }}>
                            <label class="label-checkbox100" for="ckb1">
                                Remember me
                            </label>
                        </div>

                        <div>
                            <a href="{{route('student.register')}}" class="txt1">
                                No Account?
                            </a>
                        </div>
                    </div>


                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            Login
                        </button>
                    </div>

                    <!-- <div class="text-center p-t-46 p-b-20">
      <span class="txt2">
       or sign up using
      </span>
     </div>

     <div class="login100-form-social flex-c-m">
      <a href="#" class="login100-form-social-item flex-c-m bg1 m-r-5">
       <i class="fa fa-facebook-f" aria-hidden="true"></i>
      </a>

      <a href="#" class="login100-form-social-item flex-c-m bg2 m-r-5">
       <i class="fa fa-twitter" aria-hidden="true"></i>
      </a>
     </div> -->
                </form>

                <div class="login100-more" style="background-image: url(' {{ asset('images1/bg-01.jpg') }}');">
                </div>
            </div>
        </div>
    </div>





    <!--===============================================================================================-->
    <script src=" {{ asset('vendor2/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src=" {{ asset('vendor2/animsition/js/animsition.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src=" {{ asset('vendor2/bootstrap/js/popper.js') }}"></script>
    <script src=" {{ asset('vendor2/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src=" {{ asset('vendor2/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src=" {{ asset('vendor2/daterangepicker/moment.min.js') }}"></script>
    <script src=" {{ asset('vendor2/daterangepicker/daterangepicker.js') }}"></script>
    <!--===============================================================================================-->
    <script src=" {{ asset('vendor2/countdowntime/countdowntime.js') }}"></script>
    <!--===============================================================================================-->
    <script src=" {{ asset('s2/main.js') }}j"></script>

</body>

</html>
