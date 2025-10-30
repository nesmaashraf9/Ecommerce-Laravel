<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="">
      <title>Checkout - Ecommerce</title>
      <link rel="stylesheet" type="text/css" href="{{ asset('home/css/bootstrap.css') }}" />
      <link href="{{ asset('home/css/font-awesome.min.css') }}" rel="stylesheet" />
      <link href="{{ asset('home/css/style.css') }}" rel="stylesheet" />
      <link href="{{ asset('home/css/responsive.css') }}" rel="stylesheet" />
      <script src="https://js.stripe.com/v3/"></script>
      <style>
        .checkout_section { padding: 60px 0; }
        .card { margin-bottom: 30px; border: none; box-shadow: 0 0 15px rgba(0,0,0,0.1); }
        .card-header { 
            background: #f7444e; 
            color: #fff; 
            font-weight: 600; 
            padding: 15px 20px; 
            border-radius: 5px 5px 0 0 !important; 
        }
        .card-body { padding: 25px; }
        .form-label { font-weight: 500; margin-bottom: 8px; }
        .form-control { 
            padding: 10px 15px; 
            border-radius: 4px; 
            border: 1px solid #ddd; 
        }
        .form-control:focus {
            border-color: #f7444e;
            box-shadow: 0 0 0 0.2rem rgba(247, 68, 78, 0.25);
        }
        .btn-checkout { 
            background: #f7444e; 
            color: white; 
            padding: 12px 30px; 
            font-weight: 600; 
            border: none;
            transition: all 0.3s;
        }
        .btn-checkout:hover { 
            background: #e63a42; 
            color: white;
            transform: translateY(-2px);
        }
        .order-summary { 
            background: #f9f9f9; 
            padding: 20px; 
            border-radius: 5px; 
        }
        .order-summary h5 { 
            border-bottom: 1px solid #eee; 
            padding-bottom: 10px; 
            margin-bottom: 20px; 
        }
        .order-summary-item { 
            display: flex; 
            justify-content: space-between; 
            margin-bottom: 10px; 
        }
        .order-total { 
            font-size: 18px; 
            font-weight: 600; 
            color: #f7444e; 
            border-top: 1px solid #eee; 
            padding-top: 15px; 
            margin-top: 15px; 
        }
        #card-details {
            padding: 15px;
            background: #f9f9f9;
            border-radius: 5px;
            margin: 15px 0;
            display: none;
        }
        .heading_container {
            text-align: center;
            margin-bottom: 40px;
        }
        .heading_container h2 {
            font-weight: 600;
            color: #222;
            margin-bottom: 20px;
        }
        .heading_container h2 span {
            color: #f7444e;
        }
      </style>
   </head>
   <body>
      @include('home.header')
      
      <section class="checkout_section">
         <div class="container">
            <div class="heading_container">
               <h2>Checkout <span>Details</span></h2>
            </div>
            
            <div class="row">
               <div class="col-md-8">
                  <div class="card">
                     <div class="card-header">
                        <h4 class="mb-0">Billing Details</h4>
                     </div>
                     <div class="card-body">
                        <!-- Main Form for Order Details -->
                        <div id="order-details-form">
                           <div class="row">
                              <div class="col-md-6 mb-3">
                                 <label class="form-label">First Name *</label>
                                 <input type="text" class="form-control" name="first_name" id="first_name" required 
                                        value="{{ $user->first_name ?? $user->name ?? old('first_name') }}">
                              </div>
                              <div class="col-md-6 mb-3">
                                 <label class="form-label">Last Name *</label>
                                 <input type="text" class="form-control" name="last_name" id="last_name" required 
                                        value="{{ $user->last_name ?? old('last_name') }}">
                              </div>
                           </div>
                           <div class="mb-3">
                              <label class="form-label">Email Address *</label>
                              <input type="email" class="form-control" name="email" id="email" required 
                                     value="{{ $user->email ?? old('email') }}">
                           </div>
                           <div class="mb-3">
                              <label class="form-label">Phone *</label>
                              <input type="text" class="form-control" name="phone" id="phone" required 
                                     value="{{ $user->phone ?? old('phone') }}">
                           </div>
                           <div class="mb-3">
                              <label class="form-label">Address *</label>
                              <input type="text" class="form-control" name="address" id="address" required 
                                     value="{{ $user->address ?? old('address') }}">
                           </div>
                           <div class="row">
                              <div class="col-md-6 mb-3">
                                 <label class="form-label">City *</label>
                                 <input type="text" class="form-control" name="city" id="city" required 
                                        value="{{ $user->city ?? old('city') }}">
                              </div>
                              <div class="col-md-6 mb-3">
                                 <label class="form-label">State *</label>
                                 <input type="text" class="form-control" name="state" id="state" required 
                                        value="{{ $user->state ?? old('state') }}">
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6 mb-3">
                                 <label class="form-label">ZIP Code *</label>
                                 <input type="text" class="form-control" name="zip_code" id="zip_code" required 
                                        value="{{ $user->zip_code ?? old('zip_code') }}">
                              </div>
                              <div class="col-md-6 mb-3">
                                 <label class="form-label">Country *</label>
                                 <input type="text" class="form-control" name="country" id="country" required 
                                        value="{{ $user->country ?? old('country') ?? 'United States' }}">
                              </div>
                           </div>
                           <div class="mb-3">
                              <label class="form-label">Order Notes (Optional)</label>
                              <textarea class="form-control" name="notes" id="notes" rows="4" 
                                        placeholder="Notes about your order, e.g. special notes for delivery">{{ old('notes') }}</textarea>
                           </div>
                           
                           <h5 class="mb-3">Payment Method</h5>
                           <div class="form-check mb-3">
                              <input class="form-check-input" type="radio" name="payment_method" id="cod" value="cod" checked>
                              <label class="form-check-label" for="cod">
                                 Cash on Delivery
                              </label>
                           </div>
                           <div class="form-check mb-3">
                              <input class="form-check-input" type="radio" name="payment_method" id="card" value="card">
                              <label class="form-check-label" for="card">
                                 Credit/Debit Card (Stripe)
                              </label>
                           </div>
                           
                           <!-- Stripe Payment Form (initially hidden) -->
                           <div id="stripe-payment-form" style="display: none; margin: 20px 0;">
                              <div class="mb-3">
                                 <label class="form-label">Name on Card <span class="text-danger">*</span></label>
                                 <input type="text" id="cardholder-name" class="form-control mb-3" placeholder="Full name as shown on card" required>
                              </div>
                              <div class="mb-3">
                                 <label class="form-label">Card Details <span class="text-danger">*</span></label>
                                 <div id="card-element" class="form-control" style="padding: 10px; min-height: 40px;"></div>
                                 <div id="card-errors" role="alert" style="color: #dc3545; margin-top: 5px;"></div>
                              </div>
                              <button type="button" id="stripe-submit-btn" class="btn btn-primary w-100">
                                 <span class="btn-text">Pay ${{ number_format($total, 2) }} with Stripe</span>
                                 <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                              </button>
                           </div>
                           
                           <!-- Cash on Delivery Submit Button (shown by default) -->
                           <button type="button" id="cod-submit-btn" class="btn btn-checkout btn-lg w-100">
                              Place Order (Cash on Delivery)
                           </button>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="col-md-4">
                  <div class="card">
                     <div class="card-header">
                        <h4 class="mb-0">Your Order</h4>
                     </div>
                     <div class="card-body">
                        <div class="order-summary">
                           <h5>Order Summary</h5>
                           @foreach($cart as $id => $item)
                              <div class="order-summary-item">
                                 <span>{{ $item['name'] }} x {{ $item['quantity'] }}</span>
                                 <span>${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                              </div>
                           @endforeach
                           <div class="order-summary-item">
                              <span>Subtotal</span>
                              <span>${{ number_format($subtotal, 2) }}</span>
                           </div>
                           <div class="order-summary-item">
                              <span>Tax (15%)</span>
                              <span>${{ number_format($tax, 2) }}</span>
                           </div>
                           <div class="order-summary-item">
                              <span>Shipping</span>
                              <span>${{ number_format($shipping, 2) }}</span>
                           </div>
                           <div class="order-summary-item order-total">
                              <span>Total</span>
                              <span>${{ number_format($total, 2) }}</span>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>

      @include('home.footer')
      
      <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
      <script src="{{ asset('home/js/popper.min.js') }}"></script>
      <script src="{{ asset('home/js/bootstrap.js') }}"></script>
      <script src="{{ asset('home/js/custom.js') }}"></script>
      
      <script>
         // Initialize Stripe
         const stripe = Stripe('{{ env('STRIPE_KEY') }}');
         const elements = stripe.elements();

         // Create card element
         const cardElement = elements.create('card', {
             style: {
                 base: {
                     fontSize: '16px',
                     color: '#32325d',
                     '::placeholder': {
                         color: '#aab7c4'
                     }
                 },
                 invalid: {
                     color: '#dc3545',
                     iconColor: '#dc3545'
                 }
             }
         });

         // Mount card element
         const cardElementContainer = document.getElementById('card-element');
         if (cardElementContainer) {
             cardElement.mount('#card-element');
         }

         // Handle Cash on Delivery form submission
         $(document).on('click', '#cod-submit-btn', function() {
             const $form = $('<form>').attr({
                 action: '{{ route('checkout.store') }}',
                 method: 'POST'
             }).append($('<input>').attr('type', 'hidden').attr('name', '_token').val('{{ csrf_token() }}'));

             // Add all form data
             $form.append($('<input>').attr('type', 'hidden').attr('name', 'payment_method').val('cod'));
             
             // Add all other form fields
             const fields = ['first_name', 'last_name', 'email', 'phone', 'address', 'city', 'state', 'zip_code', 'country', 'notes'];
             fields.forEach(field => {
                 const value = $(`#${field}`).val();
                 if (value) {
                     $form.append($('<input>').attr('type', 'hidden').attr('name', field).val(value));
                 }
             });

             // Submit the form
             $('body').append($form);
             $form.submit();
         });

         // Handle Stripe payment
         $(document).on('click', '#stripe-submit-btn', async function() {
            const $submitBtn = $(this);
            const $btnText = $submitBtn.find('.btn-text');
            const $spinner = $submitBtn.find('.spinner-border');
            const $errorElement = $('#card-errors');
            
            // Get cardholder name
            const cardholderName = $('#cardholder-name').val().trim();
            if (!cardholderName) {
                $errorElement.text('Please enter the name on your card');
                return;
            }
            
            // Disable button and show loading state
            $submitBtn.prop('disabled', true);
            $btnText.text('Processing...');
            $spinner.removeClass('d-none');
            $errorElement.text(''); // Clear previous errors
            
            try {
                // Create Stripe token with cardholder name and billing details
                const { token, error } = await stripe.createToken(cardElement, {
                    name: cardholderName,
                    address_line1: $('#address').val(),
                    address_city: $('#city').val(),
                    address_state: $('#state').val(),
                    address_zip: $('#zip_code').val(),
                    address_country: $('#country').val()
                });
                
                if (error) {
                    $errorElement.text(error.message);
                    $submitBtn.prop('disabled', false).text('Pay ${{ number_format($total, 2) }} with Stripe');
                    return;
                }
                
                // Collect all form data
                const formData = {
                    _token: '{{ csrf_token() }}',
                    stripeToken: token.id,
                    amount: '{{ $total }}',
                    payment_method: 'card'
                };
                
                // Add all other form fields
                const fields = ['first_name', 'last_name', 'email', 'phone', 'address', 'city', 'state', 'zip_code', 'country', 'notes'];
                fields.forEach(field => {
                    const value = $(`#${field}`).val();
                    if (value) {
                        formData[field] = value;
                    }
                });
                
                // Submit the form via AJAX
                $.ajax({
                    url: '{{ route('process.stripe.payment') }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        } else if (response.order_id) {
                            // Build the URL manually to avoid Laravel route generation
                            const baseUrl = window.location.origin;
                            window.location.href = `${baseUrl}/order-confirmation/${response.order_id}`;
                        } else {
                            // Fallback to home if no order ID is provided
                            window.location.href = '/';
                        }
                    },
                    error: function(xhr) {
                        let errorMessage = 'An error occurred. Please try again.';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            errorMessage = xhr.responseJSON.message;
                        } else if (xhr.responseText) {
                            try {
                                const response = JSON.parse(xhr.responseText);
                                errorMessage = response.message || errorMessage;
                            } catch (e) {
                                errorMessage = xhr.responseText || errorMessage;
                            }
                        }
                        $errorElement.text(errorMessage);
                        $submitBtn.prop('disabled', false).text('Pay ${{ number_format($total, 2) }} with Stripe');
                    }
                });
                
            } catch (error) {
                console.error('Error:', error);
                $errorElement.text('An error occurred. Please try again.');
                $submitBtn.prop('disabled', false).text('Pay ${{ number_format($total, 2) }} with Stripe');
            }
         });

         // Show/hide Stripe form based on payment method selection
         $(document).ready(function() {
             $('input[name="payment_method"]').change(function() {
                 if ($(this).val() === 'card') {
                     $('#stripe-payment-form').slideDown();
                     $('#cod-submit-btn').hide();
                 } else {
                     $('#stripe-payment-form').slideUp();
                     $('#cod-submit-btn').show();
                 }
             });
             
             // Initialize to hide Stripe form if card is not selected
             if ($('input[name="payment_method"]:checked').val() !== 'card') {
                 $('#stripe-payment-form').hide();
             } else {
                 $('#cod-submit-btn').hide();
             }
         });
      </script>
   </body>
</html>