@extends('master')
@section('subtitle', $league->name)

@section('content')
    <div class="container">
        <div class="bg-white p-5 shadow rounded">
            <h2>{{ $league->name }}</h2>
            <p class="text-secondary">
                @isset($league->start_date)
                <i class="fas fa-birthday-cake"></i> <small>{{ $league->start_date }} - {{ $league->finish_date }}</small><br>
                @endisset
                {{-- @forelse ($league->matches as $item)
                    {{ $item->name }}
                @empty
                    @lang('There are no matched for this league')
                @endforelse --}}
                <div class="d-flex justify-content-between align-items-center">
                    <a class="btn btn-primary" href="{{ route('leagues.index') }}">@lang('Retourn')</a>
                    @auth
                    <div class="btn-group btn-group-sm">
                        <a class="btn btn-primary" href="{{ route('leagues.edit', $league) }}">@lang('Edit')</a>
                        <a class="btn btn-danger" href="#" onclick="document.getElementById('delete-league').submit()">@lang('Delete')</a>
                    </div>
                    @endauth
                </div>
                    <form id="delete-league" method="POST" action="{{ route('leagues.destroy', $league) }}" style="display: none">
                        @csrf @method("DELETE") <button>@lang('Delete')</button>
                    </form>
            </p>
        </div>
    </div>
@endsection