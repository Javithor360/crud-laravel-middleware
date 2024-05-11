@extends('layouts.content')
@section('main-container')
    <div class="container mt-5">
        <h1>¡Bienvenido, {{ auth()->user()->nombre . " " . auth()->user()->apellido  }}!</h1>
        <hr />
        <p>Próximamente habrán más funciones...</p>
    </div>
@endsection