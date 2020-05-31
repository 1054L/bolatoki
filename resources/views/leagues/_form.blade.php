@csrf
@include('leagues._input', ['name' => 'name', 'Name' => 'Name'])
@include('leagues._input', ['name' => 'start_date', 'Name' => 'Start date'])
@include('leagues._input', ['name' => 'finish_date', 'Name' => 'Finish date'])
<button class="btn btn-primary btn-lg btn-block">{{ $btnText }}</button>