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
      <title>Register - Your Store Name</title>
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
         .register-section {
            padding: 80px 0;
            min-height: calc(100vh - 300px);
            display: flex;
            align-items: center;
         }
         .register-container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            width: 100%;
         }
         .register-logo {
            text-align: center;
            margin-bottom: 30px;
         }
         .register-logo img {
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
         .btn-register {
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
         .btn-register:hover {
            background: #e63a42;
            color: #fff;
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
         .login-link {
            margin-top: 20px;
            text-align: center;
            font-size: 15px;
            color: #555;
         }
         .login-link a {
            color: #f7444e;
            text-decoration: none;
            font-weight: 500;
            margin-left: 5px;
         }
         .login-link a:hover {
            text-decoration: underline;
         }
         .terms-conditions {
            font-size: 14px;
            color: #666;
            margin: 15px 0;
         }
         .terms-conditions a {
            color: #f7444e;
            text-decoration: none;
         }
         .terms-conditions a:hover {
            text-decoration: underline;
         }
      </style>
   </head>
   <body>
\

      <!-- Register Section -->
      <section class="register-section">
         <div class="container">
            <div class="row justify-content-center">
               <div class="col-md-10 col-lg-8">
                  <div class="register-container">
                     <div class="register-logo">
                        <a href="{{ url('/') }}">
                           <img src="images/logo.png" alt="Logo" />
                        </a>
                        <h2 class="mt-3">Create an Account</h2>
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

                     <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="name">Full Name</label>
                                 <input id="name" 
                                        class="form-control" 
                                        type="text" 
                                        name="name" 
                                        value="{{ old('name') }}" 
                                        required 
                                        autofocus 
                                        autocomplete="name" 
                                        placeholder="Enter your full name" />
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="email">Email Address</label>
                                 <input id="email" 
                                        class="form-control" 
                                        type="email" 
                                        name="email" 
                                        value="{{ old('email') }}" 
                                        required 
                                        autocomplete="email" 
                                        placeholder="Enter your email" />
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="phone">Phone Number</label>
                                 <input id="phone" 
                                        class="form-control" 
                                        type="tel" 
                                        name="phone" 
                                        value="{{ old('phone') }}" 
                                        required 
                                        placeholder="Enter your phone number" />
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="address">Address</label>
                                 <input id="address" 
                                        class="form-control" 
                                        type="text" 
                                        name="address" 
                                        value="{{ old('address') }}" 
                                        required 
                                        placeholder="Enter your address" />
                              </div>
                           </div>
                        </div>

                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="password">Password</label>
                                 <input id="password" 
                                        class="form-control" 
                                        type="password" 
                                        name="password" 
                                        required 
                                        autocomplete="new-password" 
                                        placeholder="Create a password" />
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="password_confirmation">Confirm Password</label>
                                 <input id="password_confirmation" 
                                        class="form-control" 
                                        type="password" 
                                        name="password_confirmation" 
                                        required 
                                        autocomplete="new-password" 
                                        placeholder="Confirm your password" />
                              </div>
                           </div>
                        </div>

                        @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                           <div class="terms-conditions">
                              <div class="d-flex">
                                 <input type="checkbox" id="terms" name="terms" required style="margin-right: 10px; margin-top: 5px;">
                                 <label for="terms" style="cursor: pointer;">
                                    I agree to the 
                                    <a href="{{ route('terms.show') }}" target="_blank">Terms of Service</a> and 
                                    <a href="{{ route('policy.show') }}" target="_blank">Privacy Policy</a>
                                 </label>
                              </div>
                           </div>
                        @endif

                        <button type="submit" class="btn btn-register">
                           {{ __('Register') }}
                        </button>

                        <div class="login-link">
                           Already have an account? 
                           <a href="{{ route('login') }}">Login here</a>
                        </div>
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