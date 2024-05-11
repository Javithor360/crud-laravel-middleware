@extends('layouts.content')
@section('main-container')
    <div class="container mt-5">
        <h2>DSS - Desafío III</h2>
        <hr />
        <div class="text-end my-3">
            <a href="{{ route('admin.create') }}" class="btn btn-success">Nuevo usuario</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover table-striped text-center align-middle">
                <thead class="table-primary">
                    <th>#</th>
                    <th>Foto</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Cargo</th>
                    <th>Salario</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    @forelse ($users as $index => $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>
                                <div class="showPhoto">
                                    <div id="imagePreview"
                                        style="@if ($row->foto != '') background-image:url('{{ url('/') }}/uploads/{{ $row->foto }}')@else background-image: url('{{ url('/img/avatar.jpeg') }}') @endif;">
                                    </div>
                                </div>
                            </td>
                            <td>{{ $row->nombre }} {{ $row->apellido }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->cargo === "admin" ? "Administrador" : "Empleado" }}</td>
                            <td>$ {{ $row->salario }}</td>
                            <td>
                                <a href={{ route('admin.edit', ['id' => $row->id]) }} class="btn btn-primary" {{ auth()->user()->id === $row->id ? 'hidden' : '' }}>Editar</a>
                                <button class="btn btn-danger" onclick="deleteUser('{{ $row->id }}')" {{ auth()->user()->id === $row->id ? 'disabled' : '' }}>Eliminar</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No hay registros</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@include('admin.modal_delete')
@endsection

@push('js')
    <script>
        function deleteUser(id) {
            document.getElementById('delete_id').value = id;
            $('#modalDelete').modal('show');
        }
    </script>
@endpush

<style>
    .showPhoto {
        width: 75px;
        height: 90px;
        margin: auto;
    }
 
    .showPhoto>div {
        width: 100%;
        height: 100%;
        border-radius: 10%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
</style>