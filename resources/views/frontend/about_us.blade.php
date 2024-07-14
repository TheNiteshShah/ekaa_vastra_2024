@extends('frontend.base_template')
@section('main')
<!-- breadcrumb-section start -->
<nav class="breadcrumb-section theme1 breadcrumb-bg1">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-title text-center my-20">
                    <h2 class="title text-dark text-capitalize">About Us</h2>
                </div>
            </div>
            <div class="col-12">
                <ol class="breadcrumb bg-transparent m-0 p-0 align-items-center justify-content-center">
                    <li class="breadcrumb-item"><a href="{{route('/')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
                </ol>
            </div>
        </div>
    </div>
</nav>
<!-- breadcrumb-section end -->
<!-- product tab start -->
<section class="whish-list-section theme1 pb-70">
    <div class="container grid-wraper">
    <p class="mb-20 text-justify">Welcome to Ekaa Vastra, where fashion becomes a symphony of style, comfort, and creativity. Our brand is a canvas where individuality comes alive, and self-expression knows no bounds.</p>
    <p class="mb-20 text-justify">Founded in 2024, our journey began with a passion that burned bright, a desire to empower people to embrace their unique spirit through the clothes they wear. Our team of dreamers and designers pour their hearts into crafting pieces that not only make you look confident and stylish but also feel the beauty of high-quality craftsmanship.</p>
    <p class="mb-20 text-justify">Guided by our values of sustainability, inclusivity, quality, and creativity, we strive to create a world where fashion is a force for good. Our mission is to inspire you to be your best self, to wear your personality on your sleeve, and to proudly showcase your style to the world.
    </p>
    <p class="mb-20 text-justify">The story behind our name, Ekaa Vastra, is one of strength and beauty. Ekaa, meaning "one of its own kind," and Vastra, Hindi for "clothes," represent our commitment to uniqueness and individuality. Our founder's vision is to create a brand that celebrates the distinct beauty of each wearer, just like the multifaceted Goddess Durga, who inspires us with her strength, grace, and resilience.</p>
    <p class="mb-20 text-justify">Join us on this journey, where fashion becomes a celebration of the human spirit. Explore our collections, and discover the perfect pieces that reflect your personality, style, and the beauty that makes you, you.</p>
    <p class="mb-20 text-justify">Let's weave a tale of self-expression, one thread at a time.</p>
    </div>
</section>
<!-- product tab end -->
@endsection