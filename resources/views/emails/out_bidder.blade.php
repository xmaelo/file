@component('mail::message')
# Introduction

{{$data['message']}}

@component('mail::table')
| Key                      | Value                         |
| :----------------------- | ----------------------------: |
| **Car brand**            | {{ $data['brand'] }}          |
| **Car model**            | {{ $data['model'] }}          |
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
