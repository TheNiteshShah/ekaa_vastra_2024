@extends('frontend.base_template')
@section('title', 'Contact Us - Ekaa Vastra')
@section('main')
<!-- breadcrumb-section start -->
<nav class="breadcrumb-section theme1 breadcrumb-bg1">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-title text-center my-20">
                    <h2 class="title text-dark text-capitalize">Contact Us</h2>
                </div>
            </div>
            <div class="col-12">
                <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                    <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                </ol>
            </div>
        </div>
    </div>
</nav>
<!-- breadcrumb-section end -->

<section class="contact-section pt-70 pb-40">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-12 mb-30">
                <!--  contact page side content  -->
                <div class="contact-page-side-content">
                    <h3 class="contact-page-title">We're Here to Help!</h3>
                    <p class="contact-page-message mb-30">At Ekaa Vastra, we value our customers and are committed to providing excellent service. Whether you have questions about our products, need assistance with an order, or simply want to share feedback, we're here to listen and help.</p>
                    <!--  single contact block  -->

                    <div class="single-contact-block">
                        <h4><i class="fa fa-fax"></i> Address</h4>
                        <p>Sunshine Aditya, Maharana Pratap Road, Sirsi, Jaipur, Rajasthan, 302012</p>
                    </div>

                    <!--  End of single contact block -->

                    <!--  single contact block -->

                    <div class="single-contact-block">
                        <h4><i class="fa fa-phone"></i> Phone</h4>
                        <p>
                            <a href="tel:9636373743">Mobile: (+91) 9636373743</a>
                        </p>
                    </div>

                    <!-- End of single contact block -->

                    <!--  single contact block -->

                    <div class="single-contact-block">
                        <h4><i class="fas fa-envelope"></i> Email</h4>
                        <p>
                            <a href="mailto:ekaavastra@gmail.com">ekaavastra@gmail.com</a>
                        </p>
                    </div>

                    <!--=======  End of single contact block  =======-->
                </div>

                <!--=======  End of contact page side content  =======-->

            </div>
            <div class="col-lg-6 col-12 mb-30">
                <!--  contact form content -->
                <div class="contact-form-content">
                    <h3 class="contact-page-title">Tell Us Your Message</h3>
                    <div class="contact-form">
                        <form action="{{route('contact-us-store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Your Name <span class="required">*</span></label>
                                <input type="text" name="customerName" id="customername" required="" value="{{old('customerName') ? old('customerName') : ''}}" class="@error('customerName') is-invalid @enderror">
                                @error('customerName')
                                <div style="color:red">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Your Email <span class="required">*</span></label>
                                <input type="email" name="customerEmail" id="customerEmail" required="" class="@error('customerEmail') is-invalid @enderror" value="{{old('customerEmail') ? old('customerEmail') : ''}}">
                                @error('customerEmail')
                                <div style="color:red">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Phone <span class="required">*</span></label>
                                <input type="text" maxlength="10" minlength="10" name="customerPhone" id="contactPhone" required="" onkeypress="return isNumberKey(event)" class="@error('contactPhone') is-invalid @enderror" value="{{old('contactPhone') ? old('contactPhone') : ''}}">
                                @error('customerPhone')
                                <div style="color:red">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Your Message <span class="required">*</span></label>
                                <textarea name="customerMessage" class="pb-10" id="customerMessage" required="" class="@error('customerMessage') is-invalid @enderror">{{old('customerMessage') ? old('customerMessage') : ''}}</textarea>
                                @error('customerMessage')
                                <div style="color:red">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="g-recaptcha" data-sitekey="6LffcxsqAAAAAFtr6nyQTZP1GyRHkxNmqp8TMQYN"></div>
                            @error('g-recaptcha-response')
                            <div style="color:red">{{ $message }}</div>
                            @enderror
                            <div class="form-group mb-0 mt-2">
                                <button type="submit" value="submit" id="submit" class="btn theme-btn--dark1 btn--xl" name="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                    <p class="form-messegemt-10"></p>
                </div>
                <!-- End of contact -->
            </div>
        </div>
    </div>
</section>
<!-- map start -->
<div class="map">
    <div id="mapid">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3557.8188297694805!2d75.68695337527143!3d26.909244276649286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x396c4d55bed46d29%3A0x9e74945379c7387c!2sEkaa%20Vastra!5e0!3m2!1sen!2sin!4v1712518211471!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>
<!-- map end -->
@endsection