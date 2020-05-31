@extends('master')
@section('subtitle')
@lang('matches')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-10 col-lg-6">
                <div class="d-flex justify-content-between align-items-cneter">
                    <h2 class="display-4 mb-0">@lang('matches')</h2>
                    @auth
                        <a href="{{ route('matches.create') }}" class="btn btn-primary my-auto"> @lang('Create a new match')</a>
                    @endauth
                </div>
                <hr>
                <ul class="list-group">
                    @forelse ($matches as $match)
                        <li class="list-group-item border-0 mb-3 shadow-sm">
                            <a href="{{ route('matches.show', $match) }}" class="text-secondary d-flex justify-content-between align-items-center">
                                <span class="font-weight-bold">{{ $match->name }} {{ $match->surname }}</span> 
                                <span class="text-black-50">( {{ $match->club }} )</span>
                            </a>
                        </li>
                    @empty
                        <li>@lang('There are no entries for this table')</li>
                    @endforelse
                </ul>
                {{ $matches->links() }}
            </div>
        </div>
    </div>
@endsection