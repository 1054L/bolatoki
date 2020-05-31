@extends('master')
@section('subtitle', 'nuevo court')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-10 col-lg-6 mx-auto">
                <form method="POST" action="{{ route('courts.store') }}" class="bg-white shadow rounded py-3 px-4">
                    <h2>@lang('New court')</h2>
                    <hr>
                    @include('partials.validation-errors')
                    @include('courts._form', ['btnText' => __('Create new court')])
                </form>
            </div>
        </div>
    </div>
@endsection