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
                    <i class="fa fa-file-invoice mr-5"></i> Invoices
                </h4>
            </div>
        </div>
        <div class="row row-eq-spacing">
	        <div class="col-12" style="padding-bottom: 20px;">
	        	<div class="custom-radio d-inline-block mr-20"> 
					  <input type="radio" name="invoicetype" checked="checked" id="radio-3" value="Outstanding">
					  <label for="radio-3" style="font-size: 16px;">Outstanding Invoices </label>
					</div>
					<div class="custom-radio d-inline-block mr-20">
					  <input type="radio" name="invoicetype" id="radio-4" value="Paid">
					  <label for="radio-4"  style="font-size: 16px;">Paid Invoices</label>
					</div>
					<div class="custom-radio d-inline-block">
					  <input type="radio" name="invoicetype" id="radio-5" value="Late">
					  <label for="radio-5"  style="font-size: 16px;">Late Invoices</label>
					</div>
	        </div>
            <div class="col-12">
                <div class="card p-15">
                    <div class="row justify-content-start justify-content-sm-between align-items-center mb-20">
                        <div class="col-12 col-lg-auto mb-lg-0 mb-10">
                            <h1 class="card-title mb-0">
                                <i class="fa fa-database mr-5"></i> All Invoices
                            </h1>
                        </div>
                    </div>
                    <div class="table-responsive" id="Outstanding">
                        <table class="table-bordered table">
                            <thead>
                                <tr>
                                    <th>ID</th>
			                        <th>Invoice</th>
			                        <th>Invoice type</th>
			                        <th>Invoice date</th>
			                        <th>Invoice deadline</th>
			                        <th>Total</th>
                                    <th class="w-25"></th>
                                </tr>
                            </thead>
                            <tbody id="Outstanding">
                                @forelse($outstanding_invoices as $seller_invoice)
		                            <tr>
		                                <td>{{ $loop->index+1  }}</td>
		                                <td style="text-align: center;">
		                                    <a href="{{'/storage/'.$seller_invoice->invoice}}" target="_blank">
		                                        <i class="fa fa-file-invoice me-2" ></i>
		                                    </a>
		                                </td>
		                                <td>{{ $seller_invoice->type }}</td>
		                                <td>{{ $seller_invoice->created_at }}</td>
		                                <td>{{ $seller_invoice->deadline }}</td>
		                                <td>CHF {{ number_format($seller_invoice->total, 0, ",", "'") }}.00</td>
		                                <td>action </td>
		                            </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="8">
                                        <i class="fa fa-frown mr-5"></i> No items found!
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="table-responsive" id="Late">
                        <table class="table-bordered table">
                            <thead>
                                <tr>
                                    <th>ID</th>
			                        <th>Invoice</th>
			                        <th>Invoice type</th>
			                        <th>Invoice date</th>
			                        <th>Invoice deadline</th>
			                        <th>Total</th>
                                    <th class="w-25"></th>
                                </tr>
                            </thead>
                            <tbody id="Outstanding">
                                @forelse($late_invoices as $seller_invoice)
		                            <tr>
		                                <td>{{ $loop->index+1  }}</td>
		                                <td style="text-align: center;">
		                                    <a href="{{'/storage/'.$seller_invoice->invoice}}" target="_blank">
                                                <i class="fa fa-file-invoice me-2" ></i>
                                            </a>
		                                </td>
		                                <td>{{ $seller_invoice->type }}</td>
		                                <td>{{ $seller_invoice->created_at }}</td>
		                                <td>{{ $seller_invoice->deadline }}</td>
		                                <td>CHF {{ number_format($seller_invoice->total, 0, ",", "'") }}.00</td>
		                                <td>action </td>
		                            </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="8">
                                        <i class="fa fa-frown mr-5"></i> No items found!
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive"  id="Paid">
                         <table class="table-bordered table">
                            <thead>
                                <tr>
                                    <th>ID</th>
			                        <th>Invoice</th>
			                        <th>Invoice type</th>
			                        <th>Invoice date</th>
			                        <th>Paid date</th>
			                        <th>Total</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse($paid_invoices as $paid_invoice)
		                            <tr>
		                                <td>{{ $loop->index+1  }}</td>
		                                <td style="text-align: center;">
		                                    <a href="{{'/storage/'.$paid_invoice->invoice}}" target="_blank">
                                                <i class="fa fa-file-invoice me-2" ></i>
                                            </a>
		                                </td>
		                                <td>{{ $paid_invoice->type }}</td>
		                                <td>{{ $paid_invoice->created_at }}</td>
		                                <td>{{ $paid_invoice->paid_date }}</td>
		                                <td>CHF {{ number_format($paid_invoice->total, 0, ",", "'") }}.00</td>
		                            </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="8">
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
    <script type="text/javascript">
    	$("#Paid").css("display","none");
    	$("#Late").css("display","none");
    	$('input[type=radio][name=invoicetype]').on('change', function() {
    		const select = this.value;
    		$("#Paid").css("display","none");
    		$("#Outstanding").css("display","none");
    		$("#Late").css("display","none");

    		$("#"+select).css("display","block");

    	})
    </script>
</div>
@endsection