@csrf
@include('matches._input', ['name' => 'name', 'Name' => 'Name'])
@include('matches._input', ['name' => 'surname', 'Name' => 'Surname'])
@include('matches._input', ['name' => 'club', 'Name' => 'Club'])
@include('matches._input', ['name' => 'email', 'Name' => 'Email'])
@include('matches._input', ['name' => 'phone', 'Name' => 'Tel'])
<button class="btn btn-primary btn-lg btn-block">{{ $btnText }}</button>