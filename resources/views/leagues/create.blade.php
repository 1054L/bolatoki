@extends('master')
@section('subtitle', 'nuevo league')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-10 col-lg-6 mx-auto">
                <form method="POST" action="{{ route('leagues.store') }}" class="bg-white shadow rounded py-3 px-4">
                    <h2>@lang('New league')</h2>
                    <hr>
                    @include('partials.validation-errors')
                    @include('leagues._form', ['btnText' => __('Create new league')])
                </form>
            </div>
        </div>
    </div>
@endsection