@extends('frontend.base_template')
@section('title', 'Return & Refund Policy - Ekaa Vastra')
@section('main')
<!-- breadcrumb-section start -->
<nav class="breadcrumb-section theme1 breadcrumb-bg1">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-title text-center my-20">
                    <h2 class="title text-dark text-capitalize">Return & Refund Policy</h2>
                </div>
            </div>
            <div class="col-12">
                <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                    <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Return & Refund Policy</li>
                </ol>
            </div>
        </div>
    </div>
</nav>
<!-- breadcrumb-section end -->
<!-- product tab start -->
<section class="whish-list-section theme1 pb-70">
    <div class="container grid-wraper">
        <h5 class="title mb-20">Return, Refund, Exchange and Cancellation Policy</h5>
        <p class="mb-20 text-justify">Thank you for choosing Ekaa Vastra for your shopping needs. We are dedicated to providing you with a seamless experience and ensuring your satisfaction with every purchase. Please review our Return, Refund, Exchange and Cancellation Policy below to understand your options regarding your purchases.</p>
        <h5 class="title mb-20">Return & Refund Policy:</h5>
        <p class="mb-20 text-justify"><b>Defective Products:</b> We accept return requests for defective products within 48 hours of delivery. Please raise a return request within this timeframe to receive a refund.</p>
        <p class="mb-20 text-justify">NOTE - If you're unable to raise a return request from our website due to some unexpected reason, please email us at ekaavastra@gmail.com within 48 hours of delivery.</p>
        <p class="mb-20 text-justify">Important: Please note that we will not be able to accept return requests for defective products post 48 hours of delivery. No exceptions will be made.</p>
        <p class="mb-20 text-justify">Please act promptly to ensure a smooth return process.</p>
        <p class="mb-20 text-justify"><b>Non-Defective Products:</b> Please note that we do not offer refunds for non-defective products. However, we can provide store credit equivalent to the order value, subject to the following conditions:</p>
        <ul class="mb-20" style="list-style-type: circle;">
            <li>Return requests must be made within 7 days of delivery.</li>
            <li>You will have to pay the return shipping costs, which will be calculated based on the parcel weight and distance.</li>
            <li>Once we receive the product in its original condition, we will issue store credit equivalent to the order value</li>
        </ul>
        <p class="mb-20 text-justify"><b>Credit Points:</b> The credit points will be reflected in your Ekaa Vastra wallet within 4-5 days after we receive the returned products. You can read more about credit points here</p>
        <h5 class="title mb-20">Size Exchange Policy:</h5>
        <p class="mb-20 text-justify">To request a size replacement:</p>
        <ul class="mb-20" style="list-style-type: circle;">
            <li>Go to your Recent Orders page and raise a return/exchange request for the selected item.</li>
            <li>Our team will review your request and contact you if necessary.</li>
        </ul>
        <p class="mb-20 text-justify">Please note:</p>
        <p class="mb-10 text-justify">Size exchange is subject to product availability. If the desired size is not available, we cannot process the exchange.</p>
        <ul class="mb-20" style="list-style-type: circle;">
        <li >In this case, you can return the product and receive store credits.</li>
        <li >If your exchange request is accepted, you will be required to pay the reverse shipping fee in the order section.</li>
        <li >Once paid, our delivery agent will pick up the exchangeable product(s) within 7-9 days.</li>
        <li >After receiving your parcel, we will dispatch the required size within 5-7 days.</li>
        </ul>
       
        <p class="mb-20 text-justify">We aim to make size exchanges as smooth as possible, but please be aware of the dependencies on product availability."</p>
        <h5 class="title mb-20">Cancellation Policy:</h5>
        <p class="mb-20 text-justify">You can cancel your order online until it is <b>dispatched</b>. Simply go to 'Your Orders', select the order, and click 'Cancel My Order' before the status shows <b>'Dispatched'</b>. No further action is required.</p>
        <p class="mb-20 text-justify">For prepaid orders, the amount will be refunded to your original payment method or transferred to your bank account, typically within 3-5 business days, after cancellation.</p>
        
       
        <p class="mb-20 text-justify">If you have any further questions or concerns regarding our policies, please do not hesitate to contact us using the provided methods. Thank you for shopping with us!</p>
    </div>

</section>
<!-- product tab end -->
@endsection