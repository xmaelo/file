@php $id = 'instructions'; @endphp

@extends('layouts.layout')

@section('title')
Instructions
@endsection

@section('content')
<div class="container mt-5 pt-5">
    <nav class="pt-md-3 mb-3" aria-label="Breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">{{ __('instructions.breadcrump-1') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('instructions.breadcrump-3') }}</li>
        </ol>
    </nav>
</div>
<section class="pb-lg-5 container mb-5">
    <div class="row align-items-center justify-content-lg-start justify-content-center flex-lg-nowrap gy-4">
        <div class="col-lg-9">
            <img class="rounded-3" src="/assets/images/instructions-hero-img.jpg" alt="hero">
        </div>
        <div class="col-lg-4 ms-lg-n5 col-sm-9 text-lg-start text-center">
            <div class="ms-lg-n5 pe-xl-5 bg-gradient rounded p-3">
                <h1 class="mb-lg-4 text-light">{{ __('instructions.title') }}</h1>
                <p class="fs-lg text-light opacity-70">{{ __('instructions.desc') }}</p>
            </div>
        </div>
    </div>
</section>
<section class="pb-lg-5 container mb-5">
    <div class="row">
        <div class="col-lg-5 col-md-6">
            <div class="d-flex flex-column text-md-start text-center">
                <div class="order-md-1 mx-md-0 mb-md-5 order-2 mx-auto mb-4" style="max-width: 416px;">
                    <h2 class="mb-md-3 mb-2">{{ __('instructions.title-1') }}</h2>
                    <p class="pb-md-2 mb-4 opacity-70">{{ __('instructions.desc-2') }}</p>
                </div>
                <div class="order-md-2 order-1">
                    <img src="/assets/images/faq.png" alt="faq">
                </div>
            </div>
        </div>
        <div class="col-md-6 offset-lg-1">
            <div class="accordion" id="accordionFAQ">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-1">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="true" aria-controls="collapse-1">{{ __('instructions.faq-1-title') }}</button>
                    </h2>
                    <div class="accordion-collapse collapse show" aria-labelledby="heading-1" data-bs-parent="#accordionFAQ" id="collapse-1">
                        <div class="accordion-body opacity-70">{{ __('instructions.faq-1-desc') }}</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-2" aria-expanded="false" aria-controls="collapse-2">{{ __('instructions.faq-2-title') }}</button>
                    </h2>
                    <div class="accordion-collapse collapse" aria-labelledby="heading-2" data-bs-parent="#accordionFAQ" id="collapse-2">
                        <div class="accordion-body opacity-70">{{ __('instructions.faq-2-desc') }}</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-3">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-3" aria-expanded="false" aria-controls="collapse-3">{{ __('instructions.faq-3-title') }}</button>
                    </h2>
                    <div class="accordion-collapse collapse" aria-labelledby="heading-3" data-bs-parent="#accordionFAQ" id="collapse-3">
                        <div class="accordion-body opacity-70">{{ __('instructions.faq-3-desc') }}</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-4">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-4" aria-expanded="false" aria-controls="collapse-4">{{ __('instructions.faq-4-title') }}</button>
                    </h2>
                    <div class="accordion-collapse collapse" aria-labelledby="heading-4" data-bs-parent="#accordionFAQ" id="collapse-4">
                        <div class="accordion-body opacity-70">{{ __('instructions.faq-4-desc') }}</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-5">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-5" aria-expanded="false" aria-controls="collapse-5">{{ __('instructions.faq-5-title') }}</button>
                    </h2>
                    <div class="accordion-collapse collapse" aria-labelledby="heading-5" data-bs-parent="#accordionFAQ" id="collapse-5">
                        <div class="accordion-body opacity-70">{{ __('instructions.faq-5-desc') }}</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-6">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-6" aria-expanded="false" aria-controls="collapse-6">{{ __('instructions.faq-6-title') }}</button>
                    </h2>
                    <div class="accordion-collapse collapse" aria-labelledby="heading-6" data-bs-parent="#accordionFAQ" id="collapse-6">
                        <div class="accordion-body opacity-70">{{ __('instructions.faq-6-desc') }}</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-7">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-7" aria-expanded="false" aria-controls="collapse-7">{{ __('instructions.faq-7-title') }}</button>
                    </h2>
                    <div class="accordion-collapse collapse" aria-labelledby="heading-7" data-bs-parent="#accordionFAQ" id="collapse-7">
                        <div class="accordion-body opacity-70">{{ __('instructions.faq-7-desc') }}</div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading-8">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-8" aria-expanded="false" aria-controls="collapse-8">{{ __('instructions.faq-8-title') }}</button>
                    </h2>
                    <div class="accordion-collapse collapse" aria-labelledby="heading-8" data-bs-parent="#accordionFAQ" id="collapse-8">
                        <div class="accordion-body opacity-70">{{ __('instructions.faq-8-desc') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection