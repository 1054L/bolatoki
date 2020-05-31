@extends('master')
@section('subtitle', 'nuevo player')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-10 col-lg-6 mx-auto">
                <form method="POST" action="{{ route('players.update', $player) }}" class="bg-white shadow rounded py-3 px-4">
                    <h2>@lang('Edit player') {{ $player->name }}</h2>
                    <hr>
                    @include('partials.validation-errors')
                    @method('PATCH')
                    @include('players._form', ['btnText' => __('Edit player')])
                </form>
            </div>
        </div>
    </div>
@endsection