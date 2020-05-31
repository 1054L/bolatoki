@extends('master')
@section('subtitle')
@lang('league')
@endsection
@section('content')
    <h2>{{ $leagueName }}</h2>
    <table class="classificationTable">
        <tr><th>@lang('Date')</th><th>@lang('Court')</th><th>@lang('Winner')</th><th>@lang('Actions')</th></tr>
        @foreach ($matches as $match)
            <tr>
                <td>{{ $match['date'] }}</td>
                <td>{{ $match['court'] }}</a></td>
                <td>{{ $match['winner'] }}</a></td>
                <td>
                    <a herf="/bolatokiak/{{ $match['court'] }}" class="actionLink"><i class="fas fa-map-marker-alt"></i></a>
                    <a href="/bolariak/{{ $match['winner'] }}" class="actionLink"><i class="far fa-eye"></i></a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection