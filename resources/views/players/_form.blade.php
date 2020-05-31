@csrf
@include('players._input', ['name' => 'name', 'Name' => 'Name'])
@include('players._input', ['name' => 'surname', 'Name' => 'Surname'])
@include('players._input', ['name' => 'club', 'Name' => 'Club'])
@include('players._input', ['name' => 'email', 'Name' => 'Email'])
@include('players._input', ['name' => 'phone', 'Name' => 'Tel'])
<button class="btn btn-primary btn-lg btn-block">{{ $btnText }}</button>