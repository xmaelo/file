@php
$id = 'single-vehicle';
@endphp

@extends('layouts.layout')

@section('title')
    Single Vehicle
@endsection

@section('content')
    <div class="container mt-5 pt-5">
        <nav class="pt-md-3 mb-3" aria-label="Breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Single vehicle</li>
            </ol>
        </nav>
    </div>
    @if (session()->has('wishlit_success'))
        <div class="container">
            <div class="alert alert-success">{{ session()->get('wishlit_succes') }}</div>
        </div>
    @endif
    @if (session()->has('bid_taken'))
        <div class="container">
            <div class="alert alert-danger">{{ session()->get('bid_taken') }}</div>
        </div>
    @endif

    @if (session()->has('low_bid'))
        <div class="container">
            <div class="alert alert-danger">{{ session()->get('low_bid') }}</div>
        </div>
    @endif
    @if (session()->has('auction_over'))
        <div class="container">
            <div class="alert alert-danger">{{ session()->get('auction_over') }}</div>
        </div>
    @endif
    @if (session()->has('highest_bidder'))
        <div class="container">
            <div class="alert alert-success">{{ session()->get('highest_bidder') }}</div>
        </div>
    @endif
    <section class="pb-lg-4 container mt-3 mb-4 pt-3">
        <div class="d-sm-flex align-items-end align-items-md-center justify-content-between position-relative mb-4" style="z-index: 1025;">
            <div class="me-3">
                <h1 class="h2 mb-md-0">{{ $car->brand ?? '' }} {{ $car->model ?? '' }} {{ $car->body ?? '' }}</h1>
                <h5 class="my-2">Reference no: {{ $car->ref_number }}</h5>
                <div class="d-md-none">
                    <div class="mb-2">
                        @if (session()->has('client_id'))
                            <div class="h3 text-primary mb-2">{{ $car->min_price ?? '' }} CHE</div>
                        @endif
                        @if (hasMembership($car->u_id ?? ''))
                            <span class="d-table badge bg-info">
                                {{ getMembership($car->u_id)->title ?? '' }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            @if(session()->has('client_id'))
            <div class="text-nowrap pt-sm-0 pt-3">
                <form action="/wishlist" method="POST">
                    @csrf                    
                    <input type="hidden" name="car_id" value="{{$car->id}}">
                    <input type="hidden" name="user_id" value="{{session()->get('client_id')}}">
                    <button class="btn btn-icon btn-translucent-dark btn-xs rounded-circle @if(isWishListed($car->id,session()->get('client_id'))) btn-success bg-success @endif mb-sm-2" type="submit" data-bs-toggle="tooltip" title=" @if(isWishListed($car->id,session()->get('client_id'))) Already in the wishlist @else Add to wishlist @endif">
                        <i class="fi-heart"></i>
                    </button>
                </form>
            </div>
            @endif

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
                        @if (!is_null($car->images))
                            @forelse($car->images as $i)
                                <div><img class="rounded-3" src="{{ asset('storage/images/cars/' . $i) }}" alt="car"></div>
                            @empty
                                <div></div>
                            @endforelse
                        @endif
                    </div>
                </div>
                <ul class="tns-thumbnails" id="thumbnails">
                    @if (!is_null($car->images))
                        @forelse($car->images as $i)
                            <li class="tns-thumbnail"><img src="{{ asset('storage/images/cars/' . $i) }}" alt="thumbnail"></li>
                        @empty
                            <li class="tns-thumbnail">No Images</li>
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
                                <p class="mb-0">{{ $car->special_equipments ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="serial-equipments-title">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#serial-equipments-collapse" aria-expanded="false" aria-controls="serial-equipments-collapse">Serial equipments</button>
                        </h2>
                        <div class="accordion-collapse collapse" id="serial-equipments-collapse" aria-labelledby="serial-equipments-title" data-bs-parent="#features">
                            <div class="accordion-body fs-sm opacity-70">
                                <p class="mb-0">{{ $car->serial_equipments ?? '' }}</p>
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
                                                        <td class="text-end">{{ $car->repairs ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-dark w-50">Accident vehicle</th>
                                                        <td class="text-end">Yes</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-dark w-50 rounded-bottom">Vehicle inspection</th>
                                                        <td class="text-end">{{ $car->inspection ?? '' }}</td>
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
                                                        <td class="text-end">{{ $car->model_number ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-dark w-50">Frame number</th>
                                                        <td class="text-end">{{ $car->frame_number ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-dark w-50 rounded-bottom">Register number</th>
                                                        <td class="text-end">{{ $car->register_number ?? '' }}</td>
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
                                                        <td class="text-end">{{ $car->service_record_booklet ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-dark w-50">Vehicle registration document</th>
                                                        <td class="text-end">{{ $car->registration_document ?? '' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th class="bg-dark w-50 rounded-bottom">Number of keys</th>
                                                        <td class="text-end">{{ $car->keys ?? '' }}</td>
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
                                                <td class="text-end">{{ $car->mechanics ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-dark w-50">Car finish</th>
                                                <td class="text-end">{{ $car->car_finish ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-dark w-50">Body</th>
                                                <td class="text-end">{{ $car->body ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th class="bg-dark w-50 rounded-bottom">Other</th>
                                                <td class="text-end">{{ $car->others ?? '' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 pt-md-0 pt-4" style="margin-top: -6rem;">
                <div class="sticky-top pt-5">
                    <div class="mb-3 pt-5">
                        <h3>
                            @if ($nextAuctionCount != 0)
                                <span id="title"></span>
                                <span class="text-primary" id="getting-started-auction"></span>
                            @else
                                @if ($car->status === 'sold')
                                    Car is sold
                                @else
                                    Auction will start soon
                                @endif
                            @endif
                        </h3>
                        @push('body-scripts')
                            <script>
                                $(document).ready(function() {
                                    var auctionTitle = "{!! $title !!}";
                                    $('#title').text(auctionTitle);
                                    $('#getting-started-auction').countdown({!! $endDate !!}, function(event) {
                                        $(this).html(event.strftime(' %d days %H:%M:%S'));
                                    });
                                });
                            </script>
                        @endpush
                        @if (!session()->has('client_id'))
                            <div class="my-3">
                                Please <a href="#signin-modal" data-bs-toggle="modal" data-bs-dismiss="modal">login</a> or <a href="#signup-modal" data-bs-toggle="modal" data-bs-dismiss="modal">register</a>.
                            </div>
                        @endif
                        @if (session()->has('client_id'))

                            @if ($car->status != 'sold')
                                @if (isAuctionActive())
                                    <div class="container my-3">
                                        <div class="bidemeter" style="background-color: #f7f7f7;">
                                            <div class="scroll-container justify-content-center" id=" scroll-container">
                                                <ul class="scroll-list" id="bids">
                                                    @php
                                                        $value = $car->min_price;
                                                        $bidder_name = '';
                                                        $starting_price = (int) $car->min_price - $car->min_price * 0.2;
                                                        $starting_price = (int) $car->min_price - $car->min_price * 0.2;
                                                        $current_bid = (int) ($car->max_bid ?? $car->min_price);
                                                        $max = $car->max_bid ?? $car->min_price;
                                                    @endphp
                                                    @if ($current_bid <= $car->min_price)
                                                        @for ($c = 0; $starting_price <= $car->min_price; $c++)
                                                            @if ($car->max_bid && $starting_price < $max)
                                                                @php
                                                                    $starting_price = (int) $max;
                                                                @endphp
                                                            @endif
                                                            @if ($starting_price != $car->min_price)
                                                                <li class="{{ (int) $starting_price === (int) $max ? 'active-li' : '' }}">
                                                                    <a href="#" class="bid-item">{{ number_format($starting_price, 0, ',', "'") }}</a>
                                                                    <a href="#" class="bid-item d-none real-bid">{{ $starting_price }}</a>
                                                                    @if ((int) $starting_price === (int) $max)
                                                                        @if (isset($car->bidder_id))
                                                                            <span class="bidder-info">{{ bidderInfo($car->bidder_id)->first_name }}</span>
                                                                        @endif
                                                                    @endif
                                                                </li>
                                                            @endif
                                                            @php
                                                                $starting_price += 100;
                                                            @endphp
                                                        @endfor
                                                    @endif
                                                    @for ($i = 0; $i < 40; $i++)
                                                        @if ($current_bid < $car->min_price)
                                                            @php
                                                                $current_bid = (int) $car->min_price;
                                                            @endphp
                                                        @endif
                                                        @if($car->bidder_id)
                                                        @php 
                                                            $bidder_name = bidderInfo($car->bidder_id)->first_name;                                                                
                                                        @endphp
                                                        @endif

                                                        <li class="{{ (int) $current_bid === (int) $max ? 'active-li' : '' }}">
                                                            <a href="#" class="bid-item">{{ number_format($current_bid, 0, ',', "'") }}</a>
                                                            <a href="#" class="bid-item d-none real-bid">{{ $current_bid }}</a>
                                                            @if ((int) $current_bid === (int) $max)
                                                                @if (isset($car->bidder_id))                                                               
                                                                    <span class="bidder-info">{{ bidderInfo($car->bidder_id)->first_name }}</span>
                                                                @endif
                                                            @endif
                                                        </li>
                                                        @php
                                                            $current_bid += 100;
                                                        @endphp
                                                    @endfor
                                                </ul>
                                                <script>
                                                    document.getElementById('bids').getElementsByClassName('active-li')[0].scrollIntoView({
                                                        block: "center"
                                                    });
                                                    window.scrollTo(0, 0);
                                                </script>
                                            </div>
                                        </div>
                                        <div class="bid-status mb-1">
                                            @if ($car->bidder_id)
                                                @if (isHighestBidder($car->id))
                                                    <div class="outbid text-success">You are the highest bidder.</div>                                                  
                                                @else
                                                    <div class="outbid text-danger">You have been outbidded by {{$bidder_name}}.</div>
                                                @endif
                                                @if($car->max_bid < $car->min_price)
                                                <div class="outbid text-success text-small"><small>Current bid has not reached vehicle's minimum price.</small></div>
                                                @endif
                                            @endif
                                            @if ($car->bidder_id)
                                                @if (isHighestBidder($car->id))
                                                    <div class="outbid-sm">Bid price : CHF {{ number_format($car->max_bid, 0, ',', "'") }}.00</div>
                                                    <div class="outbid-sm">Service charge : CHF {{ number_format($publish_price, 0, ',', "'") }}.00</div>
                                                    <div class="outbid-sm">Total bid :CHF {{ number_format($car->max_bid + 50, 0, ',', "'") }}.00</div>
                                                @endif
                                            @endif
                                        </div>
                                        <form action="/bid" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="current-bid" id="current-bid" value="{{ $max }}">
                                            <input type="hidden" name="car-id" value="{{ $car->id }}">
                                            <input type="hidden" name="bidder-id" value="{{ session()->get('client_id') }}">
                                            @if (!isUserCar($car->id))
                                                <div class="d-flex flex-row-reverse">
                                                    <button class="btn btn-danger py-2 px-5">Place bid</button>
                                                </div>
                                            @else
                                                <div class="outbid text-success text-center">You own this car</div>
                                            @endif
                                        </form>
                                        @section('scripts')
                                            <script>
                                                $('.bidemeter li').click(function() {
                                                    $('.bidemeter li').removeClass("active-li");
                                                    $(this).addClass("active-li");
                                                    $('#current-bid').val($(".bidemeter li.active-li .real-bid").text());
                                                });
                                            </script>
                                        @endsection
                                    </div>
                                </div>
                                <div class="d-none d-md-block mb-3">
                                    <hr class="mb-4">
                                    <div class="h4 text-primary mb-2">Minimum Price : CHF {{ number_format($car->min_price, 0, ',', "'") }}</div>
                                    @if (hasMembership($car->u_id))
                                        <span class="d-table badge bg-info">
                                            {{ getMembership($car->u_id)->title }}
                                        </span>
                                    @endif
                                </div>
                            @endif
                        @endif
                    @endif
                    <hr class="my-3">
                    <h2 class="h4 mb-4">Specifications</h2>
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
