@php $id = 'car-auction'; @endphp

@extends('layouts.layout')

@section('title')
Jobs
@endsection

@section('content')
<div class="container mt-5 pt-5">
    <nav class="pt-md-3 mb-3" aria-label="Breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Jobs</li>
        </ol>
    </nav>
</div>
<section class="pb-lg-5 container mb-5">
    <div class="row align-items-center justify-content-lg-start justify-content-center flex-lg-nowrap gy-4">
        <div class="col-lg-9">
            <img class="rounded-3" src="/assets/images/jobs-hero-img.jpg" alt="hero">
        </div>
        <div class="col-lg-4 ms-lg-n5 col-sm-9 text-lg-start text-center">
            <div class="ms-lg-n5 pe-xl-5 bg-gradient rounded p-3">
                <h1 class="mb-lg-4 text-light">Jobs</h1>
                <p class="fs-lg text-light opacity-70">We believe that car buying and selling should be straight-forward and enjoyable, not time-consuming, complicated or stressful.</p>
            </div>
        </div>
    </div>
</section>
<section class="pb-lg-5 container mb-5">
    <div class="row">
        <div class="col-12">
            <p>Elit sint consectetur irure dolor. Incididunt Lorem eu incididunt veniam do esse. Culpa enim amet pariatur nisi do ipsum exercitation nostrud id labore.</p>
            <p>Adipisicing sit nulla anim sunt ex. Nulla excepteur Lorem ex excepteur dolor. Dolore aute elit excepteur ipsum nisi excepteur.</p>
            <p class="mb-0">Quis deserunt Lorem et culpa et magna exercitation deserunt deserunt labore enim magna dolor adipisicing. Adipisicing labore tempor qui minim. Labore consectetur minim dolor tempor elit mollit. Nostrud nostrud et ex adipisicing voluptate culpa pariatur proident ex. Amet pariatur in anim laborum. Minim irure eiusmod aute minim ea et aliquip tempor officia Lorem dolor mollit nulla do.</p>
        </div>
    </div>
</section>
</main>
@endsection