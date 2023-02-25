@php $id = 'prices'; @endphp

@extends('layouts.layout')

@section('title')
Prices
@endsection

@section('content')
<div class="container mt-5 pt-5">
    <nav class="pt-md-3 mb-3" aria-label="Breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">{{ __('price.breadcrump-1') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('price.breadcrump-3') }}</li>
        </ol>
    </nav>
</div>
<section class="pb-lg-5 container mb-5">
    <div class="row align-items-center justify-content-lg-start justify-content-center flex-lg-nowrap gy-4">
        <div class="col-lg-9">
            <img class="rounded-3" src="/assets/images/prices-hero-img.jpg" alt="hero">
        </div>
        <div class="col-lg-4 ms-lg-n5 col-sm-9 text-lg-start text-center">
            <div class="ms-lg-n5 pe-xl-5 bg-gradient rounded p-3">
                <h1 class="mb-lg-4 text-light">{{ __('price.title') }}</h1>
                <p class="fs-lg text-light opacity-70">{{ __('price.desc') }}</p>
            </div>
        </div>
    </div>
</section>
<section class="pb-lg-5 container mb-5">
    <div class="row">
        <div class="col-12">
            <h4 class="text-primary">{{ __('price.title-2') }}</h4>
            <p>{{ __('price.desc-2') }}</p>
            <h4 class="text-primary">{{ __('price.title-2') }}</h4>
            <p>{{ __('price.desc-3') }}</p>
            <h4 class="text-primary">{{ __('price.title-4') }}</h4>
            <p>{{ __('price.desc-4') }}</p>
            <h4 class="text-primary">{{ __('price.title-5') }}</h4>
            <p class="mb-0">{{ __('price.desc-5') }}</p>
        </div>
    </div>
</section>
@endsection