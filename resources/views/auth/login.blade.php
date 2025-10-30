<!DOCTYPE html>
<html>
   <head>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="{{ asset('home/images/favicon.png') }}" type="image/x-icon">
      <title>Login - Your Store Name</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
      <!-- font awesome style -->
      <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
      <!-- responsive style -->
      <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />
      <style>
         body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
         }
         .login-section {
            padding: 100px 0;
            min-height: calc(100vh - 300px);
            display: flex;
            align-items: center;
         }
         .login-container {
            max-width: 500px;
            margin: 0 auto;
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            width: 100%;
         }
         .login-logo {
            text-align: center;
            margin-bottom: 30px;
         }
         .login-logo img {
            max-width: 150px;
            height: auto;
         }
         .form-group {
            margin-bottom: 20px;
            text-align: left;
         }
         .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
         }
         .form-control {
            height: 48px;
            border-radius: 5px;
            border: 1px solid #ddd;
            padding: 10px 15px;
            width: 100%;
            font-size: 15px;
            transition: all 0.3s;
         }
         .form-control:focus {
            border-color: #f7444e;
            box-shadow: 0 0 0 0.2rem rgba(247, 68, 78, 0.25);
         }
         .btn-login {
            background: #f7444e;
            color: #fff;
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            font-weight: 600;
            text-transform: uppercase;
            width: 100%;
            transition: all 0.3s;
            font-size: 16px;
            margin-top: 10px;
         }
         .btn-login:hover {
            background: #e63a42;
            color: #fff;
         }
         .forgot-password {
            text-align: right;
            margin: 15px 0 25px;
         }
         .forgot-password a {
            color: #f7444e;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s;
         }
         .forgot-password a:hover {
            text-decoration: underline;
         }
         .remember-me {
            display: flex;
            align-items: center;
            margin: 15px 0;
         }
         .remember-me input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-right: 8px;
            position: relative;
            top: -1px;
         }
         .remember-me label {
            margin: 0;
            font-size: 14px;
            color: #555;
            cursor: pointer;
         }
         .error-message {
            color: #f7444e;
            margin-bottom: 20px;
            padding: 12px 15px;
            background: #fde8e9;
            border-radius: 5px;
            font-size: 14px;
            border-left: 4px solid #f7444e;
         }
         .alert {
            padding: 12px 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 14px;
         }
         .alert-success {
            background-color: #e8f5e9;
            color: #2e7d32;
            border-left: 4px solid #4caf50;
         }
         .register-link {
            margin-top: 20px;
            text-align: center;
            font-size: 15px;
            color: #555;
         }
         .register-link a {
            color: #f7444e;
            text-decoration: none;
            font-weight: 500;
            margin-left: 5px;
         }
         .register-link a:hover {
            text-decoration: underline;
         }
      </style>
   </head>
   <body>


      <!-- Login Section -->
      <section class="login-section">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-md-8 col-lg-6">
                  <div class="login-container">
                     <div class="login-logo">
                        <a href="{{ url('/') }}">
                           <img src="images/logo.png" alt="Logo" />
                        </a>
                     </div>

                     @if ($errors->any())
                        <div class="error-message">
                           @foreach ($errors->all() as $error)
                              <p class="mb-0">{{ $error }}</p>
                           @endforeach
                        </div>
                     @endif

                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                           {{ session('status') }}
                        </div>
                     @endif

                     <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group">
                           <label for="email">Email Address</label>
                           <input id="email" 
                                  class="form-control" 
                                  type="email" 
                                  name="email" 
                                  value="{{ old('email') }}" 
                                  required 
                                  autofocus 
                                  autocomplete="email" 
                                  placeholder="Enter your email" />
                        </div>

                        <div class="form-group">
                           <label for="password">Password</label>
                           <input id="password" 
                                  class="form-control" 
                                  type="password" 
                                  name="password" 
                                  required 
                                  autocomplete="current-password" 
                                  placeholder="Enter your password" />
                        </div>

                        <div class="remember-me">
                           <input type="checkbox" id="remember_me" name="remember" class="mr-2">
                           <label for="remember_me">{{ __('Remember me') }}</label>
                        </div>

                        @if (Route::has('password.request'))
                           <div class="forgot-password">
                              <a href="{{ route('password.request') }}">
                                 {{ __('Forgot your password?') }}
                              </a>
                           </div>
                        @endif

                        <button type="submit" class="btn btn-login">
                           {{ __('Log in') }}
                        </button>

                        @if (Route::has('register'))
                           <div class="register-link">
                              Don't have an account? 
                              <a href="{{ route('register') }}">Register here</a>
                           </div>
                        @endif
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>



      <!-- Scripts -->
      <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
      <script src="{{ asset('home/js/popper.min.js') }}"></script>
      <script src="{{ asset('home/js/bootstrap.js') }}"></script>
      <script src="{{ asset('home/js/custom.js') }}"></script>
   </body>
</html>