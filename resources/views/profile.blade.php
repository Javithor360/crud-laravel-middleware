@extends('layouts.content')
@section('main-container')
    <div class="container mt-5">
        <h1 class="text-center">Información del perfil</h1>
        <hr />
        <div class="text-center">
            <img height="300px" width="275px" src="{{ (auth()->user()->foto != '') ? asset('uploads/' . auth()->user()->foto) : asset('img/avatar.jpeg') }}" alt="Foto de perfil">
            <p class="fs-5 fw-bold">{{ auth()->user()->nombre . " " . auth()->user()->apellido }}</p>
            <p><b>Cargo:</b> {{ auth()->user()->cargo === "admin" ? "Administrador" : "Empleado" }}</p>
            <p><b>Correo:</b> {{ auth()->user()->email }}</p>
            <p><b>Salario:</b> ${{ auth()->user()->salario }}</p>
            <p><b>Fecha de creación:</b> {{ auth()->user()->created_at->format('d-m-Y') }}</p>
    </div>
@endsection