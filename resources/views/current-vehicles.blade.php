@php
$id = 'account';
$subId = 'current-vehicles';
@endphp

@extends('layouts.layout')

@section('title')
Current Vehicles | Accounts
@endsection

@section('content')


<div class="container mt-5 pt-5">
    <nav class="pt-md-3 mb-3" aria-label="Breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Accounts</a></li>
            <li class="breadcrumb-item active" aria-current="page">Current vehicles</li>
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
                <h1 class="h2 mb-0">Current vehicles</h1>
            </div>
            <div class="table-responsive">
                <table class="table-borderless mb-0 table align-middle">
                    <thead class="bg-gradient">
                        <th></th>
                        <th class="text-start">STATUS</th>
                        <th class="text-start">REFERENCE NUMBER</th>
                        @if(!isAuctionActive())
                        <th class="text-start " style="width: 450px;">AUCTION</th>
                        @endif
                        <th class="text-start">VEHICLE DESCRIPTION</th>
                        <th class="text-start">1ST REG.</th>
                        <th class="text-start">KM</th>
                        <th class="text-start">PRICE</th>
                    </thead>
                    <tbody>
                        @forelse($cars as $c)
                        @if (isset($c->images))
                        @php
                        $img = '/storage/images/cars/' . getImage($c->id);
                        @endphp
                        @else
                        @php
                        $img = '/assets/images/no-car.jpg';
                        @endphp
                        @endif
                        <tr>
                            <td class="text-center">
                                <a href="/accounts/current-vehicle/{{ $c->slug }}/edit"><i class="fi-edit"></i></a>
                            </td>
                            <td>{{ $c->status }}</td>
                            <td>{{ $c->ref_number }}</td>
                            @if(!isAuctionActive())
                            <td>
                                <form action="/accounts/current-vehicle/{{$c->id}}/auction" method="post">
                                    @csrf
                                    @method('put')
                                    <select class="form-select" id="auction" name="auction" style="width: 200px;" required>
                                        <option selected disabled>Please select auction</option>
                                        @forelse($auctions as $auction)
                                        <option value="{{ $auction->id }}" @if($c->auction == $auction->id) selected @endif >{{ $auction->start_date }} - {{$auction->end_date}}</option>
                                        @empty
                                        <option value="" disabled>No auctions available</option>
                                        @endforelse
                                    </select>
                                    <button class="btn btn-primary my-2">Update</button>
                                </form>
                            </td>
                            @endif
                            <td>
                                <div class="d-flex align-items-center w-max-content gap-2">
                                    <img src="{{ $img }}" alt="car" width="110">
                                    <div class="d-flex flex-column">
                                        <a href="/accounts/current-vehicle/{{ $c->slug }}" class="text-dark text-decoration-none">{{ $c->brand }} {{ $c->model }} {{ $c->model_number }} {{ $c->performance_hp }} {{ $c->performance_kw }} {{ $c->frame_number }}, {{ $c->performance_hp }}</a>
                                        <small>{{ $c->gear }} gearbox, {{ $c->body_type }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $c->first_registration }}</td>


                            <td>{{ $c->milage }}</td>
                            <td>CHF {{number_format($c->min_price, 0,",", "'")}}.00</td>
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