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
                <div class="col-12">
                    <div class="card p-15">
                        <div class="row justify-content-start justify-content-sm-between align-items-center mb-20">
                            <div class="col-12 col-lg-auto mb-lg-0 mb-10">
                                <h1 class="card-title mb-0">
                                    <i class="fa fa-database mr-5"></i> All Users
                                </h1>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table-bordered table">
                                <thead>
                                    <tr>
                                        <th class="w-25">ID</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th class="w-25">Status</th>
                                        <th class="w-25">Email verified</th>
                                        <th>Phone number</th>
                                        <th>Email address</th>
                                        <th>Company</th>
                                        <th>Country</th>
                                        <th class="w-25"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                        <tr>
                                            <td>
                                                <div class="text-wrap">{{ $user->id }}</div>
                                            </td>
                                            <td>
                                                <div class="text-wrap">{{ $user->first_name }} {{ $user->surname }}</div>
                                            </td>
                                            <td>
                                                <div class="text-wrap">{{ $user->username }}</div>
                                            </td>
                                            <td>
                                                <div class="text-wrap">
                                                    @if ($user->isApproved)
                                                        <span class="badge badge-primary">Approved</span>
                                                    @else
                                                        <span class="badge badge-danger">Not Approved</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-wrap">
                                                    @if ($user->isEmailVerified)
                                                        <span class="badge badge-primary">yes</span>
                                                    @else
                                                        <span class="badge badge-danger">No</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-wrap">{{ $user->phone }}</div>
                                            </td>
                                            <td>
                                                <div class="text-wrap">{{ $user->email }}</div>
                                            </td>
                                            <td>
                                                <div class="text-wrap">{{ $user->company }}</div>
                                            </td>
                                            <td>
                                                <div class="text-wrap">{{ $user->country }}</div>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-end">
                                                    <form action="/admin/users/accept" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="u_id" value="{{ $user->id }}">
                                                        <button class="btn btn-primary btn-square mr-5" @if ($user->isApproved) disabled @endif>
                                                            <i class="fa fa-check"></i>
                                                        </button>
                                                    </form>
                                                    <form action="/admin/users/reject" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="u_id" value="{{ $user->id }}">
                                                        <button class="btn btn-danger btn-square mr-5" @if (!$user->isApproved) disabled @endif>
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                    <form action="/admin/users/{{$user->id}}" method="post">
                                                        @csrf
                                                        @method('DELETE')
                                                        <!-- <input type="hidden" name="u_id" value="{{ $user->id }}"> -->
                                                        <button class="btn btn-danger btn-square mr-5">
                                                            <i class="fa fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                 
                                                    <a href="/admin/users/{{ $user->id }}" class="btn btn-primary btn-square">
                                                        <i class="fa fa-wrench"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="9">
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
