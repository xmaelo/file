@php $id = 'account'; $subId = 'profile'; @endphp
@section('title') FastAuktion | Profile @endsection
@extends('layouts.layout')
@section('content')
<div class="container mt-5 pt-5">
    <nav class="mb-3 pt-md-3" aria-label="Breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Account</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile</li>

        </ol>
    </nav>
</div>
<div class="container my-3">
    <div class="alert alert-warning">
      If you update your profile your account will be disabled temporarily until admin approves the changes.
    </div>
</div>
@if(session()->has('updated'))
<div class="container my-3">
    <div class="alert alert-success">
        {{session()->get('updated')}}
    </div>
</div>
@endif
@if(session()->has('msg'))
<div class="container my-3">
    <div class="alert alert-success">
        {{session()->get('msg')}}
    </div>
</div>
@endif
@if(session()->has('err'))
<div class="container my-3">
    <div class="alert alert-danger">
        {{session()->get('err')}}
    </div>
</div>
@endif
<section class="container mt-3 pt-3 mb-3 pb-lg-3">
    <div class="row">

        @include('layouts.user_sidebar')

        <div class="col-lg-8 col-md-7">
            <h1 class="h2">Profile</h1>
            <form action="/accounts/profile/update" method="post">
                @csrf
                @method('PUT')
                <div class="row pt-2">
                    <div class="col-12 col-md-6">
                        <div class="border rounded-3 p-3 mb-4 mb-md-0" id="company-info">
                            <div class="border-bottom pb-3 mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="pe-2 opacity-70">
                                        <label class="form-label fw-bold">Company</label>
                                        <div id="company-value">{{$client->company}}</div>
                                    </div>
                                    <div class="me-n3" data-bs-toggle="tooltip" title="Edit">
                                        <a class="nav-link py-0" href="#company-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a>
                                    </div>
                                </div>
                                <div class="collapse" id="company-collapse" data-bs-parent="#company-info">
                                    <input class="form-control mt-3" type="text" name="company" data-bs-binded-element="#company-value" data-bs-unset-value="Not specified" maxlength="255" value="{{$client->company}}" required>
                                </div>
                            </div>
                            <div class="border-bottom pb-3 mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="pe-2 opacity-70">
                                        <label class="form-label fw-bold">Addition</label>
                                        <div id="addition-value">{{$client->addition}}</div>
                                    </div>
                                    <div class="me-n3" data-bs-toggle="tooltip" title="Edit">
                                        <a class="nav-link py-0" href="#addition-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a>
                                    </div>
                                </div>
                                <div class="collapse" id="addition-collapse" data-bs-parent="#company-info">
                                    <input class="form-control mt-3" type="text" name="addition" data-bs-binded-element="#addition-value" data-bs-unset-value="Not specified" maxlength="255" value="{{$client->addition}}">
                                </div>
                            </div>
                            <div class="border-bottom pb-3 mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="pe-2 opacity-70">
                                        <label class="form-label fw-bold">Street/Number</label>
                                        <div id="street-value">{{$client->street}}</div>
                                    </div>
                                    <div class="me-n3" data-bs-toggle="tooltip" title="Edit">
                                        <a class="nav-link py-0" href="#street-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a>
                                    </div>
                                </div>
                                <div class="collapse" id="street-collapse" data-bs-parent="#company-info">
                                    <input class="form-control mt-3" type="text" name="street" data-bs-binded-element="#street-value" data-bs-unset-value="Not specified" maxlength="255" value="{{$client->street}}" required>
                                </div>
                            </div>
                            <div class="border-bottom pb-3 mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="pe-2 opacity-70">
                                        <label class="form-label fw-bold">Post box</label>
                                        <div id="post-box-value">{{$client->post_box}}</div>
                                    </div>
                                    <div class="me-n3" data-bs-toggle="tooltip" title="Edit">
                                        <a class="nav-link py-0" href="#post-box-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a>
                                    </div>
                                </div>
                                <div class="collapse" id="post-box-collapse" data-bs-parent="#company-info">
                                    <input class="form-control mt-3" type="text" name="post_box" data-bs-binded-element="#post-box-value" data-bs-unset-value="Not specified" maxlength="255" value="{{$client->post_box}}">
                                </div>
                            </div>
                            <div class="border-bottom pb-3 mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="pe-2 opacity-70">
                                        <label class="form-label fw-bold">Post code</label>
                                        <div id="post-code-value">{{$client->postcode}}</div>
                                    </div>
                                    <div class="me-n3" data-bs-toggle="tooltip" title="Edit">
                                        <a class="nav-link py-0" href="#post-code-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a>
                                    </div>
                                </div>
                                <div class="collapse" id="post-code-collapse" data-bs-parent="#company-info">
                                    <input class="form-control mt-3" type="text" name="postcode" data-bs-binded-element="#post-code-value" data-bs-unset-value="Not specified" maxlength="255" value="{{$client->postcode}}" required>
                                </div>
                            </div>
                            <div class="border-bottom pb-3 mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="pe-2 opacity-70">
                                        <label class="form-label fw-bold">Town</label>
                                        <div id="town-value">{{$client->town}}</div>
                                    </div>
                                    <div class="me-n3" data-bs-toggle="tooltip" title="Edit">
                                        <a class="nav-link py-0" href="#town-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a>
                                    </div>
                                </div>
                                <div class="collapse" id="town-collapse" data-bs-parent="#company-info">
                                    <input class="form-control mt-3" type="text" name="town" data-bs-binded-element="#town-value" data-bs-unset-value="Not specified" maxlength="255" value="{{$client->town}}" required>
                                </div>
                            </div>
                            <div class="border-bottom pb-3 mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="pe-2 opacity-70">
                                        <label class="form-label fw-bold">Country</label>
                                        <div id="country-value">{{$client->country}}</div>
                                    </div>
                                    <div class="me-n3" data-bs-toggle="tooltip" title="Edit">
                                        <a class="nav-link py-0" href="#country-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a>
                                    </div>
                                </div>
                                <div class="collapse" id="country-collapse" data-bs-parent="#company-info">
                                    <select name="country" class="form-select mt-3" data-bs-binded-element="#country-value" data-bs-unset-value="Not specified" required>
                                        <option value="Switzerland" selected>Switzerland</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="border rounded-3 p-3 mb-4" id="personal-info">
                            <div class="border-bottom pb-3 mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="pe-2 opacity-70">
                                        <label class="form-label fw-bold">Form of address</label>
                                        <div id="form-of-address-value">{{$client->form_of_address}}</div>
                                    </div>
                                    <div class="me-n3" data-bs-toggle="tooltip" title="Edit">
                                        <a class="nav-link py-0" href="#form-of-address-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a>
                                    </div>
                                </div>
                                <div class="collapse" id="form-of-address-collapse" data-bs-parent="#personal-info">
                                    <select name="form_of_address" class="form-select mt-3" data-bs-binded-element="#form-of-address-value" data-bs-unset-value="Not specified" required>
                                        <option value="Mr." selected>Mr.</option>
                                        <option value="Mrs.">Mrs.</option>
                                    </select>
                                </div>
                            </div>
                            <div class="border-bottom pb-3 mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="pe-2 opacity-70">
                                        <label class="form-label fw-bold">First name</label>
                                        <div id="first-name-value">{{$client->first_name}}</div>
                                    </div>
                                    <div class="me-n3" data-bs-toggle="tooltip" title="Edit">
                                        <a class="nav-link py-0" href="#first-name-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a>
                                    </div>
                                </div>
                                <div class="collapse" id="first-name-collapse" data-bs-parent="#personal-info">
                                    <input class="form-control mt-3" type="text" name="first_name" data-bs-binded-element="#first-name-value" data-bs-unset-value="Not specified" maxlength="255" value="{{$client->first_name}}" required>
                                </div>
                            </div>
                            <div class="border-bottom pb-3 mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="pe-2 opacity-70">
                                        <label class="form-label fw-bold">Surname</label>
                                        <div id="surname-value">{{$client->surname}}</div>
                                    </div>
                                    <div class="me-n3" data-bs-toggle="tooltip" title="Edit">
                                        <a class="nav-link py-0" href="#surname-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a>
                                    </div>
                                </div>
                                <div class="collapse" id="surname-collapse" data-bs-parent="#personal-info">
                                    <input class="form-control mt-3" type="text" name="surname" data-bs-binded-element="#surname-value" data-bs-unset-value="Not specified" maxlength="255" value="{{$client->surname}}" required>
                                </div>
                            </div>
                            <div class="border-bottom pb-3 mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="pe-2 opacity-70">
                                        <label class="form-label fw-bold">Email address</label>
                                        <div id="email-value">{{$client->email}}</div>
                                    </div>
                                    <div class="me-n3" data-bs-toggle="tooltip" title="Edit">
                                        <a class="nav-link py-0" href="#email-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a>
                                    </div>
                                </div>
                                <div class="collapse" id="email-collapse" data-bs-parent="#personal-info">
                                    <input class="form-control mt-3" type="email" name="email" data-bs-binded-element="#email-value" data-bs-unset-value="Not specified" maxlength="255" value="{{$client->email}}" required>
                                </div>
                            </div>
                            <div class="border-bottom pb-3 mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="pe-2 opacity-70">
                                        <label class="form-label fw-bold">Telephone number</label>
                                        <div id="telephone-value">{{$client->phone}}</div>
                                    </div>
                                    <div class="me-n3" data-bs-toggle="tooltip" title="Edit">
                                        <a class="nav-link py-0" href="#telephone-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a>
                                    </div>
                                </div>
                                <div class="collapse" id="telephone-collapse" data-bs-parent="#personal-info">
                                    <input class="form-control mt-3" type="tel" name="phone" data-bs-binded-element="#telephone-value" data-bs-unset-value="Not specified" maxlength="15" value="{{$client->phone}}" placeholder="Enter with area code" required>
                                </div>
                            </div>
                            <div class="border-bottom pb-3 mb-3">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="pe-2 opacity-70">
                                        <label class="form-label fw-bold">Mobile number</label>
                                        <div id="mobile-value">{{$client->mobile}}</div>
                                    </div>
                                    <div class="me-n3" data-bs-toggle="tooltip" title="Edit">
                                        <a class="nav-link py-0" href="#mobile-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a>
                                    </div>
                                </div>
                                <div class="collapse" id="mobile-collapse" data-bs-parent="#personal-info">
                                    <input class="form-control mt-3" type="tel" name="mobile" data-bs-binded-element="#mobile-value" data-bs-unset-value="Not specified" maxlength="15" value="{{$client->mobile}}" placeholder="Enter with area code">
                                </div>
                            </div>
                            <div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="pe-2 opacity-70">
                                        <label class="form-label fw-bold">Preferred language</label>
                                        <div id="preferred-language-value">{{$client->lang}}</div>
                                    </div>
                                    <div class="me-n3" data-bs-toggle="tooltip" title="Edit">
                                        <a class="nav-link py-0" href="#preferred-language-collapse" data-bs-toggle="collapse"><i class="fi-edit"></i></a>
                                    </div>
                                </div>
                                <div class="collapse" id="preferred-language-collapse" data-bs-parent="#personal-info">
                                    <select name="lang" class="form-select mt-3" data-bs-binded-element="#preferred-language-value" data-bs-unset-value="Not specified">
                                        <option value="English" selected>English</option>
                                        <option value="German">German</option>
                                        <option value="Franch">French</option>
                                        <option value="Italian">Italian</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <a class="btn btn-link btn-sm px-0" href="#"><i class="fi-trash me-2"></i>Delete account</a>

                            <button class="btn btn-accent bg-gradient border-0">Save changes</button>

                        </div>
                    </div>
                </div>
            </form>
            <div class="row mt-5 mb-5">
                <div class="col-12">
                    <hr class="hr-dark">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <form action="/accounts/password" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label class="form-label" for="current-password">Current password <span class="text-danger">*</span></label>
                            <div class="password-toggle">
                                <input class="form-control" type="password" id="current-password" name="current-password" minlength="6" maxlength="32" required>
                                <label class="password-toggle-btn" aria-label="Show/hide password">
                                    <input class="password-toggle-check" type="checkbox">
                                    <span class="password-toggle-indicator"></span>
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="new-password">New password <span class="text-danger">*</span></label>
                            <div class="password-toggle">
                                <input class="form-control" type="password" id="new-password" name="new-password" minlength="6" maxlength="32" required>
                                <label class="password-toggle-btn" aria-label="Show/hide password">
                                    <input class="password-toggle-check" type="checkbox">
                                    <span class="password-toggle-indicator"></span>
                                </label>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="confirm-new-password">Confirm new password <span class="text-danger">*</span></label>
                            <div class="password-toggle">
                                <input class="form-control" type="password" id="confirm-password" name="confirm-password" minlength="6" maxlength="32" required>
                                <label class="password-toggle-btn" aria-label="Show/hide password">
                                    <input class="password-toggle-check" type="checkbox">
                                    <span class="password-toggle-indicator"></span>
                                </label>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-accent bg-gradient border-0">Change password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection