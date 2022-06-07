
@extends('layouts.app')

@section('styles')

    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.8.0/dist/leaflet.css"
        integrity="sha512-hoalWLoI8r4UszCkZ5kL8vayOGVae1oxXe/2A4AO6J9+580uKHDO3JdHb7NzwwzK5xr/Fs0W40kiNHxM9vyTtQ=="
        crossorigin=""
    />


    <link
      rel="stylesheet"
      href="https://unpkg.com/esri-leaflet-geocoder/dist/esri-leaflet-geocoder.css"
    />

    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.css"
    />

    {{-- <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.min.css"
        integrity="sha512-0ns35ZLjozd6e3fJtuze7XJCQXMWmb4kPRbb+H/hacbqu6XfIX0ZRGt6SrmNmv5btrBpbzfdISSd8BAsXJ4t1Q=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    /> --}}

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css"
        integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />


@endsection

@section('content')

    <div class="container">


        <h1 class="text-center mt-4">Registrar Establecimiento</h1>


        <div class="mt-5 row justify-content-center">


            <form
                class="col-md-9 col-xs-12 card card-body"
                action="{{ route('establecimiento.store') }}"
                method="POST"
                enctype="multipart/form-data"

            >
                @csrf

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

                        @error('categoria_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

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
                    class="border p-4 mt-5"
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
                        >El asistente colocará una dirección estimada o mueve el Pin hacia el lugar correcto</p>

                    </div>





                    <div class="form-group">
                        <div id="mapa" style="height: 400px;">

                        </div>
                    </div>



                    <p class="informacion">Confirma que los siguientes campos son correctos</p>




                    <div class="form-group">

                        <label for="direccion">Dirección</label>

                        <input
                            type="text"
                            id="direccion"
                            class="form-control @error('direccion') is-invalid @enderror"
                            placeholder="Dirección"
                            value="{{ old('direccion') }}"
                            name="direccion"
                        >


                        @error('direccion')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>




                    <div class="form-group">

                        <label for="colonia">Colonia</label>

                        <input
                            type="text"
                            id="colonia"
                            class="form-control @error('colonia') is-invalid @enderror"
                            placeholder="Colonia"
                            value="{{ old('colonia') }}"
                            name="colonia"
                        >


                        @error('colonia')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>



                    <input type="hidden" id="lat" name="lat" value="{{ old('lat') }}">
                    <input type="hidden" id="lng" name="lng" value="{{ old('lng') }}">

                </fieldset>



                <fieldset class="border p-4 mt-5">
                    <legend  class="text-primary">Información Establecimiento: </legend>
                        <div class="form-group">
                            <label for="nombre">Teléfono</label>
                            <input
                                type="tel"
                                class="form-control @error('telefono')  is-invalid  @enderror"
                                id="telefono"
                                placeholder="Teléfono Establecimiento"
                                name="telefono"
                                value="{{ old('telefono') }}"
                            >

                                @error('telefono')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                        </div>



                        <div class="form-group">
                            <label for="nombre">Descripción</label>
                            <textarea
                                class="form-control  @error('descripcion')  is-invalid  @enderror"
                                name="descripcion"
                            >{{ old('descripcion') }}</textarea>

                                @error('descripcion')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                        </div>

                        <div class="form-group">
                            <label for="nombre">Hora Apertura:</label>
                            <input
                                type="time"
                                class="form-control @error('apertura')  is-invalid  @enderror"
                                id="apertura"
                                name="apertura"
                                value="{{ old('apertura') }}"
                            >
                            @error('apertura')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nombre">Hora Cierre:</label>
                            <input
                                type="time"
                                class="form-control @error('cierre')  is-invalid  @enderror"
                                id="cierre"
                                name="cierre"
                                value="{{ old('cierre') }}"
                            >
                            @error('cierre')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                </fieldset>

                <fieldset class="border p-4 mt-5">
                    <legend  class="text-primary">Información Establecimiento: </legend>
                        <div class="form-group">

                            <label for="imagenes">Imagenes</label>

                            <div id="dropzone" class="dropzone form-control"></div>

                        </div>
                </fieldset>

                <input type="hidden" id="uuid" value="{{ Str::uuid()->toString() }}">
                <input type="submit" class="btn btn-primary mt-3 d-block" value="Registrar Establecimiento">



            </form>
        </div>

    </div>

@endsection

@section('scripts')


    <script
        src="https://unpkg.com/leaflet@1.8.0/dist/leaflet.js"
        integrity="sha512-BB3hKbKWOc9Ez/TAwyWxNXeoV9c1v6FIeYiBieIWkpLjauysF18NzgR1MBNBXf8/KABdlkX68nAhlwcDFLGPCQ=="
        crossorigin=""
        defer
    ></script>

    <!-- Load Esri Leaflet from CDN -->
    <script
        src="https://unpkg.com/esri-leaflet"
        defer
    ></script>

    <!-- Esri Leaflet Geocoder -->
    <script
        src="https://unpkg.com/esri-leaflet-geocoder"
        defer
    ></script>

    <script
        src="https://unpkg.com/leaflet-geosearch@3.0.0/dist/geosearch.umd.js"
        defer
    ></script>


    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"
        integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
        defer
    ></script>



@endsection

