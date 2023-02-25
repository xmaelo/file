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
                    <i class="fa fa-gavel mr-5"></i> Auctions
                </h4>
            </div>
        </div>
        <div class="row row-eq-spacing">
            <div class="col-12 col-sm-6 col-lg-3 mb-sm-0 mb-20">
                <div class="card p-15">
                    <h1 class="card-title">
                        <i class="fa fa-plus mr-5"></i> Add auction
                    </h1>
                    <form action="/admin/schedule" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title" class="required">Choose start date</label>
                            <input class="form-control date-picker pe-5 rounded" type="text" id="start_date" name="start_date" placeholder="Start Date" required>
                        </div>
                        <div class="form-group">
                            <label for="description" class="required">Choose end date</label>
                            <input type="text" class="form-control" name="end_date" id="end_date" placeholder="End Date" required>
                        </div>
                        @section('scripts')
                        <script>
                            flatpickr("#start_date", {
                                enableTime: true,
                                minDate: 'today',
                                dateFormat: "Y-m-d H:i",
                                //disable: {!!$auction_dates!!}
                            });
                            flatpickr("#end_date", {
                                enableTime: true,
                                minDate: 'today',
                                dateFormat: "Y-m-d H:i",
                                //disable: {!!$auction_dates!!},
                            });
                        </script>
                        @endsection
                        @if ($errors->any())
                        <div class="alert alert-danger mb-20">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="text-right">
                            <button type="submit" class="btn">
                                <i class="fa fa-plus mr-5"></i> Add
                            </button>
                        </div>
                        @if (session('err'))
                        <div class="alert alert-danger">
                            {{ session('err') }}
                        </div>
                        @endif
                    </form>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-9">
                <div class="card p-15">
                    <h1 class="card-title">
                        <i class="fa fa-database mr-5"></i> All Auctions
                    </h1>
                    <div class="table-responsive">
                        <table class="table-bordered table">
                            <thead>
                                <tr>
                                    <th class="w-25">ID</th>
                                    <th class="w-25">Status</th>
                                    <th>Start date</th>
                                    <th>End date</th>
                                    <th class="w-25"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($auctions as $a)
                                <tr>
                                    <td>{{ $a->id }}</td>
                                    <td>
                                        @if ($a->isFinished)
                                        <span class="badge badge-primary">Finished</span>
                                        @else
                                        <span class="badge badge-danger">Not Finished</span>
                                        @endif
                                    </td>
                                    <td>{{ $a->start_date }}</td>
                                    <td>{{ $a->end_date }}</td>
                                    <td>
                                        <form action="/admin/schedule/{{$a->id}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-square mr-5">
                                                <i class="fa fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="4">
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
