@php $id = 'Vehicles'; @endphp

@extends('layouts.layout')

@section('title')
    Vehicles
@endsection

@section('content')
    <div class="mb-md-4 container mt-5 py-5">
        <div class="row py-md-1">
            <div class="col-12">
                <nav class="pt-md-2 pt-lg-4 mb-3" aria-label="Breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Vehicles</li>
                    </ol>
                </nav>
                <div class="d-flex align-items-center justify-content-start mb-2 pb-4">
                    <h1 class="me-3 mb-0">Vehicles</h1>
                </div>
                <div class="row">
                    @forelse($cars as $car)
                        <div class="col-12 col-lg-6">
                            <div class="card card-light card-hover card-horizontal mb-4 border">
                                <div class="tns-carousel-wrapper card-img-top card-img-hover">
                                    <a class="img-overlay" href="/car/{{ $car->slug }}"></a>
                                    @if (hasMembership($car->u_id))
                                        <div class="position-absolute start-0 ps-3 top-0 pt-3">
                                            <span class="d-table badge bg-info">{{ getMembership($car->u_id)->title }}</span>
                                        </div>
                                    @endif
                                    <div class="tns-carousel-inner position-absolute h-100 top-0">
                                        @if (isset($car->images))
                                            @forelse($car->images as $image)
                                                <div class="bg-size-cover bg-position-center w-100 h-100" style="background-image:url(storage/images/cars/{{ $image }});"></div>
                                            @empty
                                                <p></p>
                                            @endforelse
                                        @endif
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between pb-1">
                                        <span class="fs-sm text-dark me-3 opacity-50">{{ $car->first_registration }}</span>
                                    </div>
                                    <h3 class="h6 mb-1">
                                        <a class="nav-link" href="/car/{{ $car->slug }}">{{ $car->model }}</a>
                                    </h3>
                                    @if (session()->has('client'))
                                        <div class="text-primary fw-bold mb-1">{{ $car->min_price }} CHE</div>
                                    @endif
                                    <div class="border-top mt-3 pt-3">
                                        <div class="row g-2">
                                            <div class="col me-sm-1">
                                                <div class="w-100 h-100 rounded border p-2 text-center">
                                                    <i class="fi-dashboard d-block h4 mx-center mb-0"></i>
                                                    <span class="fs-xs text-dark">{{ $car->milage }} KM</span>
                                                </div>
                                            </div>
                                            <div class="col me-sm-1">
                                                <div class="w-100 h-100 rounded border p-2 text-center">
                                                    <i class="fi-gearbox d-block h4 mx-center mb-0"></i>
                                                    <span class="fs-xs text-dark">{{ $car->gear }}</span>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="w-100 h-100 rounded border p-2 text-center">
                                                    <i class="fi-petrol d-block h4 mx-center mb-0"></i>
                                                    <span class="fs-xs text-dark">{{ $car->fuel }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                            <p class="p-4">No data found</p>
                        @endforelse
                    </div>
                    @if ($cars->hasPages())
                        <div class="d-flex align-items-center justify-content-center py-2">
                            <nav aria-label="Pagination">
                                <ul class="pagination mb-0">
                                    <li class="page-item"><a class="page-link" href="{{ $cars->previousPageUrl() }}" aria-label="Previous"><i class="fi-chevron-left"></i></a></li>
                                    @for ($i = 1; $i <= $cars->lastPage(); $i++)
                                        <li class="page-item {{ $cars->currentPage() == $i ? 'active' : '' }}"><a class="page-link" href="{{ $cars->url($i) }}">{{ $i }}<span class="visually-hidden">(current)</span></a></li>
                                    @endfor
                                    @if ($cars->hasMorePages())
                                        <li class="page-item"><a class="page-link" href="{{ $cars->nextPageUrl() }}" aria-label="Next"><i class="fi-chevron-right"></i></a></li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endsection
