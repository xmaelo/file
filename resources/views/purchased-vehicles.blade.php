@php
$id = 'account';
$subId = 'purchased-vehicles';
@endphp

@extends('layouts.layout')

@section('title')
Purchased Vehicles | Accounts
@endsection

@section('content')
<div class="container mt-5 pt-5">
    <nav class="pt-md-3 mb-3" aria-label="Breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Accounts</a></li>
            <li class="breadcrumb-item active" aria-current="page">Purchased vehicles</li>
        </ol>
    </nav>
</div>
<section class="pb-lg-3 container mt-3 mb-3 pt-3">
    <div class="row">
        @include('layouts.user_sidebar')
        <div class="col-lg-8 col-md-7">
            <div class="d-flex align-items-center justify-content-start mb-3">
                <h1 class="h2 mb-0">Purchased vehicles</h1>
            </div>
            <div class="table-responsive">
                <table class="table-borderless mb-0 table align-middle">
                    <thead class="bg-gradient">
                        <th class="text-start">DATE</th>
                        <th class="text-start">VEHICLE DESCRIPTION</th>
                        <th class="text-start">1ST REG.</th>
                        <th class="text-start">KM</th>
                        <th class="text-start">PRICE</th>
                        <th class="text-start">SELLER</th>
                        <th class="text-start">SELLER EMAIL</th>
                        <th class="text-start">SELLER COMPANY</th>
                        <th class="text-start">SELLER PHONE</th>
                        <th class="text-start">PURCHASED PRICE</th>
                    </thead>
                    <tbody>
                    @forelse($cars as $c)
                        @if (isset($c->images))
                        @php
                        $image = '/storage/images/cars/' . getImage($c->id);
                        @endphp
                        @else
                        @php
                        $image = '/assets/images/no-car.jpg';
                        @endphp
                        @endif
                        <tr>
                            <td>{{ $c->updated_at }}</td>
                            <td>
                                <div class="d-flex align-items-center w-max-content gap-2">
                                    <img src="{{ $image }}" alt="car" width="110">
                                    <div class="d-flex flex-column">
                                        <a href="/accounts/purchased-vehicle/{{ $c->slug }}" class="text-dark text-decoration-none">{{$c->brand}} {{$c->model}} {{$c->milage}}</a>
                                        <small>{{ $c->gear }} gearbox, {{ $c->body_type }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $c->first_registration }}</td>
                            <td>{{ $c->milage }}</td>
                            <td>CHF {{number_format($c->min_price, 0,",", "'")}}.00</td>
                            <td>{{ sellerInfo($c->u_id)->first_name }} {{ sellerInfo($c->u_id)->surname }}</td>
                            <td>{{ sellerInfo($c->u_id)->email }}</td>
                            <td>{{ sellerInfo($c->u_id)->company }}</td>
                            <td>{{ sellerInfo($c->u_id)->phone }}</td>
                            <td>CHF {{number_format($c->max_bid, 0,",", "'")}}.00</td>
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