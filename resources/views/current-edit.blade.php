@php $id = 'edit-your-car'; @endphp

@extends('layouts.layout')

@section('title')
Edit Vehicle
@endsection

@section('content')
<div class="container mt-5 pt-5">
    <nav class="pt-md-3 mb-3" aria-label="Breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit vehicle</li>
        </ol>
    </nav>
</div>
@if (session()->has('car_updated'))
<div class="container my-3">
    <div class="alert alert-success">
        {{ session()->get('car_updated') }}
    </div>
</div>
@endif
<div class="container mt-2 mb-3">  
    @if (session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
    @endif
</div>
<section class="pb-lg-3 container mt-3 mb-3 pt-3">
    <div class="row">
        <form action="/accounts/current-vehicle/{{ $car->slug }}/update" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="col-12">
                <div class="mb-4">
                    <h1 class="h2 mb-0">Edit your car</h1>
                </div>
                <section class="card card-body mb-4 p-4 shadow-sm">
                    <h2 class="h4 mb-4"><i class="fi-info-circle text-primary fs-5 mt-n1 me-2"></i>Car</h2>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="brand">Brand <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input class="form-control" type="text" id="brand" name="brand" value="{{ $car->brand }}" maxlength="255" required>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="model">Model <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input class="form-control" value="{{ $car->model }}" type="text" id="model" name="model" maxlength="255" required>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="type">Type</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input class="form-control" type="text" value="{{ $car->type }}" id="type" name="type" maxlength="255">
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="body-type">Body type <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <select class="form-select" id="body-type" name="body_type" required>

                                        <option value="{{ $car->body_type }}" selected>{{ $car->body_type }}</option>
                                        <option value="Limousine">Limousine</option>
                                        <option value="Estate Care">Estate Car</option>
                                        <option value="Convertible">Convertible</option>
                                        <option value="Coupe">Coupe</option>
                                        <option value="Hatchback">Hatchback</option>
                                        <option value="SUV/Offroader">SUV/Offroader</option>
                                        <option value="Van">Van</option>
                                        <option value="Roadster">Roadster</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="doors">Doors <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <select class="form-select" id="doors" name="doors" required>
                                        <option value="{{ $car->doors }}" selected>{{ $car->doors }}</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="first-registration">First registration <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="input-group">
                                        <input class="form-control date-picker pe-5 rounded" value="{{ $car->first_registration }}" type="text" id="first-registration" name="first_registration" data-datepicker-options='{
                                                            "altInput": true,
                                                            "altFormat": "F j, Y",
                                                            "dateFormat": "Y-m-d"
                                                        }' required>
                                        <i class="fi-calendar position-absolute top-50 end-0 translate-middle-y me-3"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="milage">Milage <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input class="form-control" type="number" value="{{ $car->milage }}" id="milage" name="milage" required>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="exterior-color">Exterior color <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <select class="form-select" id="exterior-color" name="exterior_color" required>
                                        <option value="{{ $car->exterior_color }}" selected>{{ $car->exterior_color }}</option>
                                        <option value="Anthracite">Anthracite</option>
                                        <option value="Beige">Beige</option>
                                        <option value="Blue">Blue</option>
                                        <option value="Bordeaux">Bordeaux</option>
                                        <option value="Brown">Brown</option>
                                        <option value="Yellow">Yellow</option>
                                        <option value="Gold">Gold</option>
                                        <option value="Grey">Grey</option>
                                        <option value="Green">Green</option>
                                        <option value="Orange">Orange</option>
                                        <option value="Pink">Pink</option>
                                        <option value="Red">Red</option>
                                        <option value="Black">Black</option>
                                        <option value="Silver">Silver</option>
                                        <option value="Turquoise">Turquoise</option>
                                        <option value="Violet">Violet</option>
                                        <option value="White">White</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="exterior_finish">Exterior finish</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <select class="form-select" id="exterior-finish" name="exterior_finish">
                                        <option value="{{ $car->exterior_finish }}" selected>{{ $car->exterior_finish }}</option>
                                        <option value="Solid Paint">Solid Paint</option>
                                        <option value="Metallic">Metallic</option>
                                        <option value="Bubble Effect">Bubble Effect</option>
                                        <option value="Matt Paint">Matt Paint</option>
                                        <option value="Individual Paint">Individual Paint</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="interior-color">Interior color <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <select class="form-select" id="interior-color" name="interior_color" required>
                                        <option value="{{ $car->interior_color }}" selected>{{ $car->interior_color }}</option>
                                        <option value="Anthracite">Anthracite</option>
                                        <option value="Beige">Beige</option>
                                        <option value="Blue">Blue</option>
                                        <option value="Bordeaux">Bordeaux</option>
                                        <option value="Brown">Brown</option>
                                        <option value="Yellow">Yellow</option>
                                        <option value="Gold">Gold</option>
                                        <option value="Grey">Grey</option>
                                        <option value="Green">Green</option>
                                        <option value="Orange">Orange</option>
                                        <option value="Pink">Pink</option>
                                        <option value="Red">Red</option>
                                        <option value="Black">Black</option>
                                        <option value="Silver">Silver</option>
                                        <option value="Turquoise">Turquoise</option>
                                        <option value="Violet">Violet</option>
                                        <option value="White">White</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="interior-finish">Interior finish <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <select class="form-select" id="interior-finish" name="interior_finish" required>
                                        <option value="{{ $car->interior_finish }}" selected>{{ $car->interior_finish }}</option>
                                        <option value="Full Leather">Full Leather</option>
                                        <option value="Cloth">Cloth</option>
                                        <option value="Alcantara">Alcantara</option>
                                        <option value="Alcantara/Leather">Alcantara/Leather</option>
                                        <option value="Cloth/Leather">Cloth/Leather</option>
                                        <option value="Cloth/Alcantara">Cloth/Alcantara</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="special_equipments">Special equipments</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <textarea class="form-control" id="special-equipments" name="special_equipments" rows="5">{{ $car->special_equipments }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-md-0 mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label">Serial equipments</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <textarea class="form-control" id="serial-equipments" name="serial_equipments" rows="5">{{ $car->serial_equipments }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="wheel-drive">Wheel drive <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <select class="form-select" id="wheel-drive" name="wheel_drive" required>
                                        <option value="{{ $car->wheel_drive }}" selected>{{ $car->wheel_drive }}</option>
                                        <option value="4x4">4x4</option>
                                        <option value="Front">Front</option>
                                        <option value="Rear">Rear</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="gear">Gear <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <select class="form-select" id="gear" name="gear" required>
                                        <option value="{{ $car->gear }}" selected>{{ $car->gear }}</option>
                                        <option value="Automatic">Automatic</option>
                                        <option value="Manual">Manual</option>
                                        <option value="Semi-Automatic">Semi-Automatic</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="fuel">Fuel <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <select class="form-select" id="fuel" name="fuel" required>
                                        <option value="{{ $car->fuel }}" selected>{{ $car->fuel }}</option>
                                        <option value="Petrol">Petrol</option>
                                        <option value="Diesel">Diesel</option>
                                        <option value="Electrical">Electrical</option>
                                        <option value="Gas (CNG)">Gas (CNG)</option>
                                        <option value="Hybrid">Hybrid</option>
                                        <option value="Gas (LPG)">Gas (LPG)</option>
                                        <option value="Hybrid (Petrol)">Hybrid (Petrol)</option>
                                        <option value="Hybrid (Diesel)">Hybrid (Diesel)</option>
                                        <option value="Hydrogen">Hydrogen</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="displacement">Displacement <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="input-group">
                                        <input class="form-control" type="number" value="{{ $car->displacement }}" id="displacement" name="displacement" step="0.1" required>
                                        <span class="input-group-text bg-primary text-light">Litre(s)</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="performance-hp">Performance <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="input-group">
                                        <input class="form-control" type="number" id="performance-hp" name="performance_hp" value="{{ $car->performance_hp }}" step="0.1" required>
                                        <span class="input-group-text bg-primary text-light">HP</span>
                                        <input class="form-control" type="number" id="performance-kw" name="performance_kw" value="{{ $car->performance_kw }}" step="0.1" required>
                                        <span class="input-group-text bg-primary text-light">kW</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="seats">Seats</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <select class="form-select" id="seats" name="seats">
                                        <option value="{{ $car->seats }}" selected>{{ $car->seats }}</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="frame-number">Frame number</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input class="form-control" type="text" value="{{ $car->frame_number }}" id="frame-number" name="frame_number" maxlength="255">
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="model-number">Model number</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input class="form-control" type="text" value="{{ $car->model_number }}" id="model-number" name="model_number" maxlength="255">
                                </div>
                            </div>
                            <div class="row justify-content-end mb-3">
                                <div class="col-12 col-md-8">
                                    <div class="form-check d-flex align-items-center h-44-4 mb-0">
                                        <input class="form-check-input me-2" id="direct-import" name="direct_import" type="checkbox" value="true" {{ "$car->direct_import==='true'" ? 'checked' : '' }}>
                                        <label class="form-check-label" for="direct-import">Direct import</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="register-number">Register number</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input class="form-control" type="text" value="{{ $car->register_number }}" id="register-number" name="register_number" maxlength="255">
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="vehicle-number">Vehicle number</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input class="form-control" type="text" id="vehicle-number" value="{{ $car->vehicle_number }}" name="vehicle_number" maxlength="255">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="additional-information">Additional information</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <textarea class="form-control" id="additional-information" name="additional_info" rows="5">{{ $car->additional_info }}</textarea>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="factory-price">Factory price</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input class="form-control" type="number" value="{{ $car->factory_price }}" id="factory-price" name="factory_price" step="0.01">
                                </div>
                            </div>
                            <div class="row justify-content-end">
                                <div class="col-12 col-md-8">
                                    <div class="form-check d-flex align-items-center h-44-4 mb-0">
                                        <input class="form-check-input me-2" id="publish-factory-price" name="publish" type="checkbox" {{ "$car->direct_import==='true'" ? 'checked' : '' }} value="true">
                                        <label class="form-check-label" for="publish-factory-price">Publish in auction</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="card card-body mb-4 p-4 shadow-sm">
                    <h2 class="h4 mb-4"><i class="fi-dashboard text-primary fs-5 mt-n1 me-2"></i>Condition</h2>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="row mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label">General conditions</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="form-check">
                                        <input class="form-check-input" id="involved-in-accidents" name="general_conditions[]" type="checkbox" value="Involved in Accidents" @if (isset($car->general_conditions)) @foreach ($car->general_conditions as $g) @if ($g === 'Involved in Accidents') checked @endif @endforeach @endif
                                        >
                                        <label class="form-check-label" for="involved-in-accidents">Involved in accidents</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="dog-owner" name="general_conditions[]" type="checkbox" value="Dog Owner" @if (isset($car->general_conditions)) @foreach ($car->general_conditions as $g) @if ($g === 'Dog Owner') checked @endif @endforeach @endif
                                        >
                                        <label class="form-check-label" for="dog-owner">Dog owner</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="smoker-s-vehicle" name="general_conditions[]" type="checkbox" value="Smoker's Vehicle" @if (isset($car->general_conditions)) @foreach ($car->general_conditions as $g) @if ($g === "Smoker's Vehicle") checked @endif @endforeach @endif

                                        >
                                        <label class="form-check-label" for="smoker-s-vehicle">Smoker's vehicle</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="hail-damage" name="general_conditions[]" type="checkbox" value="Hail Damage" @if (isset($car->general_conditions)) @foreach ($car->general_conditions as $g) @if ($g === 'Hail Damage') checked @endif @endforeach @endif

                                        >
                                        <label class="form-check-label" for="hail-damage">Hail damage</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="inspection">Inspection</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="input-group">
                                        <input class="form-control date-picker pe-5 rounded" type="text" value="{{ $car->inspection }}" id="inspection" name="inspection" data-datepicker-options='{
                                                            "altInput": true,
                                                            "altFormat": "F j, Y",
                                                            "dateFormat": "Y-m-d"
                                                        }'>
                                        <i class="fi-calendar position-absolute top-50 end-0 translate-middle-y me-3"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="repairs">Repairs <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input class="form-control" type="number" id="repairs" value="{{ $car->repairs }}" name="repairs" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="row mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label">Registration document <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="form-check">
                                        <input class="form-check-input" id="registration-document-available" type="radio" name="registration_document" value="Available" {{ "$car->registration_document ==='Available'" ? 'checked' : '' }}>
                                        <label class="form-check-label" for="registration-document-available">Available</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="registration-document-supply-later" type="radio" name="registration_document" value="Supply Later" {{ "$car->registration_document ==='Supply Later'" ? 'checked' : '' }}>
                                        <label class="form-check-label" for="registration-document-supply-later">Supply later</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label">Service record booklet <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="form-check">
                                        <input class="form-check-input" id="service-record-booklet-available" type="radio" name="service_record_booklet" value="Available" {{ "$car->service_record_booklet ==='Available'" ? 'checked' : '' }}>
                                        <label class="form-check-label" for="service-record-booklet-available">Available</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="service-record-booklet-incomplete" type="radio" name="service_record_booklet" value="Incomplete" {{ "$car->service_record_booklet ==='Incomplete'" ? 'checked' : '' }}>
                                        <label class="form-check-label" for="service-record-booklet-incomplete">Incomplete</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="service-record-booklet-missing" type="radio" name="service_record_booklet" value="Missing" {{ "$car->service_record_booklet ==='Missing'" ? 'checked' : '' }}>
                                        <label class="form-check-label" for="service-record-booklet-missing">Missing</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label">Service record digital <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <div class="form-check">
                                        <input class="form-check-input" id="service-record-digital-available" type="radio" name="service_record_digital" value="Available" {{ "$car->service_record_digital ==='Available'" ? 'checked' : '' }}>
                                        <label class="form-check-label" for="service-record-digital-available">Available</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="service-record-digital-incomplete" type="radio" name="service_record_digital" value="Incomplete" {{ "$car->service_record_digital ==='Incomplete'" ? 'checked' : '' }}>
                                        <label class="form-check-label" for="service-record-digital-incomplete">Incomplete</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" id="service-record-digital-missing" type="radio" name="service_record_digital" value="Missing" {{ "$car->service_record_digital ==='Missing'" ? 'checked' : '' }}>
                                        <label class="form-check-label" for="service-record-digital-missing">Missing</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="keys">Keys <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <select class="form-select" id="keys" name="keys" required>
                                        <option value="{{ $car->keys }}" selected>{{ $car->keys }}</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="row mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="mechanics">Mechanics</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <textarea class="form-control" id="mechanics" name="mechanics" rows="5">{{ $car->mechanics }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-md-0 mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="car-finish">Car finish</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <textarea class="form-control" id="car-finish" name="car_finish" rows="5">{{ $car->car_finish }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="row mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="body">Body</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <textarea class="form-control" id="body" name="body" rows="5">{{ $car->body }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="other">Other</label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <textarea class="form-control" id="other" name="others" rows="5">{{ $car->body }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="card card-body mb-4 p-4 shadow-sm">
                    <h2 class="h4 mb-4"><i class="fi-image text-primary fs-5 mt-n1 me-2"></i>Documents and images</h2>
                    <div class="row mb-3">
                        <div class="col-12">
                            <label class="form-label" for="documents">Documents of vehicle</label>
                            <div class="alert alert-secondary mb-4" role="alert">
                                <div class="d-flex">
                                    <i class="fi-alert-circle me-2 me-sm-3"></i>
                                    <p class="fs-sm mb-0">
                                        You can upload vehicle documents, such as expert reports. <br>
                                        Maximum file size is 18MB. <br>
                                        Allowed formates are doc, docx, and pdf.
                                    </p>
                                </div>
                            </div>
                            <input class="file-uploader file-uploader-grid border" type="file" id="documents" name="documents[]" data-max-file-size="10MB" accept="application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/pdf" data-label-idle='
                                                <div class="btn btn-accent bg-gradient mb-3 border-0"><i class="fi-cloud-upload me-1"></i>Upload documents</div>
                                                <div class="opacity-70">or drag them in</div>
                                            ' multiple>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label" for="images">Images of vehicle</label>
                            <div class="alert alert-secondary mb-4" role="alert">
                                <div class="d-flex">
                                    <i class="fi-alert-circle me-2 me-sm-3"></i>
                                    <p class="fs-sm mb-0">
                                        You can upload a maximum of 20 vehicle images. <br>
                                        Maximum image size is 5MB. <br>
                                        Minimum image resolution is 760x478px. <br>
                                        Allowed formates are jpg, jpeg, png and webp. <br>
                                        Only images in landscape orientation are allowed.
                                    </p>
                                </div>
                            </div>
                            <input class="file-uploader file-uploader-grid border" type="file" id="images" name="images[]" data-max-file-size="10MB" accept="image/jpg, image/jpeg, image/png, image/webp" data-label-idle='
                                                <div class="btn btn-accent bg-gradient mb-3 border-0"><i class="fi-cloud-upload me-1"></i>Upload images</div>
                                                <div class="opacity-70">or drag them in</div>
                                            ' multiple>
                        </div>
                    </div>
                    @section('scripts')
                    <script>
                        const inputElement = document.querySelector('input[id="images"]');
                        const pond = FilePond.create(inputElement);
                        const inputElement2 = document.querySelector('input[id="documents"]');
                        const pond2 = FilePond.create(inputElement2);

                        FilePond.setOptions({
                            server: {
                                url: '/upload',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                }
                            }
                        });
                    </script>
                    @endsection
                </section>
                <section class="card card-light card-body mb-4 border-0 p-4 shadow-sm">
                    <h2 class="h4 mb-4"><i class="fi-check-circle text-primary fs-5 mt-n1 me-2"></i>Auction</h2>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="row align-items-center mb-md-0 mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="min_price">Minimum price <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <input class="form-control" type="number" value="{{ $car->min_price }}" id="minimum-price" name="min_price" step="0.01" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="location">Location <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <select class="form-select" id="location" name="location" required>
                                        <option>Please select</option>
                                        <option value="Switzerland" selected>Switzerland</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        @if(!isAuctionActive())
                        <div class="col-12 col-md-6">
                            <div class="row align-items-center mb-3">
                                <div class="col-12 col-md-4">
                                    <label class="form-label" for="auction">Auction <span class="text-danger">*</span></label>
                                </div>
                                <div class="col-12 col-md-8">
                                    <select class="form-select" id="auction" name="auction">
                                        <option selected disabled>Please select auction</option>
                                        @forelse($auctions as $auction)
                                        <option value="{{ $auction->id }}" @if($car->auction == $auction->id) selected @endif >{{ $auction->start_date }} - {{$auction->end_date}}</option>
                                        @empty
                                        <option value="" disabled >No auctions available</option>
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif


                    </div>
                </section>
                <div class="d-sm-flex justify-content-between pt-2">
                    <a class="btn btn-secondary btn-lg d-block ps-3 mb-sm-2 mb-3" href="#">
                        <i class="fi-archive me-2"></i>Save as incomplete
                    </a>
                    <button class="btn btn-accent bg-gradient btn-lg d-block mb-2 border-0" href="#">
                        <i class="fi-check me-2"></i>Publish
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection