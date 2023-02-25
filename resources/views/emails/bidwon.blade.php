@component('mail::message')
# Introduction

{{$data['message']}}


@component('mail::table')
| Key                      | Value                         |
| :----------------------- | ----------------------------: |
| **Car brand**            | {{ $data['brand'] }}          |
| **Car model**            | {{ $data['model'] }}          |
| **Bidding amount**       | {{ $data['bidding_amount'] }} |
| **Service charges**      | {{ $data['service_charges'] }}|
| **Total**                | {{ $data['total'] }}          |
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent
