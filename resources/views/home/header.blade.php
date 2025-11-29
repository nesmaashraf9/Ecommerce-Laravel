<header class="header_section">
            <div class="container">
               <nav class="navbar navbar-expand-lg custom_nav-container ">
                  <a class="navbar-brand" href="index.html"><img width="250"src="{{ asset('images/logo.png') }}"  alt="#" /></a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class=""> </span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav">
                        <li class="nav-item active">
                           <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                        </li>
                       <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true"> <span class="nav-label">Pages <span class="caret"></span></a>
                           <ul class="dropdown-menu">
                              <li><a href="about.html">About</a></li>
                              <li><a href="testimonial.html">Testimonial</a></li>
                           </ul>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{ route('all.products') }}">Products</a>
                        </li>
                        <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="#" id="blogDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Blog
                           </a>
                           <div class="dropdown-menu" aria-labelledby="blogDropdown">
                              <a class="dropdown-item" href="{{ route('blog.index') }}">All Posts</a>
                              <div class="dropdown-divider"></div>
                              <h6 class="dropdown-header">Categories</h6>
                              <a class="dropdown-item" href="{{ route('blog.category', 'technology') }}">Technology</a>
                              <a class="dropdown-item" href="{{ route('blog.category', 'fashion') }}">Fashion</a>
                              <a class="dropdown-item" href="{{ route('blog.category', 'lifestyle') }}">Lifestyle</a>
                              <div class="dropdown-divider"></div>
                              <h6 class="dropdown-header">Recent Posts</h6>
                              <a class="dropdown-item" href="#">Latest Trends in 2023</a>
                              <a class="dropdown-item" href="#">Top 10 Must-Have Items</a>
                           </div>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="contact.html">Contact</a>
                        </li>
                        
                        @guest
                        <li class="nav-item">
                           <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                        @else
                        <li class="nav-item dropdown">
                           <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              {{ Auth::user()->name }}
                           </a>
                           <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                              <a class="dropdown-item" href="{{ route('user.orders') }}">
                                 <i class="fas fa-shopping-bag mr-2"></i> My Orders
                              </a>
                              <div class="dropdown-divider"></div>
                              <form method="POST" action="{{ route('logout') }}">
                                 @csrf
                                 <button type="submit" class="dropdown-item">
                                    {{ __('Logout') }}
                                 </button>
                              </form>
                           </div>
                        </li>
                        @endguest
                        <li class="nav-item" style="position: relative;">
                           <a class="nav-link" href="{{ route('cart') }}" style="position: relative;">
                              <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                                 <g>
                                    <g>
                                       <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                                          c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                                    </g>
                                 </g>
                                 <g>
                                    <g>
                                       <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                                          C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                                          c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                                          C457.728,97.71,450.56,86.958,439.296,84.91z" />
                                    </g>
                                 </g>
                                 <g>
                                    <g>
                                       <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                                          c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                                    </g>
                                 </g>
                              </svg>
                              @if(count((array) session('cart')) > 0)
                                  <span class="cart-count">{{ count((array) session('cart')) }}</span>
                              @endif
                           </a>
                        </li>
                        <form class="form-inline">
                           <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                           <i class="fa fa-search" aria-hidden="true"></i>
                           </button>
                        </form>
                     </ul>
                  </div>
               </nav>
            </div>
         </header>

         <!-- Add these scripts before the closing body tag -->
         <!-- jQuery first, then Popper.js, then Bootstrap JS -->
         <!-- jQuery first, then Popper.js, then Bootstrap JS -->
         <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
         <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
         <script>
            // Enable Bootstrap dropdowns
            $(document).ready(function() {
                $('.dropdown-toggle').dropdown();
            });
            
            // Close dropdown when clicking outside
            document.addEventListener('click', function(event) {
                const dropdowns = document.querySelectorAll('.dropdown-menu');
                const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
                
                dropdowns.forEach(dropdown => {
                    if (!dropdown.contains(event.target)) {
                        dropdown.classList.remove('show');
                    }
                });
                
                dropdownToggles.forEach(toggle => {
                    if (toggle.contains(event.target)) {
                        const menu = toggle.nextElementSibling;
                        menu.classList.toggle('show');
                    } else {
                        const menu = toggle.nextElementSibling;
                        menu.classList.remove('show');
                    }
                });
            });
         </script>