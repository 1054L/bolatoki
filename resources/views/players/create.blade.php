@extends('master')
@section('subtitle', 'nuevo player')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-10 col-lg-6 mx-auto">
                <form method="POST" action="{{ route('players.store') }}" class="bg-white shadow rounded py-3 px-4">
                    <h2>@lang('New player')</h2>
                    <hr>
                    @include('partials.validation-errors')
                    @include('players._form', ['btnText' => __('Create new player')])
                </form>
            </div>
        </div>
    </div>
@endsection