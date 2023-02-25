@php $id = 'single-vehicle'; @endphp

@extends('layouts.layout')

@section('title')
Current Single Vehicle | Accounts
@endsection

@section('content')
<div class="container mt-5 pt-5">
    <nav class="pt-md-3 mb-3" aria-label="Breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Accounts</a></li>
            <li class="breadcrumb-item active" aria-current="page">Current single vehicle</li>
        </ol>
    </nav>
</div>
<section class="pb-lg-4 container mt-3 mb-4 pt-3">
    <div class="d-sm-flex align-items-end align-items-md-center justify-content-between position-relative mb-4" style="z-index: 1025;">
        <div class="me-3">
            <h1 class="h2 mb-md-0">{{ $car->brnad }} {{ $car->model }} {{ $car->body_type }}</h1>
            <div class="d-md-none">
                <div class="mb-2">
                    @if (session()->has('client_id'))
                    <div class="h3 text-primary mb-2">CHF {{number_format($car->min_price, 0,",", "'")}}.00</div>
                    @endif
                    @if (hasMembership($car->u_id))
                    <span class="d-table badge bg-info">
                        {{ getMembership($car->u_id)->title }}
                    </span>
                    @endif
                </div>
            </div>
        </div>
        <div class="text-nowrap pt-sm-0 pt-3">
            <button class="btn btn-icon btn-translucent-dark btn-xs rounded-circle mb-sm-2" type="button" data-bs-toggle="tooltip" title="Add to wishlist">
                <i class="fi-heart"></i>
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="tns-carousel-wrapper">
                <div class="tns-slides-count text-light">
                    <i class="fi-image fs-lg me-2"></i>
                    <div class="ps-1">
                        <span class="tns-current-slide fs-5 fw-bold"></span>
                        <span class="fs-5 fw-bold">/</span>
                        <span class="tns-total-slides fs-5 fw-bold"></span>
                    </div>
                </div>
                <div class="tns-carousel-inner" data-carousel-options='{
                                    "navAsThumbnails": true,
                                    "navContainer": "#thumbnails",
                                    "gutter": 12,
                                    "responsive": {
                                        "0": {
                                            "controls": false
                                        },
                                        "500": {
                                            "controls": true
                                        }
                                    }
                                }'>
                    @if (isset($car->images))
                    @forelse($car->images as $i)
                    <div><img class="rounded-3" src="{{ asset('storage/images/cars/' . $i) }}" alt="car"></div>
                    @empty
                    <div></div>
                    @endforelse
                    @endif
                </div>
            </div>
            <ul class="tns-thumbnails" id="thumbnails">
                @if (isset($car->images))
                @forelse($car->images as $i)
                <li class="tns-thumbnail"><img src="{{ asset('storage/images/cars/' . $i) }} " alt="thumbnail"></li>
                @empty
                <li class="tns-thumbnail"></li>
                @endforelse
                @endif
            </ul>
            <h2 class="h4 mb-4 pt-3">Features</h2>
            <div class="accordion" id="features">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="special-equipments-title">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#special-equipments-collapse" aria-expanded="true" aria-controls="special-equipments-collapse">Special equipments</button>
                    </h2>
                    <div class="accordion-collapse collapse show" id="special-equipments-collapse" aria-labelledby="special-equipments-title" data-bs-parent="#features">
                        <div class="accordion-body fs-sm opacity-70">
                            <p class="mb-0">{{ $car->special_equipments }}</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="serial-equipments-title">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#serial-equipments-collapse" aria-expanded="false" aria-controls="serial-equipments-collapse">Serial equipments</button>
                    </h2>
                    <div class="accordion-collapse collapse" id="serial-equipments-collapse" aria-labelledby="serial-equipments-title" data-bs-parent="#features">
                        <div class="accordion-body fs-sm opacity-70">
                            <p class="mb-0">{{ $car->serial_equipments }}</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="vehicle-description-title">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#vehicle-description-collapse" aria-expanded="false" aria-controls="vehicle-description-collapse">Vehicle description</button>
                    </h2>
                    <div class="accordion-collapse collapse" id="vehicle-description-collapse" aria-labelledby="vehicle-description-title" data-bs-parent="#features">
                        <div class="accordion-body fs-sm opacity-70">
                            <div class="row mb-4">
                                <div class="col-12 col-md-6 mb-md-0 mb-4">
                                    <div class="rounded border p-1">
                                        <div class="table-responsive">
                                            <table class="table-borderless mb-0 table align-middle">
                                                <tr>
                                                    <th class="bg-dark w-50 rounded-top">Repairs</th>
                                                    <td class="text-end">{{ $car->repairs }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-dark w-50">Accident vehicle</th>
                                                    <td class="text-end">Yes</td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-dark w-50 rounded-bottom">Vehicle inspection</th>
                                                    <td class="text-end">{{ $car->inspection }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="rounded border p-1">
                                        <div class="table-responsive">
                                            <table class="table-borderless mb-0 table align-middle">
                                                <tr>
                                                    <th class="bg-dark w-50 rounded-top">Model number</th>
                                                    <td class="text-end">{{ $car->model_number }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-dark w-50">Frame number</th>
                                                    <td class="text-end">{{ $car->frame_number }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-dark w-50 rounded-bottom">Register number</th>
                                                    <td class="text-end">{{ $car->register_number }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-12">
                                    <div class="rounded border p-1">
                                        <div class="table-responsive">
                                            <table class="table-borderless mb-0 table align-middle">
                                                <tr>
                                                    <th class="bg-dark w-50 rounded-top">Service record booklet</th>
                                                    <td class="text-end">{{ $car->service_record_booklet }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-dark w-50">Vehicle registration document</th>
                                                    <td class="text-end">{{ $car->registration_document }}</td>
                                                </tr>
                                                <tr>
                                                    <th class="bg-dark w-50 rounded-bottom">Number of keys</th>
                                                    <td class="text-end">{{ $car->keys }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="condition-title">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#condition-collapse" aria-expanded="false" aria-controls="condition-collapse">Condition</button>
                    </h2>
                    <div class="accordion-collapse collapse" id="condition-collapse" aria-labelledby="condition-title" data-bs-parent="#features">
                        <div class="accordion-body fs-sm opacity-70">
                            <div class="rounded border p-1">
                                <div class="table-responsive">
                                    <table class="table-borderless mb-0 table align-middle">
                                        <tr>
                                            <th class="bg-dark w-50 rounded-top">Mechanics</th>
                                            <td class="text-end">{{ $car->mechanics }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-dark w-50">Car finish</th>
                                            <td class="text-end">{{ $car->car_finish }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-dark w-50">Body</th>
                                            <td class="text-end">{{ $car->body }}</td>
                                        </tr>
                                        <tr>
                                            <th class="bg-dark w-50 rounded-bottom">Other</th>
                                            <td class="text-end">{{ $car->others }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5 pt-md-0 pt-2" style="margin-top: -6rem;">
            <div class="sticky-top" style="padding-top: 90px;">
                <div class="d-none d-md-block mb-3">
                    <div class="h4 text-primary mb-2">CHF {{number_format($car->min_price, 0,",", "'")}}.00</div>
                    @if (hasMembership($car->u_id))
                    <span class="d-table badge bg-info">
                        {{ getMembership($car->u_id)->title }}
                    </span>
                    @endif
                </div>
                <hr class="d-none d-md-block mb-3">
                <h2 class="h4 mb-4 mt-4 mt-md-0">Specifications</h2>
                <div class="row">
                    <div class="col-sm-6 col-md-12 col-lg-6">
                        <ul class="list-unstyled">
                            <li class="mb-2"><strong>Milage:</strong><span class="ms-1 opacity-70">{{ $car->milage }}</span></li>
                            <li class="mb-2"><strong>Registration:</strong><span class="ms-1 opacity-70">{{ $car->first_registration }}</span></li>
                            <li class="mb-2"><strong>Gear:</strong><span class="ms-1 opacity-70">{{ $car->gear }}</span></li>
                            <li class="mb-2"><strong>Wheel drive:</strong><span class="ms-1 opacity-70">{{ $car->wheel_drive }}</span></li>
                            <li class="mb-2"><strong>Fuel:</strong><span class="ms-1 opacity-70">{{ $car->fuel }}</span></li>
                            <li class="mb-2"><strong>Displacement:</strong><span class="ms-1 opacity-70">{{ $car->displacement }}</span></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-12 col-lg-6">
                        <ul class="list-unstyled">
                            <li class="mb-2"><strong>Body:</strong><span class="ms-1 opacity-70">{{ $car->body_type }}</span></li>
                            <li class="mb-2"><strong>Interior:</strong><span class="ms-1 opacity-70">{{ $car->interior_finish }}, {{ $car->interior_color }}</span></li>
                            <li class="mb-2"><strong>Exterior:</strong><span class="ms-1 opacity-70">{{ $car->exterior_finish }}, {{ $car->exterior_color }}</span></li>
                            <li class="mb-2"><strong>Seats:</strong><span class="ms-1 opacity-70">{{ $car->seats }}</span></li>
                            <li class="mb-2"><strong>To be transported by:</strong><span class="ms-1 opacity-70">Seller (295.-)</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection