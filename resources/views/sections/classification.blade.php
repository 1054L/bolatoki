@extends('master')
@section('subtitle')
@lang('classification')
@endsection
@section('content')
    <h2>@lang('Actual league classification')</h2>
    <table class="classificationTable">
        {{-- <tr><th>@lang('#')</th><th>@lang('Player')</th><th>@lang('Points')</th><th>@lang('Spins')</th><th>@lang('Actions')</th></tr>
        @foreach ($classificationPlayer as $player)
            <tr>
                <td>{{ $player['position'] }}</td>
                <td>{{ $player['name'] }}</td>
                <td>{{ $player['points'] }}</td>
                <td>@foreach ($player['spins'] as $spin)
                     | {{ $spin }} @endforeach
                </td>
                <td>
                    <a href="/bolariak/{{$player['name']}}" class="actionLink"><i class="far fa-eye"></i></a>
                </td>
            </tr> --}}
        {{-- @endforeach --}}
    </table>
@endsection