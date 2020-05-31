@extends('master')
@section('subtitle')
@lang('players')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="d-flex justify-content-between align-items-cneter">
                    <h2 class="display-4 mb-0">@lang('Players')</h2>
                    @auth
                        <a href="{{ route('players.create') }}" class="btn btn-primary my-auto"> @lang('Create a new player')</a>
                    @endauth
                </div>
                <hr>
                <ul class="list-group">
                    @forelse ($players as $player)
                        <li class="list-group-item border-0 mb-3 shadow-sm">
                            <a href="{{ route('players.show', $player) }}" class="text-secondary d-flex justify-content-between align-items-center">
                                <span class="font-weight-bold">{{ $player->name }} {{ $player->surname }}</span> 
                                <span class="text-black-50">( {{ $player->club }} )</span>
                            </a>
                        </li>
                    @empty
                        <li>@lang('There are no entries for this table')</li>
                    @endforelse
                </ul>
                {{ $players->links() }}
            </div>
            <div class="col-12 col-lg-6">
                <img class="img-fluid" src="/img/bolari.svg" alt="bolariak">
            </div>
        </div>
    </div>
@endsection