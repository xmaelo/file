@extends("layouts.admin")

@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row row-eq-spacing align-items-center">
            <div class="col-12 col-sm-auto mb-sm-0 mb-20">
                <button id="back" class="btn">
                    <i class="fa fa-chevron-left mr-5"></i> Back
                </button>
            </div>
            <div class="col-12 col-sm-auto">
                <h4 class="my-0">
                    <i class="fa fa-car mr-5"></i> Sold Cars
                </h4>
            </div>
        </div>
        <div class="row row-eq-spacing">
            <div class="col-12">
                <div class="card p-15">
                    <div class="row justify-content-start justify-content-sm-between align-items-center mb-20">
                        <div class="col-12 col-lg-auto mb-lg-0 mb-10">
                            <h1 class="card-title mb-0">
                                <i class="fa fa-database mr-5"></i> All Sold Cars
                            </h1>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table-bordered table">
                            <thead>
                                <tr>
                                    <th class="w-25">ID</th>
                                    <th>Car</th>
                                    <th>Minimum Price</th>
                                    <th>Sold Price</th>
                                    <th>Seller</th>
                                    <th>Buyer</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sold_cars as $c)
                                <tr>
                                    <td>
                                        <div class="text-wrap">{{ $c->id }}</div>
                                    </td>
                                    <td>
                                        <div class="text-wrap">
                                            {{ $c->brand }} <br>
                                            {{ $c->model }} <br>
                                            {{ $c->type }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-wrap">CHF {{number_format($c->min_price, 0,",", "'")}}.00</div>
                                    </td>
                                    <td>
                                        <div class="text-wrap">CHF {{number_format($c->max_bid, 0,",", "'")}}.00</div>
                                    </td>
                                    <td>
                                        <div class="text-wrap">
                                            {{ sellerInfo($c->u_id)->first_name }} {{ sellerInfo($c->u_id)->surname }} <br>
                                            {{ sellerInfo($c->u_id)->email }} <br>
                                            {{ sellerInfo($c->u_id)->phone }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-wrap">
                                            {{ buyerInfo($c->bidder_id)->first_name }} {{ buyerInfo($c->bidder_id)->surname }} <br>
                                            {{ buyerInfo($c->bidder_id)->email }} <br>
                                            {{ buyerInfo($c->bidder_id)->phone }}
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="6">
                                        <i class="fa fa-frown mr-5"></i> No items found!
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection