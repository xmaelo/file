@php
$id = 'account';
$subId = 'dashboard';
@endphp

@extends('layouts.layout')

@section('title')
Dashboard | Accounts
@endsection

@section('content')


<div class="container mt-5 pt-5">
    <nav class="pt-md-3 mb-3" aria-label="Breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Accounts</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </nav>
</div>
@if (session()->has('success'))
<div class="container mt-5 alert alert-success">
    <div>{{ session()->get('success') }}</div>
</div>
@endif
@if (session()->has('user_bid'))
<div class="container mt-5 alert alert-success">
    <div>{{ session()->get('user_bid') }}</div>
</div>
@endif
<section class="pb-lg-3 container mt-3 mb-3 pt-3">
    <div class="row">
        @include('layouts.user_sidebar')
        <div class="col-lg-8 col-md-7">
            <div class="d-flex align-items-center justify-content-start mb-3">
                <h1 class="h2 mb-0">Conditional Bids</h1>
            </div>
            <div class="table-responsive">
                <table class="table-borderless mb-0 table align-middle">
                    <thead class="bg-gradient">
                        <th></th>
                        <th class="text-start">STATUS</th>
                        <th class="text-start">VEHICLE DESCRIPTION</th>
                        <th class="text-start">CAR PRICE</th>
                        <th class="text-start">BID</th>
                        <th class="text-start"></th>
                        <th class="text-start"></th>
                    </thead>
                    <tbody>
                        @forelse($bids as $bid)

                        @if (isset(carDetails($bid->car_id)->images))
                        @php
                        $img = '/storage/images/cars/' . getImage($bid->car_id);
                        @endphp
                        @else
                        @php
                        $img = '/assets/images/no-car.jpg';
                        @endphp
                        @endif

                        <tr>
                            <td class="text-center">
                                <a href=""><i class="fi-edit"></i></a>
                            </td>
                            <td>{{ carDetails($bid->car_id)->status}}</td>
                            <td>
                                <div class="d-flex align-items-center w-max-content gap-2">
                                    <img src="{{ $img }}" alt="car" width="110">
                                    <div class="d-flex flex-column">
                                        <a href="" class="text-dark text-decoration-none">{{ carDetails($bid->car_id)->brand }} {{ carDetails($bid->car_id)->model }} {{ carDetails($bid->car_id)->model_number }} {{ carDetails($bid->car_id)->performance_hp }} {{ carDetails($bid->car_id)->performance_kw }} {{ carDetails($bid->car_id)->frame_number }}, {{ carDetails($bid->car_id)->performance_hp }}</a>
                                        <small>{{ carDetails($bid->car_id)->gear }} gearbox, {{ carDetails($bid->car_id)->body_type }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>CHF {{number_format(carDetails($bid->car_id)->min_price, 0,",", "'")}}.00</td>
                            <td>CHF {{number_format($bid->bid_amount, 0,",", "'")}}.00</td>
                            @if(carDetails($bid->car_id)->status === 'Not sold')
                            <td>
                                <form action="/bid-accept" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="bid_id" value="{{$bid->id}}">
                                    <button class="btn btn-accent bg-gradient btn-lg d-block mb-2 border-0" href="#">
                                        <i class="fi-check me-2"></i>Accept
                                    </button>
                                </form>
                            </td>

                            <td>
                                <form action="/bid-cancel" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="cancel_bid_id" value="{{$bid->id}}">
                                    <button class="btn btn-accent bg-danger btn-lg d-block mb-2 border-0" href="#">
                                        <i class="fi-x me-2"></i>Cancel
                                    </button>
                                </form>
                            </td>
                            @endif


                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="8">
                                <i class="fa fa-frown mr-5"></i> No bids found!
                            </td>
                        </tr>
                        @endforelse

                        @forelse($current_user_bids as $bid)

                        @if (isset(carDetails($bid->car_id)->images))
                        @php
                        $img = '/storage/images/cars/' . getImage($bid->car_id);
                        @endphp
                        @else
                        @php
                        $img = '/assets/images/no-car.jpg';
                        @endphp
                        @endif
                        @if($bid->status)
                        <tr>
                            <td class="text-center">
                                <a href=""><i class="fi-edit"></i></a>
                            </td>
                            <td>{{ carDetails($bid->car_id)->status}}</td>
                            <td>
                                <div class="d-flex align-items-center w-max-content gap-2">
                                    <img src="{{ $img }}" alt="car" width="110">
                                    <div class="d-flex flex-column">
                                        <a href="" class="text-dark text-decoration-none">{{ carDetails($bid->car_id)->brand }} {{ carDetails($bid->car_id)->model }} {{ carDetails($bid->car_id)->model_number }} {{ carDetails($bid->car_id)->performance_hp }} {{ carDetails($bid->car_id)->performance_kw }} {{ carDetails($bid->car_id)->frame_number }}, {{ carDetails($bid->car_id)->performance_hp }}</a>
                                        <small>{{ carDetails($bid->car_id)->gear }} gearbox, {{ carDetails($bid->car_id)->body_type }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>CHF {{number_format(carDetails($bid->car_id)->min_price, 0,",", "'")}}.00</td>
                            <td>CHF {{number_format($bid->bid_amount, 0,",", "'")}}.00</td>


                            <td>
                                <form action="/bid-user-delete/{{$bid->id}}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="bid_delete" value="{{$bid->id}}">
                                    <button class="btn btn-accent bg-danger btn-lg d-block mb-2 border-0" href="#">
                                        <i class="fi-x me-2"></i>Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endif
                        @empty
                        <tr>
                            <td class="text-center" colspan="8">
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