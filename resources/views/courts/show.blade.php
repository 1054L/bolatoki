@extends('master')
@section('subtitle', $court->name)

@section('content')
    <div class="container">
        <div class="bg-white p-5 shadow rounded">
            <h2>{{ $court->name }}</h2>
            <p class="text-secondary">
                <i class="fas fa-map-pin"></i> <span> {{ $court->address }}</span><br>
                <div class="d-flex justify-content-between align-items-center">
                    <a class="btn btn-primary" href="{{ route('courts.index') }}">@lang('Retourn')</a>
                    @auth
                    <div class="btn-group btn-group-sm">
                        <a class="btn btn-primary" href="{{ route('courts.edit', $court) }}">@lang('Edit')</a>
                        <a class="btn btn-danger" href="#" onclick="document.getElementById('delete-court').submit()">@lang('Delete')</a>
                    </div>
                    @endauth
                </div>
                    <form id="delete-court" method="POST" action="{{ route('courts.destroy', $court) }}" style="display: none">
                        @csrf @method("DELETE") <button>@lang('Delete')</button>
                    </form>
            </p>
        </div>
    </div>
@endsection