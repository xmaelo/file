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
                        <i class="fa fa-star mr-5"></i> Memberships
                    </h4>
                </div>
            </div>
            <div class="row row-eq-spacing">
                <div class="col-12 col-sm-6 col-lg-3 mb-sm-0 mb-20">
                    <div class="card p-15">
                        <h1 class="card-title">
                            <i class="fa fa-plus mr-5"></i> Add Membership
                        </h1>
                        <form action="/admin/memberships" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title" class="required">Enter title</label>
                                <input type="text" class="form-control" name="title" id="title" placeholder="Name" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="description" class="required">Enter description</label>
                                <input type="text" class="form-control" name="description" id="description" placeholder="Designation" autocomplete="off" required>
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
                                    <i class="fa fa-plus mr-5"></i> Add
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-9">
                    <div class="card p-15">
                        <h1 class="card-title">
                            <i class="fa fa-database mr-5"></i> All Memberships
                        </h1>
                        <div class="table-responsive">
                            <table class="table-bordered table">
                                <thead>
                                    <tr>
                                        <th class="w-25">Title</th>
                                        <th>Description</th>
                                        <th class="w-25"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($memberships as $m)
                                        <tr>
                                            <td>{{ $m->title }}</td>
                                            <td>{{ $m->description }}</td>
                                            <td>
                                                <div class="d-flex justify-content-end">
                                                    <a href="/admin/memberships/{{ $m->id }}" class="btn btn-primary btn-square mr-5">
                                                        <i class="fa fa-wrench"></i>
                                                    </a>
                                                    <form action="/admin/memberships/{{ $m->id }}" method="post">
                                                        @method("DELETE")
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger btn-square">
                                                            <i class="fa fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="3">
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
