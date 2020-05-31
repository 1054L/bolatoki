@extends('master')
@section('subtitle', $match->name . ' ' . $match->surname )

@section('content')
    <div class="container">
        <div class="bg-white p-5 shadow rounded">
            <h2>{{ $match->name }} {{ $match->surname }}</h2>
            <p class="text-secondary">
                @isset($match->birth_date)
                <i class="fas fa-birthday-cake"></i> <small>{{ $match->birth_date }}</small><br>
                @endisset
                <i class="fas fa-igloo"></i>         <span>{{ $match->club }}</span><br>
                <i class="fas fa-at"></i>            <span>{{ $match->email }}</span><br>
                <i class="fas fa-phone"></i>         <span>{{ $match->phone }}</span><br>
                <div class="d-flex justify-content-between align-items-center">
                    <a class="btn btn-primary" href="{{ route('matches.index') }}">@lang('Retourn')</a>
                    @auth
                    <div class="btn-group btn-group-sm">
                        <a class="btn btn-primary" href="{{ route('matches.edit', $match) }}">@lang('Edit')</a>
                        <a class="btn btn-danger" href="#" onclick="document.getElementById('delete-match').submit()">@lang('Delete')</a>
                    </div>
                    @endauth
                </div>
                    <form id="delete-match" method="POST" action="{{ route('matches.destroy', $match) }}" style="display: none">
                        @csrf @method("DELETE") <button>@lang('Delete')</button>
                    </form>
            </p>
        </div>
    </div>
@endsection