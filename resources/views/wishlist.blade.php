@php
$id = 'account';
$subId = 'wishlist';
@endphp

@extends('layouts.layout')

@section('title')
Wishlist | Accounts
@endsection

@section('content')


<div class="container mt-5 pt-5">
    <nav class="pt-md-3 mb-3" aria-label="Breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Accounts</a></li>
            <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
        </ol>
    </nav>
</div>
@if (session()->has('success'))
<div class="container mt-5 alert alert-success">
    <div>{{ session()->get('success') }}</div>
</div>
@endif
@if (session()->has('fail_update'))
<div class="container mt-5 alert alert-danger">
    <div>{{ session()->get('fail_update') }}</div>
</div>
@endif
<section class="pb-lg-3 container mt-3 mb-3 pt-3">
    <div class="row">
        @include('layouts.user_sidebar')
        <div class="col-lg-8 col-md-7">
            <div class="d-flex align-items-center justify-content-start mb-3">
                <h1 class="h2 mb-0">Wishlist</h1>
            </div>
            <div class="table-responsive">
                <table class="table-borderless mb-0 table align-middle">
                    <thead class="bg-gradient">
                        <th class="text-start">STATUS</th>
                        <th class="text-start">REFERENCE NUMBER</th>                       
                        <th class="text-start">VEHICLE DESCRIPTION</th>
                        <th class="text-start">1ST REG.</th>
                        <th class="text-start">KM</th>
                        <th class="text-start">PRICE</th>
                    </thead>
                    <tbody>
                        @forelse($wishlist_items as $wishlist_item)
                        @if (isset(carDetails($wishlist_item->car_id)->images))
                        @php
                        $img = '/storage/images/cars/' . getImage(carDetails($wishlist_item->car_id)->id);
                        @endphp
                        @else
                        @php
                        $img = '/assets/images/no-car.jpg';
                        @endphp
                        @endif
                        <tr>                          
                            <td>{{ carDetails($wishlist_item->car_id)->status }}</td>
                            <td>{{ carDetails($wishlist_item->car_id)->ref_number }}</td>
                            
                            <td>
                                <div class="d-flex align-items-center w-max-content gap-2">
                                    <img src="{{ $img }}" alt="car" width="110">
                                    <div class="d-flex flex-column">
                                        <a href="/accounts/current-vehicle/{{ carDetails($wishlist_item->car_id)->slug }}" class="text-dark text-decoration-none">{{ carDetails($wishlist_item->car_id)->brand }} {{ carDetails($wishlist_item->car_id)->model }} {{ carDetails($wishlist_item->car_id)->model_number }} {{carDetails($wishlist_item->car_id)->performance_hp }} {{ carDetails($wishlist_item->car_id)->performance_kw }} {{ carDetails($wishlist_item->car_id)->frame_number }}, {{ carDetails($wishlist_item->car_id)->performance_hp }}</a>
                                        <small>{{ carDetails($wishlist_item->car_id)->gear }} gearbox, {{ carDetails($wishlist_item->car_id)->body_type }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ carDetails($wishlist_item->car_id)->first_registration }}</td>


                            <td>{{ carDetails($wishlist_item->car_id)->milage }}</td>
                            <td>CHF {{number_format(carDetails($wishlist_item->car_id)->min_price, 0,",", "'")}}.00</td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="8">
                                <i class="fa fa-frown mr-5"></i> No items found!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection