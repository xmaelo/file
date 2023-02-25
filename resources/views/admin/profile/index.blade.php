@extends('layouts.admin')

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
                        <i class="fa fa-user mr-5"></i> Profile
                    </h4>
                </div>
            </div>
            <div class="row row-eq-spacing">
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="card p-15">
                        <h1 class="card-title">
                            <i class="fa fa-check mr-5"></i> Edit Password
                        </h1>
                        <form action="/admin/accounts/profile" method="post">
                            @if (Session::has('msg'))
                                <div class="alert alert-success mb-20">
                                    {{ Session::get('msg') }}
                                </div>
                            @endif
                            @if (Session::has('err'))
                                <div class="alert alert-danger mb-20">
                                    {{ Session::get('err') }}
                                </div>
                            @endif
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="new-password" class="required">Enter new password</label>
                                <input type="password" name="pw" id="new-password" class="form-control" placeholder="New Password" minlength="6" maxlength="32" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm-new-password" class="required">Confirm new password</label>
                                <input type="password" name="cpw" id="confirm-new-password" class="form-control" placeholder="Confirm New Password" minlength="6" maxlength="32" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="current-password" class="required">Enter current password</label>
                                <input type="password" name="current" id="current-password" class="form-control" placeholder="Current Password" minlength="6" maxlength="32" autocomplete="off" required>
                            </div>
                            <div class="text-right">
                                <button class="btn" type="submit">
                                    <i class="fa fa-check mr-5"></i> Edit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
