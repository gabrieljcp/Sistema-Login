<!-- <h1>Perfil do Usuário</h1>
<p>Nome: {{ Auth::user()->name }}</p>
<p>Email: {{ Auth::user()->email }}</p> -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>{{ __('Perfil do usuário') }}</strong></div>

                <div class="card-body">
                    
                        <div>
                            <p><strong>Nome: </strong> {{ Auth::user()->name }}</p>
                            <p><strong>Email: </strong>{{ Auth::user()->email }}</p>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

