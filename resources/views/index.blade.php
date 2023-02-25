@php $id = 'index'; @endphp

@extends('layouts.layout')

@section('title')
    Homepage
@endsection

@section('content')
    @if (session()->has('status'))
        <script>
            alert('We have emailed your reset link.');
        </script>
    @endif
    <section class="bg-top-center bg-repeat-0 pt-5">
        <div class="container pt-5">
            
            <div class="row pt-md-5 pt-0">
                <div class="col-lg-4 col-md-5">
                    <h1 class="display-4">{{ __('index.title') }}</h1>
                    <p class="fs-lg opacity-70">{{ __('index.desc') }}</p>
                </div>
                <div class="col-lg-8 col-md-7">
                    <img class="d-block ms-auto" src="/assets/images/hero-img.jpg" width="800" alt="hero">
                </div>
            </div>
        </div>
        @if (session()->has('client_id'))
            <div class="container pt-5">
                <form action="" method="get" class="form-group d-block p-4">
                    <div class="row align-items-end">
                        <div class="col-md-3 col-sm-6 mb-2">
                            <label for="brand">Brand</label>
                            <select name="brand" id="brand" class="form-select rounded border">
                                <option value="" selected>All Brands</option>
                                <option value="Alfa Romeo">Alfa Romeo</option>
                                <option value="Audi">Audi</option>
                                <option value="BMW">BMW</option>
                                <option value="Cadillac">Cadillac</option>
                                <option value="Chevrolet">Chevrolet</option>
                                <option value="Citroen">Citroen</option>
                                <option value="Fiat">Fiat</option>
                                <option value="Ford">Ford</option>
                                <option value="Honda">Honda</option>
                                <option value="Jeep">Jeep</option>
                                <option value="Land Rover">Land Rover</option>
                                <option value="Laverda">Laverda</option>
                                <option value="Man">Man</option>
                                <option value="Maserati">Maserati</option>
                                <option value="Mazda">Mazda</option>
                                <option value="Mercedes Benz">Mercedes Benz</option>
                                <option value="MG">MG</option>
                                <option value="Mini">Mini</option>
                                <option value="Mitsubishi">Mitsubishi</option>
                                <option value="Nissan">Nissan</option>
                                <option value="Opel">Opel</option>
                                <option value="Peugeot">Peugeot</option>
                                <option value="Porsche">Porsche</option>
                                <option value="Regal Raptor">Regal Raptor</option>
                                <option value="Renault">Renault</option>
                                <option value="Seat">Seat</option>
                                <option value="Skoda">Skoda</option>
                                <option value="Smart">Smart</option>
                                <option value="Steinbock">Steinbock</option>
                                <option value="Suzuki">Suzuki</option>
                                <option value="Thwaites">Thwaites</option>
                                <option value="Toyota">Toyota</option>
                                <option value="Volkswagen">Volkswagen</option>
                                <option value="Volvo">Volvo</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-2">
                            <label for="fuel">Fuel</label>
                            <select name="fuel" id="fuel" class="form-select rounded border">
                                <option value="" selected>All Fuels</option>
                                <option value="Diesel">Diesel</option>
                                <option value="Electrical">Electrical</option>
                                <option value="Hybrid">Hybrid</option>
                                <option value="Petrol">Petrol</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-2">
                            <label for="gear">Gear</label>
                            <select name="gear" id="gear" class="form-select rounded border">
                                <option value="" selected>All Gears</option>
                                <option value="Automatic">Automatic</option>
                                <option value="Manual">Manual</option>
                                <option value="Semi-Automatic">Semi-Automatic</option>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-2">
                            <label for="traction">Traction</label>
                            <select name="traction" id="traction" class="form-select rounded border">
                                <option value="" selected>All Tractions</option>
                                <option value="4x4">4x4</option>
                                <option value="Front">Front</option>
                                <option value="Rear">Rear</option>
                            </select>
                        </div>
                    </div>
                    <div class="row align-items-end">
                        <div class="col-md-3 col-sm-6 mb-md-0 mb-2">
                            <div class="row">
                                <label for="year-from">Year</label>
                                <div class="col-6">
                                    <select name="year-from" id="year-from" class="form-select rounded border">
                                        <option value="" selected>From</option>
                                        <option value="1921">1921</option>
                                        <option value="1930">1930</option>
                                        <option value="1935">1935</option>
                                        <option value="1958">1958</option>
                                        <option value="1984">1984</option>
                                        <option value="1985">1985</option>
                                        <option value="1991">1991</option>
                                        <option value="1995">1995</option>
                                        <option value="1996">1996</option>
                                        <option value="1998">1998</option>
                                        <option value="2001">2001</option>
                                        <option value="2002">2002</option>
                                        <option value="2003">2003</option>
                                        <option value="2004">2004</option>
                                        <option value="2005">2005</option>
                                        <option value="2006">2006</option>
                                        <option value="2007">2007</option>
                                        <option value="2008">2008</option>
                                        <option value="2009">2009</option>
                                        <option value="2010">2010</option>
                                        <option value="2011">2011</option>
                                        <option value="2012">2012</option>
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select name="year-to" id="year-to" class="form-select rounded border">
                                        <option value="" selected>To</option>
                                        <option value="1921">1921</option>
                                        <option value="1930">1930</option>
                                        <option value="1935">1935</option>
                                        <option value="1958">1958</option>
                                        <option value="1984">1984</option>
                                        <option value="1985">1985</option>
                                        <option value="1991">1991</option>
                                        <option value="1995">1995</option>
                                        <option value="1996">1996</option>
                                        <option value="1998">1998</option>
                                        <option value="2001">2001</option>
                                        <option value="2002">2002</option>
                                        <option value="2003">2003</option>
                                        <option value="2004">2004</option>
                                        <option value="2005">2005</option>
                                        <option value="2006">2006</option>
                                        <option value="2007">2007</option>
                                        <option value="2008">2008</option>
                                        <option value="2009">2009</option>
                                        <option value="2010">2010</option>
                                        <option value="2011">2011</option>
                                        <option value="2012">2012</option>
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-md-0 mb-2">
                            <div class="row">
                                <label for="milage-from">Milage</label>
                                <div class="col-6">
                                    <select name="milage-from" id="milage-from" class="form-select rounded border">
                                        <option value="" selected>From</option>
                                        <option value="<10000">
                                            < 10,000 </option>
                                        <option value="10000">10,000</option>
                                        <option value="20000">20,000</option>
                                        <option value="30000">30,000</option>
                                        <option value="40000">40,000</option>
                                        <option value="50000">50,000</option>
                                        <option value="60000">60,000</option>
                                        <option value="70000">70,000</option>
                                        <option value="80000">80,000</option>
                                        <option value="90000">90,000</option>
                                        <option value="100000">100,000</option>
                                        <option value="110000">110,000</option>
                                        <option value="120000">120,000</option>
                                        <option value="130000">130,000</option>
                                        <option value="140000">140,000</option>
                                        <option value="150000">150,000</option>
                                        <option value="160000">160,000</option>
                                        <option value="170000">170,000</option>
                                        <option value="180000">180,000</option>
                                        <option value="190000">190,000</option>
                                        <option value="200000">200,000</option>
                                        <option value="210000">210,000</option>
                                        <option value="220000">220,000</option>
                                        <option value="230000">230,000</option>
                                        <option value="240000">240,000</option>
                                        <option value="250000">250,000</option>
                                        <option value="260000">260,000</option>
                                        <option value="270000">270,000</option>
                                        <option value="310000">310,000</option>
                                        <option value="9990000">9,990,000</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select name="milage-to" id="milage-to" class="form-select rounded border">
                                        <option value="" selected>To</option>
                                        <option value="<10000">
                                            < 10,000 </option>
                                        <option value="10000">10,000</option>
                                        <option value="20000">20,000</option>
                                        <option value="30000">30,000</option>
                                        <option value="40000">40,000</option>
                                        <option value="50000">50,000</option>
                                        <option value="60000">60,000</option>
                                        <option value="70000">70,000</option>
                                        <option value="80000">80,000</option>
                                        <option value="90000">90,000</option>
                                        <option value="100000">100,000</option>
                                        <option value="110000">110,000</option>
                                        <option value="120000">120,000</option>
                                        <option value="130000">130,000</option>
                                        <option value="140000">140,000</option>
                                        <option value="150000">150,000</option>
                                        <option value="160000">160,000</option>
                                        <option value="170000">170,000</option>
                                        <option value="180000">180,000</option>
                                        <option value="190000">190,000</option>
                                        <option value="200000">200,000</option>
                                        <option value="210000">210,000</option>
                                        <option value="220000">220,000</option>
                                        <option value="230000">230,000</option>
                                        <option value="240000">240,000</option>
                                        <option value="250000">250,000</option>
                                        <option value="260000">260,000</option>
                                        <option value="270000">270,000</option>
                                        <option value="310000">310,000</option>
                                        <option value="9990000">9,990,000</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 mb-sm-0 mb-3">
                            <div class="row">
                                <label for="price-from">Price</label>
                                <div class="col-6">
                                    <select name="price-from" id="price-from" class="form-select rounded border">
                                        <option value="" selected>From</option>
                                        <option value="<10000">
                                            < 10,000 </option>
                                        <option value="10000">10,000</option>
                                        <option value="20000">20,000</option>
                                        <option value="30000">30,000</option>
                                        <option value="40000">40,000</option>
                                        <option value="50000">50,000</option>
                                        <option value="70000">70,000</option>
                                        <option value="80000">80,000</option>
                                        <option value="150000">150,000</option>
                                    </select>
                                </div>
                                <div class="col-6">
                                    <select name="price-to" id="price-to" class="form-select rounded border">
                                        <option value="" selected>To</option>
                                        <option value="<10000">
                                            < 10,000 </option>
                                        <option value="10000">10,000</option>
                                        <option value="20000">20,000</option>
                                        <option value="30000">30,000</option>
                                        <option value="40000">40,000</option>
                                        <option value="50000">50,000</option>
                                        <option value="70000">70,000</option>
                                        <option value="80000">80,000</option>
                                        <option value="150000">150,000</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 pt-sm-0 pt-3">
                            <button class="btn btn-accent bg-gradient w-100 border-0" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        @endif
    </section>
    <section class="container pt-5">
        <h2 class="h3 mb-0">
            @if ($nextAuctionCount != 0)
            <span id="auction-title">          
            </span>
            <span class="text-primary" id="getting-started"></span>
             @else
                Auction will start soon
            @endif
        </h2>
        @section('scripts')
        <script>
        $(document).ready(function() {

            var title = "{!! $auctionTitle !!}";

            $('#auction-title').text(title);

            $('#getting-started').countdown({!!$endDate!!},
                function(event) {
                    $(this).html(event.strftime(' %d days %H:%M:%S'));
                })
        });

    </script>
        @endsection
    </section>
    <section class="container">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h2 class="h3 mb-0">Current auctions</h2>
            <a class="btn btn-link fw-normal px-0" href="/vehicles">View all<i class="fi-arrow-long-right fs-sm ps-1 ms-2 mt-0"></i></a>
        </div>
        <div class="row pt-2" id="table-container">
            @forelse($cars as $car)
                <div class="col-lg-6">
                    <div class="card card-light card-hover card-horizontal mb-4 border">
                        <div class="tns-carousel-wrapper card-img-top card-img-hover">
                            <a class="img-overlay" href="/car/{{ $car->slug }}"></a>
                            <div class="position-absolute start-0 ps-3 top-0 pt-3">
                                @if (hasMembership($car->u_id))
                                    <span class="d-table badge bg-info">
                                        {{ getMembership($car->u_id)->title }}
                                    </span>
                                @endif
                            </div>
                            <div class="tns-carousel-inner position-absolute h-100 top-0">
                                @if ($car->images)
                                    @foreach ($car->images as $image)
                                        <div class="bg-size-contain bg-position-center w-100 h-100" style="background-repeat: no-repeat; background-image: url({{ asset('storage/images/cars/' . $image) }});">
                                        </div>
                                    @endforeach
                                    @else
                                    <div class="bg-size-cover bg-position-center w-100 h-100" style="background-image: url({{ asset('/assets/images/no-car.jpg') }});">
                                        </div>
                                    
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
                            @if (session()->has('client_id'))
                                <div class="text-primary fw-bold mb-1">CHF {{number_format($car->min_price, 0,",", "'")}}.00</div>
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
                <div class="text-center">No data found</div>
            @endforelse
        </div>
        <div class="col-md-6" id="no-cars"></div>
    </section>

    
    @if (!session()->has('client_id'))
    <section class="container pt-5 pb-5">
        <div class="d-sm-flex align-items-center justify-content-between">
            <h2 class="h3 mb-0">What sets FastAuktion apart?</h2>
            <a class="btn btn-link fw-normal px-0" href="/how-it-works/instructions">How to sell cars<i class="fi-arrow-long-right fs-sm ps-1 ms-2 mt-0"></i></a>
        </div>
        <div class="row pt-2">
            <div class="col-md-5 col-lg-4 offset-lg-1 pt-md-5 mt-md-3 mt-2 pt-4">
                <div class="d-flex pb-md-5 mb-2 pb-4">
                    <i class="fi-file lead text-primary order-md-2 mt-1"></i>
                    <div class="text-md-end ps-3 ps-md-0 pe-md-3 order-md-1">
                        <h3 class="h6 mb-1">Over 1 Million Listings</h3>
                        <p class="fs-sm mb-0 opacity-70">That's more than you'll find on any other major online automotive
                            marketplace in the world.</p>
                    </div>
                </div>
                <div class="d-flex pb-md-5 mb-2 pb-4">
                    <i class="fi-search lead text-primary order-md-2 mt-1"></i>
                    <div class="text-md-end ps-3 ps-md-0 pe-md-3 order-md-1">
                        <h3 class="h6 mb-1">Personalized Search</h3>
                        <p class="fs-sm mb-0 opacity-70">Our powerful search makes it easy to personalize your results so
                            you only see the cars and features you care about.</p>
                    </div>
                </div>
                <div class="d-flex pb-md-5 mb-2 pb-4">
                    <i class="fi-settings lead text-primary order-md-2 mt-1"></i>
                    <div class="text-md-end ps-3 ps-md-0 pe-md-3 order-md-1">
                        <h3 class="h6 mb-1">Non-Stop Innovation</h3>
                        <p class="fs-sm mb-0 opacity-70">Our team is constantly developing new features that make the
                            process of buying and selling a car simpler.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 d-none d-md-block">
                <div class="position-relative h-100 mx-auto" style="max-width: 5rem; min-height: 26rem;">
                    <div class="content-overlay pt-5" data-jarallax-element="100">
                        <img class="mt-5 pt-3" src="/assets/images/car.svg" alt="car">
                    </div>
                    <div class="position-absolute start-50 translate-middle-x h-100 top-0 overflow-hidden">
                        <img src="/assets/images/road-line.svg" width="2" alt="road line">
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-lg-4 pt-md-5 mt-md-3">
                <div class="d-flex pb-md-5 mb-2 pb-4">
                    <i class="fi-info-circle lead text-primary mt-1"></i>
                    <div class="ps-3">
                        <h3 class="h6 mb-1">Valuable Insights</h3>
                        <p class="fs-sm mb-0 opacity-70">We provide free access to key info like dealer reviews, market
                            value, price drops.</p>
                    </div>
                </div>
                <div class="d-flex pb-md-5 mb-2 pb-4">
                    <i class="fi-users lead text-primary mt-1"></i>
                    <div class="ps-3">
                        <h3 class="h6 mb-1">Consumer-First Mentality</h3>
                        <p class="fs-sm mb-0 opacity-70">We focus on building the most transparent, trustworthy experience
                            for our users, and we've proven that works for dealers, too.</p>
                    </div>
                </div>
                <div class="d-flex pb-md-5 mb-2 pb-4">
                    <i class="fi-calculator lead text-primary mt-1"></i>
                    <div class="ps-3">
                        <h3 class="h6 mb-1">Online Car Appraisal</h3>
                        <p class="fs-sm mb-0 opacity-70">Specify the parameters of your car to form its market value on the
                            basis of similar cars on FastAuktion.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>  
    @endif 
   
    
    
@endsection
