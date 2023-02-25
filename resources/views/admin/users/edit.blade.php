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
                    <i class="fa fa-users mr-5"></i> Users
                </h4>
            </div>
        </div>
        <div class="row row-eq-spacing">
            <div class="col-12 col-sm-6 col-lg-3 mb-sm-0 mb-20">
                <div class="card p-15">
                    <h1 class="card-title">
                        <i class="fa fa-check mr-5"></i> Edit User
                    </h1>
                    <form action="/admin/users" method="post" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <input type="hidden" name="u_id" value="{{ $user->id }}">
                        @if ($errors->any())
                        <div class="alert alert-danger mb-20">
                            @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                            @endforeach
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="email" class="required">Email</label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="email" value="{{$user->email}}" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="Company" class="required">Company</label>
                            <input type="text" class="form-control" name="company" id="company" placeholder="Company" value="{{$user->company}}" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="addition" class="">Addition</label>
                            <input type="text" class="form-control" name="addition" id="addition" placeholder="addition" value="{{$user->addition}}" autocomplete="off" >
                        </div>
                        <div class="form-group">
                            <label for="street" class="required">Street</label>
                            <input type="text" class="form-control" name="street" id="street" placeholder="street" value="{{$user->street}}" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="post_box" class="">Post Box</label>
                            <input type="text" class="form-control" name="post_box" id="post_box" placeholder="post_box" value="{{$user->post_box}}" autocomplete="off" >
                        </div>
                        <div class="form-group">
                            <label for="postcode" class="required">Postcode</label>
                            <input type="text" class="form-control" name="postcode" id="postcode" placeholder="postcode" value="{{$user->postcode}}" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="town" class="required">Town</label>
                            <input type="text" class="form-control" name="town" id="town" placeholder="town" value="{{$user->town}}" autocomplete="off" required>
                        </div>                      
                        <div class="form-group">
                            <label for="country" class="required">Country</label>
                            <select class="form-control" name="country" id="country" required>
                                <option value=""  disabled hidden>Select country</option>
                                <option value="Switzerland" selected>Switzerland</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="form_of_address" class="required">Address</label>
                            <input type="text" class="form-control" name="form_of_address" id="form_of_address" placeholder="form_of_address" value="{{$user->form_of_address}}" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="ide" class="">IDE number</label>
                            <input type="text" class="form-control" name="ide" id="ide" placeholder="ide" value="{{$user->ide}}" autocomplete="off" >
                        </div>
                        <div class="form-group">
                            <label for="first_name" class="required">First name</label>
                            <input type="text" class="form-control" name="first_name" id="first_name" placeholder="" value="{{$user->first_name}}" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="surname" class="required">Surname</label>
                            <input type="text" class="form-control" name="surname" id="surname" placeholder="" value="{{$user->surname}}" autocomplete="off" required>
                        </div>                       
                        <div class="form-group">
                            <label for="phone" class="required">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" placeholder="" value="{{$user->phone}}" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="mobile" class="required">Mobile</label>
                            <input type="text" class="form-control" name="mobile" id="mobile" placeholder="" value="{{$user->mobile}}" autocomplete="off" >
                        </div>
                        <div class="form-group">
                            <label for="lang" class="">Language</label>
                            <select class="form-control" name="lang" id="lang" >
                                <option value="" selected disabled hidden>Language</option>
                                <option value="English" {{$user->lang === 'English' ? 'selected' : '' }}>English</option>
                                <option value="German"   {{$user->lang === 'German' ? 'selected' : '' }}>German</option>
                                <option value="French"   {{$user->lang === 'French' ? 'selected' : '' }}>French</option>
                                <option value="Italian"  {{$user->lang === 'Italian' ? 'selected' : '' }} >Italian</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="membership" class="">Choose membership</label>
                            <select class="form-control" name="membership" id="membership" >
                                <option value="" selected disabled hidden>Membership</option>
                                @foreach ($memberships as $m)
                                <option value="{{ $m->title }}" {{ $m->title === $user->membership ? 'selected' : '' }}>{{ $m->title }}</option>
                                @endforeach
                            </select>
                        </div>
                       
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
                                            <th class="w-25">ID</th>
                                            <td>{{ $user->id }}</td>
                                        </tr>
                                        <tr>
                                            <th class="w-25">Company</th>
                                            <td>{{ $user->company }}</td>
                                        </tr>
                                        <tr>
                                            <th class="w-25">Addition</th>
                                            <td>{{ $user->addition }}</td>
                                        </tr>
                                        <tr>
                                            <th class="w-25">Street</th>
                                            <td>{{ $user->street }}</td>
                                        </tr>
                                        <tr>
                                            <th class="w-25">Post box</th>
                                            <td>{{ $user->post_box }}</td>
                                        </tr>
                                        <tr>
                                            <th class="w-25">Post code</th>
                                            <td>{{ $user->postcode }}</td>
                                        </tr>
                                        <tr>
                                            <th class="w-25">Town</th>
                                            <td>{{ $user->town }}</td>
                                        </tr>
                                        <tr>
                                            <th class="w-25">Country</th>
                                            <td>{{ $user->country }}</td>
                                        </tr>
                                        <tr>
                                            <th class="w-25">IDE Number</th>
                                            <td>@if($user->ide) CHE-{{number_format($user->ide, 0, ',', '.')}} @else - @endif </td>
                                        </tr>

                                        <tr>
                                            <th class="w-25">Form of address</th>
                                            <td>{{ $user->form_of_address }}</td>
                                        </tr>
                                        <tr>
                                            <th class="w-25">Name</th>
                                            <td>{{ $user->first_name }} {{ $user->surname }}</td>
                                        </tr>
                                        <tr>
                                            <th class="w-25">Username</th>
                                            <td>{{ $user->username }}</td>
                                        </tr>
                                        <tr>
                                            <th class="w-25">Email address</th>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th class="w-25">Phone number</th>
                                            <td>{{ $user->phone }}</td>
                                        </tr>
                                        <tr>
                                            <th class="w-25">Mobile number</th>
                                            <td>{{ $user->mobile }}</td>
                                        </tr>
                                        <tr>
                                            <th class="w-25">Language</th>
                                            <td>{{ $user->lang }}</td>
                                        </tr>
                                        <tr>
                                            <th class="w-25">Membership</th>
                                            <td>{{ $user->membership ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <th class="w-25">Created Date</th>
                                            <td>{{ $user->created_at }}</td>
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