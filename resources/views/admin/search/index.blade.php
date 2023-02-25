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
                    <i class="fa fa-car mr-5"></i> Cars
                </h4>
            </div>
        </div>
        <div class="row row-eq-spacing">
        <div class="col-12 col-sm-6 col-lg-3 mb-sm-0 mb-20">
                    <div class="card p-15">
                        <h1 class="card-title">
                            <i class="fa fa-search mr-5"></i> Search Cars
                        </h1>
                        <form action="/admin/search-cars" method="get">
                            @csrf                           
                            <div class="form-group">
                                <label for="title" class="required">Search</label>
                                <input type="text" name="ref_number" id="ref_number" class="form-control" value="" placeholder="Enter reference number" >
                            </div>                          
                            
                            @if ($errors->any())
                                <div class="alert alert-danger mb-20">
                                    @foreach ($errors->all() as $error)
                                        <div>{{ $error }}</div>
                                    @endforeach
                                </div>
                            @endif
                            <div class="text-right">
                                <button type="submit" class="btn">
                                    <i class="fa fa-search mr-5"></i> Search
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            <div class="col-12 col-sm-6 col-lg-9">
                <div class="card p-15">
                    <div class="row justify-content-start justify-content-sm-between align-items-center mb-20">
                        <div class="col-12 col-lg-auto mb-lg-0 mb-10">
                            <h1 class="card-title mb-0">
                                <i class="fa fa-database mr-5"></i> All Cars
                            </h1>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table-bordered table">
                            <thead>
                                <tr>
                                    <th class="w-25">ID</th>
                                    <th>Reference no</th>
                                    <th>Brand</th>
                                    <th>Status</th>                                   
                                    <th>Buyer Company</th>
                                    <th>Sold Price</th>
                                    <th>Body type</th>
                                    <th>Model</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($cars as $car)
                                <tr>
                                    <td>
                                        <div class="text-wrap">{{ $car->id }}</div>
                                    </td>
                                    <td>
                                        <div class="text-wrap">{{ $car->ref_number }}</div>
                                    </td>
                                    <td>
                                        <div class="text-wrap">{{ $car->brand }}</div>
                                    </td>
                                    <td>
                                        <div class="text-wrap">{{ $car->status }}</div>
                                    </td>
                                    <td>
                                        <div class="text-wrap">{{ $car->p_id ? buyerInfo($car->p_id)->company : '-'  }}</div>
                                    </td>
                                    <td>
                                        <div class="text-wrap">{{ $car->max_bid ?? '-'  }}</div>
                                    </td>
                                    <td>
                                        <div class="text-wrap">{{ $car->body_type ?? '-'  }}</div>
                                    </td>
                                    <td>
                                        <div class="text-wrap">{{ $car->model ?? '-'  }}</div>
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