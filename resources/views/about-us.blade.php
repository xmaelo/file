@php $id = 'about'; @endphp

@extends('layouts.layout')

@section('title')
About Us
@endsection

@section('content')
<div class="container mt-5 pt-5">
    <nav class="pt-md-3 mb-3" aria-label="Breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">About us</li>
        </ol>
    </nav>
</div>
<section class="pb-lg-5 container mb-5">
    <div class="row align-items-center justify-content-lg-start justify-content-center flex-lg-nowrap gy-4">
        <div class="col-lg-9">
            <img class="rounded-3" src="/assets/images/about-us-hero-img.jpg" alt="hero">
        </div>
        <div class="col-lg-4 ms-lg-n5 col-sm-9 text-lg-start text-center">
            <div class="ms-lg-n5 pe-xl-5 bg-gradient rounded p-3">
                <h1 class="mb-lg-4 text-light">About us</h1>
                <p class="fs-lg text-light opacity-70">We believe that car buying and selling should be straight-forward and enjoyable, not time-consuming, complicated or stressful.</p>
            </div>
        </div>
    </div>
</section>
<section class="pb-lg-5 container mb-5">
    <h2 class="mb-4 pb-2 text-center">We are new and growing fast</h2>
    <div class="tns-carousel-wrapper tns-nav-outside">
        <div class="tns-carousel-inner" data-carousel-options='{
                        "items": 3,
                        "responsive": {
                            "0": {
                                "items": 1,
                                "gutter": 16,
                                "controls": false
                            },
                            "500": {
                                "items": 2,
                                "gutter": 18
                            },
                            "900": {
                                "items": 3,
                                "gutter": 20
                            },
                            "1100": {
                                "gutter": 24
                            }
                        }
                    }'>
            <div>
                <div class="card card-hover h-100">
                    <div class="card-body icon-box text-center">
                        <div class="icon-box-media d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 4.5rem; height: 4.5rem;">
                            <img src="/assets/images/car-icon.svg" alt="car icon">
                        </div>
                        <h4 class="card-title">1+ million cars</h4>
                        <p class="card-text fs-sm opacity-70">Fringilla vivamus arcu faucibus malesuada. Dui aenean suspendisse a aliquet id gravida ut. Lorem lacinia sed mauris erat at nisl.</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="card card-hover h-100">
                    <div class="card-body icon-box text-center">
                        <div class="icon-box-media d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 4.5rem; height: 4.5rem;">
                            <img src="/assets/images/building-icon.svg" alt="building icon">
                        </div>
                        <h4 class="card-title">5 subsidiaries</h4>
                        <p class="card-text fs-sm opacity-70">Porttitor bibendum pharetra volutpat est. Vitae tortor magna gravida non lacus. Arcu auctor malesuada dui congue.</p>
                    </div>
                </div>
            </div>
            <div>
                <div class="card card-hover h-100">
                    <div class="card-body icon-box text-center">
                        <div class="icon-box-media d-inline-flex align-items-center justify-content-center mx-auto mb-3" style="width: 4.5rem; height: 4.5rem;">
                            <img src="/assets/images/flag-icon.svg" alt="flag icon">
                        </div>
                        <h4 class="card-title">8+ countries</h4>
                        <p class="card-text fs-sm opacity-70">Duis tortor, vel nisi, leo vulputate sed quis. Ultrices arcu, amet aliquam id massa egestas ut. Dui, sed risus cursus magna dolor.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pb-lg-5 container mb-5">
    <div class="row gy-4 align-items-lg-center">
        <div class="col-md-6">
            <img class="rounded-3" src="/assets/images/personalized-search.jpg" alt="personalized search">
        </div>
        <div class="col-lg-5 offset-lg-1 col-md-6 text-md-start text-center">
            <h2 class="mb-md-4">Personalized search</h2>
            <p class="pb-md-3 mb-4 opacity-70">Ante senectus sed at lacus. Sed pellentesque dapibus nunc, cursus hendrerit at faucibus ornare lectus. Sed vitae congue mauris consectetur. Cursus tristique et porta eget sapien vivamus turpis. Ultrices vitae eget mattis varius ipsum adipiscing id. Neque, sagittis cursus aliquam volutpat tristique viverra amet amet.</p>
            <a class="btn btn-accent bg-gradient w-sm-auto w-100 border-0" href="/"><i class="fi-search me-2"></i>Search car</a>
        </div>
    </div>
</section>
<section class="pb-lg-5 container mb-5">
    <div class="row gy-4 align-items-lg-center">
        <div class="col-lg-5 col-md-6 order-md-1 text-md-start order-2 text-center">
            <h2 class="mb-md-4">Attractive selling conditions</h2>
            <p class="pb-md-3 mb-4 opacity-70">In risus quam diam urna, pretium at. Platea nulla malesuada elit, enim lacus quam. Rhoncus, tincidunt mauris quis fames in. A egestas sem quisque urna et imperdiet. Blandit dolor diam urna amet semper elementum ipsum et. Nulla mi ipsum quis et id tempor amet.</p>
            @if (session()->has('client_id'))
            <a class="btn btn-accent bg-gradient w-sm-auto w-100 border-0" href="/accounts/car/sell"><i class="fi-plus me-2"></i>Sell car</a>
            @endif
        </div>
        <div class="col-md-6 offset-lg-1 order-md-2 order-1">
            <img class="rounded-3" src="/assets/images/attractive-selling.jpg" alt="attractive selling">
        </div>
    </div>
</section>
@endsection