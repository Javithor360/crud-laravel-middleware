@extends('layouts.content')
@section('main-container')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Bienvenido</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('login') }}" method="post" autocomplete="off">
                        @csrf

                        @if (session('status'))
                            <div class="alert alert-danger">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control @error('email') border border-danger @enderror" value="floresmejia004@gmail.com" id="email" name="email" placeholder="Ingrese su usuario" autocomplete="off">
                            @error('email')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Contraseña</label>
                            <input type="password" class="form-control @error('password') border border-danger @enderror" value="1234" id="password" name="password" placeholder="Ingrese su contraseña" autocomplete="off">
                            @error('password')
                                <div class="alert alert-danger mt-2 fs">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <input type="submit" value="Iniciar sesión" class="btn btn-primary btn-block mt-3" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection