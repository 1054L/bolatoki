@extends('master')
{{-- @section('components.container')
    <p>Página de usuarios de Bolatoki</p>
@endsection --}}
{{-- @section('content')
    <p>Contenido de users de Bolatoki</p>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <span class="nombre">{{ $name }}</span>
            <div class="title m-b-md">
                {{ $surname }}
            </div>
            <div><i class="fas fa-igloo"></i>&nbsp;{{ $address }}</div>
            <div><i class="fas fa-mobile-alt"></i>&nbsp;{{ $tel }}</div>
            @isset($mail)
                <div><i class="far fa-envelope"></i>{{ $mail }}</div>
            @endisset
        </div>
    </div>
@endsection
    @alert
        @slot('title')
            Alerta!
        @endslot
        @slot('body')
            Cuerpo de la alerta, aunque por ahora no diga nada de nada.
        @endslot
    @endalert --}}