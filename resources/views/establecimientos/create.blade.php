
@extends('layouts.app')

@section('styles')
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin=""
    />

@endsection

@section('content')

    <div class="container">


        <h1 class="text-center mt-4">Registrar Establecimiento</h1>


        <div class="mt-5 row justify-content-center">


            <form
                class="col-md-9 col-xs-12 card card-body"
            >

                <fieldset
                    class="border p-4"
                >
                    <legend class="text-primary">Nombre, Categoría e Imagen Principal</legend>

                    <div class="form- group">

                        <label for="nombre">Nombre y Establecimiento</label>
                        <input
                            id="nombre"
                            type="text"
                            class="form-control @error('nombre') is-invalid @enderror"
                            placeholder="Nombre Establecimiento"
                            name="nombre"
                            value="{{ old('nombre')  }}"
                        >

                        @error('nombre')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>



                    <div class="form-group">

                        <label for="categoria">Categoría</label>

                        <select
                            class="form-control @error('categoria_id') is-invalid @enderror"
                            name="categoria_id"
                            id="categoria"
                        >
                            <option value="" selected disabled>-- Seleccione --</option>

                            @foreach ($categorias as $categoria )

                                <option
                                    value="{{ $categoria->id }}"
                                    {{ old('categoria_id' == $categoria->id ? 'selected' : '') }}
                                >{{ $categoria->nombre }}</option>

                            @endforeach
                        </select>

                    </div>





                    <div class="form-group">

                        <label for="imagen_principal">Imagen Principal</label>

                        <input
                            id="imagen_principal"
                            type="file"
                            class="form-control @error('imagen_principal') is-invalid @enderror"
                            name="imagen_principal"
                            value="{{ old('imagen_principal')  }}"
                        >

                        @error('imagen_principal')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>
                </fieldset>





                <fieldset
                    class="border p-4"
                >
                    <legend class="text-primary">Ubicación</legend>

                    <div class="form- group">

                        <label for="formbuscador">Coloca la dirección del establecimiento</label>
                        <input
                            id="formbuscador"
                            type="text"
                            placeholder="Calle del Negocio o Establecimiento"
                            class="form-control"
                        >

                        <p
                            class="text-secondary mt-5 mb-3 text-center"
                        >El asistente colocará una dirección estimada, mueve el Pin hacia el lugar correcto</p>

                    </div>


                    <div class="form-group">
                        <div id="mapa" style="height: 400px;">

                        </div>
                    </div>


                </fieldset>


            </form>
        </div>

    </div>

@endsection

@section('scripts')
    <script
        src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""
    ></script>


@endsection













