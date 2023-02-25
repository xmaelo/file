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
                <div class="col-12">
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
                                        <th>Sale</th>
                                        <th>Brand</th>
                                        <th>Model</th>
                                        <th>Body type</th>
                                        <th>1st registration</th>
                                        <th class="w-25"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($data as $c)
                                        <tr>
                                            <td>
                                                <div class="text-wrap">{{ $c->id }}</div>
                                            </td>                                           
                                            <td>
                                                <div class="text-wrap">{{ $c->status }}</div>
                                            </td>
                                            <td>
                                                <div class="text-wrap">{{ $c->brand }}</div>
                                            </td>
                                            <td>
                                                <div class="text-wrap">{{ $c->model }}</div>
                                            </td>
                                            <td>
                                                <div class="text-wrap">{{ $c->body_type }}</div>
                                            </td>
                                            <td>
                                                <div class="text-wrap">{{ $c->first_registration }}</div>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-end">                                                    
                                                    <form action="/admin/cars/{{$c->id}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger btn-square mr-5">
                                                            <i class="fa fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                    <a href="/admin/cars/{{ $c->id }}" class="btn btn-primary btn-square">
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
