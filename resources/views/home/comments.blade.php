<section class="client_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>Customer <span>Comments</span></h2>
        </div>
    </div>
    <div class="container px-0">
        <div id="customCarousel2" class="carousel slide" data-ride="carousel">
            <div class="comment-box">
                <!-- Comment Form -->
                <div class="comment-form mb-5 text-center">
                    <div class="form-group">
                        <textarea class="form-control comment-content" rows="3" placeholder="Share your thoughts..." style="max-width: 800px; margin: 0 auto; border-radius: 20px; padding: 15px;"></textarea>
                    </div>
                    <button type="button" class="btn btn-danger mt-2 post-comment" style="background: #f7444e; border: none; border-radius: 20px; padding: 8px 30px; font-weight: 500;">
                        Post Comment
                    </button>
                    <div class="login-message mt-2" style="display: none;">
                        Please <a href="{{ route('login') }}" style="color: #f7444e;">login</a> to post a comment.
                    </div>
                </div>

                <!-- Comments Carousel -->
                <div class="position-relative">
                    <div id="commentsCarousel" class="carousel slide" data-ride="carousel" data-interval="false">
                        <div class="carousel-inner comments-list">
                            <!-- Comments will be loaded here via JavaScript -->
                            <div class="text-center loading-comments py-5">
                                <div class="spinner-border text-danger" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Controls -->
                    <a class="carousel-control-prev carousel-control-custom" href="#commentsCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next carousel-control-custom" href="#commentsCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Reply Modal -->
<div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="border-radius: 15px; border: none;">
            <div class="modal-header" style="border: none;">
                <h5 class="modal-title" id="replyModalLabel" style="color: #f7444e;">Reply to Comment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #f7444e;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <textarea class="form-control reply-content" rows="3" placeholder="Write your reply..." style="border-radius: 10px;" required></textarea>
                </div>
            </div>
            <div class="modal-footer" style="border: none;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 20px; padding: 5px 20px;">Close</button>
                <button type="button" class="btn btn-primary post-reply" style="background: #f7444e; border: none; border-radius: 20px; padding: 5px 20px;">Post Reply</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    let currentCommentId = null;
    const csrfToken = $('meta[name="csrf-token"]').attr('content');
    
    // Check if user is logged in
    const isLoggedIn = {{ auth()->check() ? 'true' : 'false' }};
    
    // Show login message if not logged in
    if (!isLoggedIn) {
        $('.login-message').show();
    }

    // Load comments
    function loadComments() {
        $('.loading-comments').show();
        $.ajax({
            url: '/comments',
            method: 'GET',
            success: function(response) {
                $('.comments-list').html(formatComments(response));
            },
            error: function(xhr) {
                console.error('Error loading comments:', xhr);
                $('.comments-list').html('<div class="alert alert-danger">Error loading comments. Please refresh the page.</div>');
            },
            complete: function() {
                $('.loading-comments').hide();
            }
        });
    }

    // Format comments and replies
    function formatComments(comments) {
        if (comments.length === 0) {
            return `
                <div class="carousel-item active">
                    <div class="no-comments text-center p-4">
                        <i class="far fa-comment-dots" style="font-size: 2rem; color: #f7444e; margin-bottom: 10px;"></i>
                        <p>No comments yet. Be the first to share your thoughts!</p>
                    </div>
                </div>`;
        }

        let html = '';
        let isFirst = true;
        comments.forEach(comment => {
            const commentDate = new Date(comment.created_at);
            const formattedDate = commentDate.toLocaleDateString('en-US', { 
                year: 'numeric', 
                month: 'short', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });

            // Add carousel item class and active for the first item
            const activeClass = isFirst ? 'carousel-item active' : 'carousel-item';
            isFirst = false;

            html += `
                <div class="${activeClass}">
                    <div class="comment-card" id="comment-${comment.id}">
                    <div class="comment-header">
                        <h6 class="comment-user">
                            <i class="fas fa-user-circle me-2"></i>${comment.user_name}
                        </h6>
                        <span class="comment-date">${formattedDate}</span>
                    </div>
                    <div class="comment-content">
                        ${comment.content}
                    </div>
                    <div class="comment-actions">
                        <button class="reply-btn" data-comment-id="${comment.id}">
                            <i class="fas fa-reply"></i> Reply
                        </button>
                        ${comment.user_id === {{ Auth::id() ?? 0 }} ? `
                            <button class="delete-comment" data-comment-id="${comment.id}">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        ` : ''}
                    </div>
                    
                    <!-- Replies -->
                    <div class="replies">
                        ${comment.replies && comment.replies.length > 0 ? 
                            comment.replies.map(reply => formatReply(reply)).join('') : 
                            ''
                        }
                        </div>
                    </div>
                </div>
            `;
        });
        return html;
    }

    // Format reply
    function formatReply(reply) {
        const replyDate = new Date(reply.created_at);
        const formattedDate = replyDate.toLocaleDateString('en-US', { 
            year: 'numeric', 
            month: 'short', 
            day: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });

        return `
            <div class="reply-card" id="reply-${reply.id}">
                <div class="comment-header">
                    <h6 class="comment-user" style="font-size: 0.9rem;">
                        <i class="fas fa-reply me-2" style="transform: scaleX(-1);"></i>${reply.user_name}
                    </h6>
                    <span class="comment-date" style="font-size: 0.8rem;">${formattedDate}</span>
                </div>
                <div class="comment-content" style="font-size: 0.95rem; margin-bottom: 10px;">
                    ${reply.content}
                </div>
                ${reply.user_id === {{ Auth::id() ?? 0 }} ? `
                    <div class="comment-actions">
                        <button class="delete-reply text-danger" data-reply-id="${reply.id}" style="font-size: 0.8rem;">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </div>
                ` : ''}
            </div>
        `;
    }

    // Post comment
    $(document).on('click', '.post-comment', function(e) {
        e.preventDefault();
        
        if (!isLoggedIn) {
            window.location.href = '{{ route("login") }}';
            return;
        }

        const $commentBtn = $(this);
        const $commentContent = $('.comment-content');
        const content = $commentContent.val().trim();
        
        if (!content) {
            alert('Please enter a comment');
            return;
        }

        console.log('Attempting to post comment...');
        $commentBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Posting...');

        $.ajax({
            url: '{{ url("/comments") }}',
            type: 'POST',
            data: {
                _token: csrfToken,
                content: content
            },
            dataType: 'json',
            success: function(response) {
                console.log('Comment posted successfully:', response);
                $commentContent.val('');
                loadComments();
            },
            error: function(xhr, status, error) {
                console.error('Error posting comment:', {
                    status: xhr.status,
                    statusText: xhr.statusText,
                    responseText: xhr.responseText,
                    error: error
                });
                
                if (xhr.status === 401) {
                    window.location.href = '{{ route("login") }}';
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    alert('Error: ' + xhr.responseJSON.message);
                } else {
                    alert('Failed to post comment. Please check the console for more details.');
                }
            },
            complete: function() {
                $commentBtn.prop('disabled', false).html('Post Comment');
            }
        });
    });

    // Open reply modal
    $(document).on('click', '.reply-btn', function() {
        currentCommentId = $(this).data('comment-id');
        $('#replyModal').modal('show');
    });

    // Post reply
    $('.post-reply').click(function() {
        const content = $('.reply-content').val().trim();
        if (!content) return;

        $.ajax({
            url: `/comments/${currentCommentId}/replies`,
            type: 'POST',
            data: {
                _token: csrfToken,
                content: content
            },
            success: function(response) {
                $('.reply-content').val('');
                $('#replyModal').modal('hide');
                loadComments();
            },
            error: function(xhr) {
                if (xhr.status === 401) {
                    alert('Please login to post a reply.');
                    window.location.href = '{{ route("login") }}';
                } else {
                    alert('Error posting reply. Please try again.');
                }
            }
        });
    });

    // Delete comment
    $(document).on('click', '.delete-comment', function() {
        if (!confirm('Are you sure you want to delete this comment?')) return;
        
        const commentId = $(this).data('comment-id');
        
        $.ajax({
            url: `/comments/${commentId}`,
            type: 'DELETE',
            data: { _token: csrfToken },
            success: function() {
                $(`#comment-${commentId}`).fadeOut(300, function() {
                    $(this).remove();
                    if ($('.comments-list .card').length === 0) {
                        $('.comments-list').html('<div class="no-comments">No comments yet. Be the first to comment!</div>');
                    }
                });
            },
            error: function() {
                alert('Error deleting comment. Please try again.');
            }
        });
    });

    // Delete reply
    $(document).on('click', '.delete-reply', function() {
        if (!confirm('Are you sure you want to delete this reply?')) return;
        
        const replyId = $(this).data('reply-id');
        
        $.ajax({
            url: `/comments/replies/${replyId}`,
            type: 'DELETE',
            data: { _token: csrfToken },
            success: function() {
                $(`#reply-${replyId}`).fadeOut(300, function() {
                    $(this).remove();
                });
            },
            error: function() {
                alert('Error deleting reply. Please try again.');
            }
        });
    });

    // Initialize tooltips
    $(document).on('mouseenter', '[data-toggle="tooltip"]', function() {
        $(this).tooltip('show');
    });

    // Handle Enter key in comment textarea
    $(document).on('keypress', '.comment-content', function(e) {
        if (e.which === 13 && !e.shiftKey) {
            e.preventDefault();
            $('.post-comment').click();
        }
    });

    // Load comments on page load
    loadComments();
});
</script>
<style>
/* Comments Section Styling */
.position-relative {
    position: relative;
    padding: 0 60px;
}

.carousel-control-custom {
    position: absolute;
    top: 50%;
    width: 40px;
    height: 40px;
    background: #f7444e;
    border-radius: 50%;
    opacity: 1;
    transform: translateY(-50%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.carousel-control-prev.carousel-control-custom {
    left: 0;
}

.carousel-control-next.carousel-control-custom {
    right: 0;
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    width: 20px;
    height: 20px;
    background-size: 20px;
}

#commentsCarousel {
    padding: 0;
}

.comment-box {
    background: #fff;
    padding: 30px 0;
    border-radius: 8px;
}

.comment-form textarea {
    resize: none;
    border: 1px solid #e1e1e1;
    transition: all 0.3s;
}

.comment-form textarea:focus {
    border-color: #f7444e;
    box-shadow: 0 0 0 0.2rem rgba(247, 68, 78, 0.25);
}

.comment-card {
    background: #fff;
    border-radius: 10px;
    padding: 20px;
    margin: 0 15px 20px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    border-left: 4px solid #f7444e;
    min-height: 200px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.comment-header {
    display: flex;
    justify-content: space-between;
    margin-bottom: 10px;
    align-items: center;
}

.comment-user {
    font-weight: 600;
    color: #333;
    margin: 0;
}

.comment-date {
    color: #888;
    font-size: 0.85rem;
}

.comment-content {
    color: #555;
    margin-bottom: 15px;
}

.comment-actions {
    display: flex;
    gap: 15px;
}

.reply-btn, .delete-comment, .delete-reply {
    background: none;
    border: none;
    color: #f7444e;
    font-size: 0.85rem;
    cursor: pointer;
    padding: 0;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: all 0.3s;
}

.reply-btn:hover, .delete-comment:hover, .delete-reply:hover {
    color: #d43c45;
    text-decoration: none;
}

.replies {
    margin-top: 20px;
    padding-left: 30px;
    border-left: 2px solid #f0f0f0;
}

.reply-card {
    background: #f9f9f9;
    border-radius: 8px;
    padding: 15px;
    margin-bottom: 15px;
    position: relative;
}

.reply-card:before {
    content: '';
    position: absolute;
    left: -20px;
    top: 20px;
    width: 20px;
    height: 2px;
    background: #f0f0f0;
}

.no-comments {
    color: #888;
    font-style: italic;
    text-align: center;
    padding: 40px 20px;
    background: #f9f9f9;
    border-radius: 10px;
}

.loading-comments {
    padding: 40px 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .position-relative {
        padding: 0 40px;
    }
    
    .carousel-control-custom {
        width: 35px;
        height: 35px;
    }
    .replies {
        padding-left: 15px;
    }
    
    .reply-card:before {
        left: -15px;
    }
}
</style>
