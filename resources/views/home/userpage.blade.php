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
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
      <!-- CSRF Token for AJAX -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
            @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
            @include('home.slider')
         <!-- end slider section -->
      </div>
      <!-- why section -->
            @include('home.why')
      <!-- end why section -->
      
      <!-- arrival section -->
            @include('home.arrival')
      <!-- end arrival section -->
      
      <!-- product section -->
            @include('home.products')
      <!-- end product section -->

          <!-- Comments Section -->
  

            @include('home.comments')

      <!-- subscribe section -->
            @include('home.subscribe')
      <!-- end subscribe section -->
      <!-- client section -->
            @include('home.client')
      <!-- end client section -->
      <!-- footer start -->
            @include('home.footer')
      <!-- footer end -->
      
      <!-- jQuery, Popper.js, Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      
      <script>
         $(document).ready(function() {
            // Initialize dropdowns
            $('.dropdown-toggle').dropdown();
            
            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();
            
            // Enable AJAX CSRF token
            $.ajaxSetup({
               headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
            });
         });
      </script>
      
      <div class="cpy_">
         <p class="mx-auto">  {{ date('Y') }} All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         </p>
      </div>
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>