@extends('master')
@section('subtitle')
@lang('courts')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="d-flex justify-content-between align-items-cneter">
                    <h2 class="display-4 mb-0">@lang('Courts')</h2>
                    @auth
                        <a href="{{ route('courts.create') }}" class="btn btn-primary my-auto"> @lang('Create a new court')</a>
                    @endauth
                </div>
                <hr>
                <ul class="list-group">
                    @forelse ($courts as $court)
                        <li class="list-group-item border-0 mb-3 shadow-sm">
                            <a href="{{ route('courts.show', $court) }}" class="text-secondary d-flex justify-content-between align-items-center">
                                <span class="font-weight-bold">{{ $court->name }} </span> 
                            </a>
                        </li>
                    @empty
                        <li>@lang('There are no entries for this table')</li>
                    @endforelse
                </ul>
                {{ $courts->links() }}
            </div>
            <div class="col-12 col-lg-6">
                <img class="img-fluid" src="/img/bolatoki.svg" alt="bolatokiak">
            </div>
        </div>
    </div>
@endsection