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
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <img class="img-fluid" src="/img/classification.svg" alt="bolatoki">
        </div>
    </div>
</div>
@endsection
