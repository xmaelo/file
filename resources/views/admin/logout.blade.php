@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <div class="container h-full">
            <div class="row justify-content-center align-items-center h-full">
                <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                    <div class="card p-15">
                        <h1 class="card-title">
                            <i class="fa fa-sign-out-alt mr-5"></i> Logout
                        </h1>
                        <form action="#" method="post">
                            <div class="form-group">
                                <span>Are you sure, you want to logout?</span>
                            </div>
                            <div class="text-right">
                                <button id="back" class="btn mr-5">
                                    <i class="fa fa-times mr-5"></i> Cancel
                                </button>
                                <a class="btn btn-danger" href="/admin/logout">Logout</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
