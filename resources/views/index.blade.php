@extends('master')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">@lang('Classification')</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @lang('Classification')
                    <hr>
                    <ul class="list-group">
                        @forelse ($classifications as $classification)
                            <li class="list-group-item border-0 mb-3 shadow-sm">
                                <span class="font-weight-bold">{{ $classification->player_id }} ({{ $classification->result }})</span>
                            </li>
                        @empty
                            <li>@lang('There are no entries for this table')</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <img class="img-fluid" src="/img/classification.svg" alt="bolatoki">
        </div>
    </div>
</div>
@endsection
