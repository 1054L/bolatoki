@extends('master')
@section('subtitle', $player->name . ' ' . $player->surname )

@section('content')
    <div class="container">
        <div class="bg-white p-5 shadow rounded">
            <h2>{{ $player->name }} {{ $player->surname }}</h2>
            <p class="text-secondary">
                @isset($player->birth_date)
                <i class="fas fa-birthday-cake"></i> <small>{{ $player->birth_date }}</small><br>
                @endisset
                <i class="fas fa-igloo"></i>         <span>{{ $player->club }}</span><br>
                <i class="fas fa-at"></i>            <span>{{ $player->email }}</span><br>
                <i class="fas fa-phone"></i>         <span>{{ $player->phone }}</span><br>
                <div class="d-flex justify-content-between align-items-center">
                    <a class="btn btn-primary" href="{{ route('players.index') }}">@lang('Retourn')</a>
                    @auth
                    <div class="btn-group btn-group-sm">
                        <a class="btn btn-primary" href="{{ route('players.edit', $player) }}">@lang('Edit')</a>
                        <a class="btn btn-danger" href="#" onclick="document.getElementById('delete-player').submit()">@lang('Delete')</a>
                    </div>
                    @endauth
                </div>
                    <form id="delete-player" method="POST" action="{{ route('players.destroy', $player) }}" style="display: none">
                        @csrf @method("DELETE") <button>@lang('Delete')</button>
                    </form>
            </p>
        </div>
    </div>
@endsection