@component('mail::message')

<h1>Car Published</h1>
<p>Congratulations!. Your {{$car->brand}} - {{$car->model}} car has been published.</p>



Thanks,<br>
{{ config('app.name') }}
@endcomponent
