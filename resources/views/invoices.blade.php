@php
$id = 'account';
$subId = 'invoices';
@endphp

@extends('layouts.layout')

@section('title')
Invoices | Accounts
@endsection

@section('content')

<div class="container mt-5 pt-5">
    <nav class="pt-md-3 mb-3" aria-label="Breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Accounts</a></li>
            <li class="breadcrumb-item active" aria-current="page">Invoices</li>
        </ol>
    </nav>
</div>
<section class="pb-lg-3 container mt-3 mb-3 pt-3">
    <div class="row">
        @include('layouts.user_sidebar')
        <div class="col-lg-8 col-md-7">
            <h2 class="h5 mb-3">Outstanding invoices</h2>
            <div class="table-responsive">
                <table class="table-borderless table align-middle">
                    <thead class="bg-gradient">
                        <th>ID</th>
                        <th>Invoice</th>
                        <th>Invoice type</th>
                        <th>Invoice date</th>
                        <th>Invoice deadline</th>
                        <th>Total</th>
                    </thead>
                    <tbody>
                        @if (count($seller_invoices) > 0 or count($buyer_invoices) > 0)
                            @foreach($seller_invoices as $seller_invoice)
                            <tr>
                                <td>{{ $loop->index+1  }}</td>
                                <td>
                                    <a href="{{'/storage/'.$seller_invoice->invoice}}" target="_blank">
                                        <i class="fi-file me-2"></i>
                                    </a>
                                </td>
                                <td>{{ $seller_invoice->type }}</td>
                                <td>{{ $seller_invoice->created_at }}</td>
                                <td>{{ $seller_invoice->deadline }}</td>
                                <td>CHF {{ number_format($seller_invoice->total, 0, ",", "'") }}.00</td>
                            </tr>
                            @endforeach
                            @foreach($buyer_invoices as $buyer_invoice)
                            <tr>
                                <td>{{ $loop->index + 1 + count($seller_invoices) }}</td>
                                <td>

                                    <a href="{{'/storage/'.$buyer_invoice->invoice}}" target="_blank">
                                        <i class="fi-file me-2"></i>
                                    </a>
                                </td>
                                <td>{{ $buyer_invoice->type }}</td>
                                <td>{{ $buyer_invoice->created_at }}</td>
                                <td>{{ $buyer_invoice->deadline }}</td>
                                <td>CHF {{ number_format($buyer_invoice->total, 0, ",", "'") }}</td>

                            </tr>
                            @endforeach
                        @else
                        <tr>
                            <td class="text-center" colspan="6">
                                <i class="fa fa-frown mr-5"></i> No items found!
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <h2 class="h5 mt-5 mb-3">Paid invoices</h2>
            <div class="table-responsive">
                <table class="table-borderless table align-middle">
                    <thead class="bg-gradient">
                        <th>ID</th>
                        <th>Invoice</th>
                        <th>Invoice type</th>
                        <th>Invoice date</th>
                        <th>Paid date</th>
                        <th>Total</th>
                    </thead>
                    <tbody>
                        @if (count($paid_invoices) > 0)
                            @foreach($paid_invoices as $paid_invoice)
                                <tr>
                                    <td>{{ $loop->index+1}}</td>
                                    <td>
                                        <a href="{{'/storage/'.$paid_invoice->invoice}}" target="_blank">
                                            <i class="fi-file me-2"></i>
                                        </a>
                                    </td>
                                    <td>{{ $paid_invoice->type }}</td>
                                    <td>{{ $paid_invoice->created_at }}</td>
                                    <td>{{ $paid_invoice->paid_date }}</td>
                                    <td>CHF {{ number_format($paid_invoice->total, 0, ",", "'") }}.00</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="6">
                                    <i class="fa fa-frown mr-5"></i> No items found!
                                </td>
                            </tr>
                        @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
    
@endsection