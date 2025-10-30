<section class="hero-slider">
    <div id="mainCarousel" class="carousel slide carousel-fade" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#mainCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#mainCarousel" data-slide-to="1"></li>
            <li data-target="#mainCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Slides -->
        <div class="carousel-inner">
            <!-- Slide 1 -->
            <div class="carousel-item active" style="background-image: url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
                <div class="carousel-caption">
                    <h2 class="animate__animated animate__fadeInDown">New Season Arrivals</h2>
                    <p class="animate__animated animate__fadeInUp">Discover our latest collection with up to 30% off</p>
                    <a href="#" class="btn btn-primary btn-lg animate__animated animate__fadeInUp">Shop Now</a>
                </div>
            </div>

            <!-- Slide 2 -->
            <div class="carousel-item" style="background-image: url('https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
                <div class="carousel-caption">
                    <h2 class="animate__animated animate__fadeInDown">Summer Collection</h2>
                    <p class="animate__animated animate__fadeInUp">Light and comfortable for the sunny days</p>
                    <a href="#" class="btn btn-primary btn-lg animate__animated animate__fadeInUp">Explore More</a>
                </div>
            </div>

            <!-- Slide 3 -->
            <div class="carousel-item" style="background-image: url('https://images.unsplash.com/photo-1485462537746-965f33f7f6a7?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');">
                <div class="carousel-caption">
                    <h2 class="animate__animated animate__fadeInDown">Exclusive Deals</h2>
                    <p class="animate__animated animate__fadeInUp">Limited time offers on selected items</p>
                    <a href="#" class="btn btn-primary btn-lg animate__animated animate__fadeInUp">View Deals</a>
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="carousel-control-prev" href="#mainCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#mainCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>

<style>
.hero-slider {
    position: relative;
    margin-bottom: 40px;
}

.hero-slider .carousel-item {
    height: 80vh;
    min-height: 500px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: relative;
}

.hero-slider .carousel-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.4);
}

.hero-slider .carousel-caption {
    position: absolute;
    right: 15%;
    bottom: 30%;
    left: 15%;
    padding: 30px;
    text-align: left;
    background: rgba(0, 0, 0, 0.5);
    border-radius: 8px;
    color: #fff;
}

.hero-slider h2 {
    font-size: 3.5rem;
    font-weight: 700;
    margin-bottom: 20px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
}

.hero-slider p {
    font-size: 1.5rem;
    margin-bottom: 25px;
    text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.3);
}

.hero-slider .btn {
    padding: 12px 30px;
    font-size: 1.1rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}

.hero-slider .btn-primary {
    background-color: #ff6b6b;
    border: none;
}

.hero-slider .btn-primary:hover {
    background-color: #ff5252;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .hero-slider .carousel-item {
        height: 60vh;
        min-height: 400px;
    }
    
    .hero-slider h2 {
        font-size: 2.5rem;
    }
    
    .hero-slider p {
        font-size: 1.2rem;
    }
}

/* Animation classes */
.animate__animated {
    animation-duration: 1s;
    animation-fill-mode: both;
}

@keyframes fadeInDown {
    from {
        opacity: 0;
        transform: translate3d(0, -20%, 0);
    }
    to {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translate3d(0, 20%, 0);
    }
    to {
        opacity: 1;
        transform: translate3d(0, 0, 0);
    }
}

.animate__fadeInDown {
    animation-name: fadeInDown;
}

.animate__fadeInUp {
    animation-name: fadeInUp;
}
</style>

<!-- Add this before closing body tag if not already included -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>