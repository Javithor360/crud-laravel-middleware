@extends('layouts.content')
@section('main-container')
    <div class="container">
        <div class="col-md-12 mt-5">
            <div class="form-appl">
                <h3>{{ $title }}</h3>
                <hr />
                <form class="w-50" method="post" action="{{ isset($edit->id) ? route('admin.update', ['id' => $edit->id]) : route('admin.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group col-md-12 mb-3 d-flex justify-content-between">
                        <div>
                            <label for="">Nombre:</label>
                            <input class="form-control" type="text" name="nombre" placeholder="Digita el nombre..." value="{{ isset($edit->id) ? $edit->nombre : old('nombre') }}">
                            @error('nombre')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="">Apellido:</label>
                            <input class="form-control" type="text" name="apellido" placeholder="Digita el apellido..." value="{{ isset($edit->id) ? $edit->apellido : old('apellido') }}">
                            @error('apellido')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
     
                    <div class="form-group col-md-12 mb-3 d-flex justify-content-between">
                        <div>
                            <label for="">Correo electrónico:</label>
                            <input class="form-control" type="text" name="email" placeholder="Digita el correo..." value="{{ isset($edit->id) ? $edit->email : old('email') }}">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if (empty($edit->id))
                        <div>
                            <label for="">Contraseña:</label>
                            <input class="form-control" type="password" name="password" placeholder="Digita la contraseña...">
                            @error('password')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @endif
                    </div>

                    <div class="form-group col-md-12 mb-3 d-flex justify-content-between">
                        <div>
                            <label for="">Cargo:</label>
                            <select class="form-control form-select" name="cargo">
                                <option value="">Selecciona un cargo</option>
                                <option value="admin" {{ isset($edit->id) && $edit->cargo === 'admin' ? 'selected' : '' }}>Administrador</option>
                                <option value="emple" {{ isset($edit->id) && $edit->cargo === 'emple' ? 'selected' : '' }}>Empleado</option>
                            </select>
                            @error('cargo')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label for="">Salario:</label>
                            <input class="form-control" type="number" step="0.01" name="salario" placeholder="Digita el salario..." value="{{ isset($edit->id) ? $edit->salario : old('salario') }}">
                            @error('salario')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group col-md-12 mb-5">
                        <label for="">Foto de perfil</label>
                        <div class="avatar-upload">
                            <div>
                                <input type='file' id="imageUpload" name="foto" accept=".png, .jpg, .jpeg" onchange="previewImage(this)" />
                                <label for="imageUpload"></label>
                            </div>
                            <div class="avatar-preview">
                                <div id="imagePreview" style="{{ (isset($edit->id) && $edit->foto != '') ? 'background-image:url(' . url('/') . '/uploads/' . $edit->foto . ')' : 'background-image: url(' . url('/img/avatar.jpeg') . ')' }}"></div>
                            </div>
                        </div>
                        @error('foto')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
     
                    <input type="submit" class="btn btn-primary" value="Guardar">
                    <a class="btn btn-danger" href="{{ route('admin.index') }}">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script type="text/javascript">
    function previewImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#imagePreview").css('background-image', 'url(' + e.target.result + ')');
                $("#imagePreview").hide();
                $("#imagePreview").fadeIn(700);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endpush
<style>
    .avatar-upload {
        position: relative;
        max-width: 205px;
    }
 
    .avatar-upload .avatar-preview {
        width: 67%;
        height: 147px;
        position: relative;
        border-radius: 3%;
        border: 6px solid #F8F8F8;
    }
 
    .avatar-upload .avatar-preview>div {
        width: 100%;
        height: 100%;
        border-radius: 3%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
    }
</style>