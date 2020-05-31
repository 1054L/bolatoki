@extends('master')
@section('subtitle', 'nuevo match')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-10 col-lg-6 mx-auto">
                <form method="POST" action="{{ route('matches.store') }}" class="bg-white shadow rounded py-3 px-4">
                    <h2>@lang('New match')</h2>
                    <hr>
                    @include('partials.validation-errors')
                    @include('matches._form', ['btnText' => __('Create new match')])
                </form>
            </div>
        </div>
    </div>
@endsection