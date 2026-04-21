<h2>Crear Cotización</h2>
@if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<form action="{{ route('cotizaciones.store') }}" method="POST">
    @csrf

    <label>Folio Externo:</label>
    <input type="text" name="folio_externo">

    <br><br>

    <label>Descripción:</label>
    <input type="text" name="descripcion">

    <br><br>

    <label>Estado:</label>
    <select name="estado">
        @foreach(App\Enums\EstadoCotizacion::cases() as $estado)
            <option value="{{ $estado->value }}">
                {{ $estado->label() }}
            </option>
        @endforeach
    </select>

    <br><br>

    <button type="submit">Guardar</button>
</form>