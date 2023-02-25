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
                    <i class="fa fa-car mr-5"></i> Prices
                </h4>
            </div>
        </div>
        <div class="row row-eq-spacing">
            <div class="col-12">
                <div class="card p-15">
                    <div class="row justify-content-start justify-content-sm-between align-items-center mb-20">
                        <div class="col-12 col-lg-auto mb-lg-0 mb-10">
                            <h1 class="card-title mb-0">
                                <i class="fa fa-database mr-5"></i> All Prices
                            </h1>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table-bordered table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Amount</th>
                                    <th class="w-25"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($prices as $price)
                                <tr>
                                    <td>
                                        <div class="text-wrap">{{ $price->name }}</div>
                                    </td>
                                    <td>
                                        <div class="text-wrap">CHF {{number_format($price->price, 0,",", "'")}}.00</div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end">
                                            <a href="/admin/prices/{{ $price->id }}" class="btn btn-primary btn-square">
                                                <i class="fa fa-wrench"></i>
                                            </a>
                                        </div>
                                    </td>
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
        </div>
    </div>
</div>
@endsection