@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('HOLA ') }}{{ strtoupper(Auth::user()->name) }}{{ __('') }} {{ strtoupper (Auth::user()->apellido) }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Estas Conectado/a!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
