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
                        <i class="fa fa-star mr-5"></i> Price
                    </h4>
                </div>
            </div>
            <div class="row row-eq-spacing">
                <div class="col-12 col-sm-6 col-lg-3 mb-sm-0 mb-20">
                    <div class="card p-15">
                        <h1 class="card-title">
                            <i class="fa fa-check mr-5"></i> Edit Price
                        </h1>
                        <form action="/admin/prices/{{ $price->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="form-group">
                                <label for="price" class="required">Edit price</label>
                                <input type="number" name="price" id="price" class="form-control" value="{{ $price->price }}" placeholder="Name" maxlength="191" autocomplete="off" required>
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
                                    <i class="fa fa-check mr-5"></i> Edit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-9">
                    <div class="card p-15">
                        <h1 class="card-title">
                            <i class="fa fa-info-circle mr-5"></i> Information
                        </h1>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table-bordered table">
                                        <tbody>
                                            <tr>
                                                <th class="w-25">Name</th>
                                                <td>{{ $price->name }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Price</th>
                                                <td>CHF {{number_format($price->price, 0,",", "'")}}.00</td>
                                            </tr>                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
