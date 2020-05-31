@extends('master')
@section('subtitle')
@lang('leagues')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-10 col-lg-6">
                <div class="d-flex justify-content-between align-items-cneter">
                    <h2 class="display-4 mb-0">@lang('Leagues')</h2>
                    @auth
                        <a href="{{ route('leagues.create') }}" class="btn btn-primary my-auto"> @lang('Create a new league')</a>
                    @endauth
                </div>
                <hr>
                <ul class="list-group">
                    @forelse ($leagues as $league)
                        <li class="list-group-item border-0 mb-3 shadow-sm">
                            <a href="{{ route('leagues.show', $league) }}" class="text-secondary d-flex justify-content-between align-items-center">
                                <span class="font-weight-bold">{{ $league->name }}</span> <span>{{ $league->start_date }} - {{ $league->finish_date }}</span>
                            </a>
                        </li>
                    @empty
                        <li>@lang('There are no entries for this table')</li>
                    @endforelse
                </ul>
                {{ $leagues->links() }}
            </div>
            <div class="col-12 col-lg-6">
                <img class="img-fluid" src="/img/liga.svg" alt="bolatoki">
            </div>
        </div>
    </div>
@endsection