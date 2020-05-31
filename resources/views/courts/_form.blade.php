@csrf
@include('courts._input', ['name' => 'name', 'Name' => 'Name'])
@include('courts._input', ['name' => 'address', 'Name' => 'Address'])
@include('courts._input', ['name' => 'responsable', 'Name' => 'Responsable'])
<button class="btn btn-primary btn-lg btn-block">{{ $btnText }}</button>