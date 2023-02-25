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
                        @forelse($seller_invoices as $seller_invoice)
                        <tr>
                            <td>{{ $seller_invoice->id }}</td>
                            <td>
                                <a href="{{asset('storage/pdf/'.$seller_invoice->invoice)}}" target="_blank">
                                    <i class="fi-file me-2"></i>
                                </a>
                            </td>
                            <td>Test type</td>
                            <td>{{ $seller_invoice->created_at }}</td>
                            <td>{{ $seller_invoice->created_at }}</td>
                            <td>CHF {{ number_format($seller_invoice->total, 0, ",", "'") }}.00</td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="6">
                                <i class="fa fa-frown mr-5"></i> No items found!
                            </td>
                        </tr>
                        @endforelse
                        @forelse($buyer_invoices as $buyer_invoice)
                        <tr>
                            <td>{{ $buyer_invoice->id }}</td>
                            <td>
                                <a href="{{asset('storage/pdf/'.$buyer_invoice->invoice)}}" target="_blank">
                                    <i class="fi-file me-2"></i>
                                </a>
                            </td>
                            <td>Test type</td>
                            <td>{{ $buyer_invoice->created_at }}</td>
                            <td>{{ $buyer_invoice->created_at }}</td>
                            <td>CHF {{ number_format($buyer_invoice->total, 0, ",", "'") }}</td>

                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="6">
                                <i class="fa fa-frown mr-5"></i> No items found!
                            </td>
                        </tr>
                        @endforelse
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
                        <th>Invoice deadline</th>
                        <th>Total</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center" colspan="6">
                                <i class="fa fa-frown mr-5"></i> No items found!
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection