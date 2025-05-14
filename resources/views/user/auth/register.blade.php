<!doctype html>
<html class="no-js " lang="en">
    
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="description" content="Panvel Municipal Corporation Pet License">
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>PMC || Cold Storage License Registration</title>
        
        <!-- Favicon-->
        <link rel="icon" href="{{ url('/') }}/assets/images/PMC-logo.png" >
        
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
        
        <!-- Custom Css -->
        <link rel="stylesheet" href="{{ url('/') }}/assets/plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ url('/') }}/assets/css/style.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/material-design-iconic-font@2.2.0/dist/css/material-design-iconic-font.min.css">
    </head>
    
    <style>
        form.card.auth_form.transpert {
           position: absolute;
            top: 49%;
            left: 50%;
            transform: translate(-50%,-45%);
            width: 503px;
            padding: 0px;
            background: #fff;
            box-sizing: border-box;
            box-shadow: 0 15px 25px rgba(0,0,0,.5);
            border-radius: 10px;
      }
      i.zmdi.zmdi-email {
    color: black;
    }
    i.zmdi.zmdi-lock {
    color: black;
    }
    i.zmdi.zmdi-account-circle {
    color: black;
    }
        
    </style>

   <body class="theme-blush" style='background-image:url("{{ url('/') }}/assets/images/cold_storage.jpg"); background-position: center; background-repeat: no-repeat; background-size: cover; height: 100%;'>

        <div class="authentication">    
            <div class="container" style="justify-content: center;
    display: flex;
    max-width: 550px;">
                <div class="row">
                    <div class="col-lg-4 col-sm-12">
                        <form class="card auth_form transpert" method="POST" action="{{ url('/user/register') }}" enctype="multipart/form">
                            @csrf
                            
                            <div class="header">
                                <img class="logo" src="{{ url('/') }}/assets/images/PMC-logo.png" alt="" >
                                 <h5 style="font-weight: bold;font-size: 26px;color: #040608;"><b>{{ __('पनवेल महानगरपालिका') }}</b></h5>
                                <span style="color: #e77912;font-weight: 800;">Register a new User (नवीन वापरकर्ता)</span>
                            </div>
                            
                            <div class="body">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                                    </div>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus Placeholder="Enter Username(वापरकर्तानाव)">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="zmdi zmdi-email"></i></span>
                                    </div>
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"  autocomplete="email" Placeholder="Enter Email Id (ईमेल)">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>  
                                
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fa fa-phone" style="font-size:20px;color: #000000;"></i></span>
                                    </div>
                                    <input id="mobile" type="text" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" oninput="validateMobileNumber(this)"  autocomplete="mobile" Placeholder="Enter mobile Number (मोबाईल नंबर)">

                                    @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>  
                                
                                {{-- <div class="input-group mb-3">
                                    <div class="input-group-append">                                
                                        <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                                    </div>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" Placeholder="Enter Password (पासवर्ड)">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                           
                                </div>
                                
                                <div class="input-group mb-3">
                                    <div class="input-group-append">                                
                                        <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                                    </div>
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password" Placeholder="Enter Confirm Password (पासवर्डची पुष्टी करा)">
                                                            
                                </div> --}}


                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="zmdi zmdi-lock"></i>
                                        </span>
                                    </div>
                                
                                    <input id="password" type="password" 
                                           class="form-control @error('password') is-invalid @enderror" 
                                           name="password" autocomplete="new-password" 
                                           placeholder="Enter Your Password (पासवर्ड)">
                                
                                    <div class="input-group-append">
                                        <span class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
                                            <i class="zmdi zmdi-eye" id="togglePasswordIcon"></i>
                                        </span>
                                    </div>
                                
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="zmdi zmdi-lock"></i>
                                        </span>
                                    </div>
                                
                                    <input id="password-confirm" type="password" 
                                           class="form-control @error('password_confirmation') is-invalid @enderror" 
                                           name="password_confirmation" autocomplete="new-password" 
                                           placeholder="Enter Confirm Password (पासवर्डची पुष्टी करा)">
                                
                                    <div class="input-group-append">
                                        <span class="input-group-text" onclick="toggleConfirmPassword()" style="cursor: pointer;">
                                            <i class="zmdi zmdi-eye" id="toggleConfirmPasswordIcon"></i>
                                        </span>
                                    </div>
                                
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                
                                <button type="submit" class="btn btn-primary btn-block waves-effect waves-light">{{ __('Sign Up') }}</button>
                                
                                <div class="signin_with mt-3">
                                    Already have an account?
                                    <a class="link" href="{{ url('/user/login') }}">Sign In</a>
                                </div>
                                
                            </div>
                        </form>
                        
                    </div>
                <!--    <div class="col-lg-8 col-sm-12 d-none d-md-block">-->
                <!--        <div class="card">-->
                <!--            <img src="{{ url('/') }}/assets/images/signup.svg" alt="Sign Up" />-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
            </div>
        </div>
        
        
        <!-- Jquery Core Js -->
        <script src="{{ url('/') }}/assets/bundles/libscripts.bundle.js"></script>
        <script src="{{ url('/') }}/assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
        
        <script>
            function validateMobileNumber(input) {
                // Remove any non-digit characters
                input.value = input.value.replace(/\D/g, '');
        
                // Limit to 10 digits
                if (input.value.length > 10) {
                    input.value = input.value.slice(0, 10);
                }
            }
        </script>



<script>
    function togglePassword() {
        const passwordField = document.getElementById("password");
        const icon = document.getElementById("togglePasswordIcon");
        
        if (passwordField.type === "password") {
            passwordField.type = "text";
            icon.classList.remove("zmdi-eye");
            icon.classList.add("zmdi-eye-off");
        } else {
            passwordField.type = "password";
            icon.classList.remove("zmdi-eye-off");
            icon.classList.add("zmdi-eye");
        }
    }
</script>


<script>
    function toggleConfirmPassword() {
        const input = document.getElementById('password-confirm');
        const icon = document.getElementById('toggleConfirmPasswordIcon');
        const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
        input.setAttribute('type', type);
        icon.classList.toggle('zmdi-eye');
        icon.classList.toggle('zmdi-eye-off');
    }
    </script>
    </body>

</html>


