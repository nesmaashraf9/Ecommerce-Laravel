<section class="reviews-section py-5">
    <div class="container">
        <!-- Top Tabs -->
        <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4 flex-wrap gap-3">
            <div class="d-flex flex-wrap align-items-center gap-3">
                <h5 class="mb-0 fw-semibold">All Reviews <span class="text-danger">{{ number_format($averageRating, 1) }}</span></h5>

            </div>
            <button id="writeReviewBtn" class="btn btn-danger fw-semibold px-4">Write a review</button>
        </div>

        <!-- Rating Summary -->
        <div class="text-center mb-5">
            <h1 class="display-5 fw-bold text-dark mb-2">{{ number_format($averageRating, 1) }}</h1>
            <div class="mb-2">
                @for($i = 1; $i <= 5; $i++)
                    <i class="fa {{ $i <= round($averageRating) ? 'fa-star text-warning' : 'fa-star-o text-muted' }}" style="font-size: 22px;"></i>
                @endfor
            </div>
            <p class="text-secondary small">Based on {{ $reviews->total() }} reviews</p>
        </div>

        <!-- Hidden Review Form -->
        <div id="reviewFormContainer" class="card border-0 shadow-sm p-4 mb-5 rounded-4" style="display:none;">
            <h5 class="fw-semibold mb-3 text-center text-dark">Write Your Review</h5>
            <form method="POST" action="{{ route('reviews.store', ['product' => $product->id]) }}">

                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Rating</label>
                    <div id="ratingStars" class="fs-4 text-warning">
                        @for($i = 1; $i <= 5; $i++)
                            <i class="fa fa-star-o" data-value="{{ $i }}" style="cursor:pointer;"></i>
                        @endfor
                    </div>
                    <input type="hidden" name="rating" id="ratingInput" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Comment</label>
                    <textarea name="comment" rows="3" class="form-control" placeholder="Write your feedback..." required></textarea>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-danger px-5 fw-semibold">Submit Review</button>
                </div>
            </form>
        </div>

        <!-- Reviews Grid -->
        <div class="row g-4">
            @forelse($reviews as $review)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-sm h-100 rounded-4 p-3">
                        <div class="d-flex align-items-center mb-3">
                            <div class="avatar bg-light rounded-circle me-3 d-flex align-items-center justify-content-center" style="width:45px; height:45px;">
                                @if(isset($review->user) && $review->user->profile_photo)
                                    <img src="{{ asset('storage/'.$review->user->profile_photo) }}" class="rounded-circle" width="45" height="45" alt="User photo">
                                @else
                                    <span class="fw-bold text-secondary">{{ strtoupper(substr($review->user_name ?? 'U', 0, 1)) }}</span>
                                @endif
                            </div>
                            <div>
                                <h6 class="mb-0 fw-semibold">{{ $review->user_name ?? 'Anonymous' }}</h6>
                                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        <div class="mb-2">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fa {{ $i <= $review->rating ? 'fa-star text-warning' : 'fa-star-o text-muted' }}"></i>
                            @endfor
                        </div>
                        <p class="text-dark mb-0">{{ $review->comment }}</p>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p class="text-muted mb-0">No reviews yet. Be the first to write one!</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $reviews->links('pagination::bootstrap-4') }}
        </div>
    </div>
</section>

<style>
.reviews-section .card {
    transition: all 0.2s ease;
}
.reviews-section .card:hover {
    transform: translateY(-4px);
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
}
</style>

<script>
// Toggle review form
document.getElementById('writeReviewBtn').addEventListener('click', function () {
    const form = document.getElementById('reviewFormContainer');
    if (form.style.display === 'none') {
        form.style.display = 'block';
        form.scrollIntoView({ behavior: 'smooth' });
    } else {
        form.style.display = 'none';
    }
});

// Star rating interaction
const stars = document.querySelectorAll('#ratingStars i');
const ratingInput = document.getElementById('ratingInput');

stars.forEach(star => {
    star.addEventListener('click', function () {
        const value = this.getAttribute('data-value');
        ratingInput.value = value;
        stars.forEach(s => {
            s.classList.remove('fa-star');
            s.classList.add('fa-star-o');
        });
        for (let i = 0; i < value; i++) {
            stars[i].classList.add('fa-star');
            stars[i].classList.remove('fa-star-o');
        }
    });
});
</script>
