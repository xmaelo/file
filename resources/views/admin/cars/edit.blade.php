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
                                                <td>{{ $car->id }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Brand</th>
                                                <td>{{ $car->brand }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Model</th>
                                                <td>{{ $car->model }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Type</th>
                                                <td>{{ $car->type }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Body type</th>
                                                <td>{{ $car->body_type }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Doors</th>
                                                <td>{{ $car->doors }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">1st registration</th>
                                                <td>{{ $car->first_registration }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Exterior color</th>
                                                <td>{{ $car->exterior_color }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Exterior finish</th>
                                                <td>{{ $car->exterior_finish }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Interior color</th>
                                                <td>{{ $car->interior_color }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Interior finish</th>
                                                <td>{{ $car->interior_finish }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Special equipments</th>
                                                <td>{{ $car->special_equipments }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Wheel drive</th>
                                                <td>{{ $car->wheel_drive }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Gear</th>
                                                <td>{{ $car->gear }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Fuel</th>
                                                <td>{{ $car->fuel }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Displacement</th>
                                                <td>{{ $car->displacement }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Performance (hp)</th>
                                                <td>{{ $car->performance_hp }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Performance (kW)</th>
                                                <td>{{ $car->performance_kw }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Seats</th>
                                                <td>{{ $car->seats }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Frame number</th>
                                                <td>{{ $car->frame_number }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Model number</th>
                                                <td>{{ $car->model_number }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Vehicle number</th>
                                                <td>{{ $car->vehicle_number }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Direct import</th>
                                                <td>{{ $car->direct_import }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Additional information</th>
                                                <td>{{ $car->additional_info }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Factory price</th>
                                                <td>{{ $car->factory_price }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Registration document</th>
                                                <td>{{ $car->registration_document }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Service record booklet</th>
                                                <td>{{ $car->service_record_booklet }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Inspection</th>
                                                <td>{{ $car->inspection }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Repairs</th>
                                                <td>{{ $car->repairs }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Service record digital</th>
                                                <td>{{ $car->service_record_digital }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">keys</th>
                                                <td>{{ $car->keys }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Mechanics</th>
                                                <td>{{ $car->mechanics }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Body</th>
                                                <td>{{ $car->body }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Car finish</th>
                                                <td>{{ $car->car_finish }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Others</th>
                                                <td>{{ $car->others }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Minimum price</th>
                                                <td> CHF {{number_format($car->min_price, 0,",", "'")}}.00</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Location</th>
                                                <td>{{ $car->location }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Sale</th>
                                                <td>{{ $car->status }}</td>
                                            </tr>
                                            <tr>
                                                <th class="w-25">Approval</th>
                                                <td>{{ $car->approved ? 'Yes' : 'No' }}</td>
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
