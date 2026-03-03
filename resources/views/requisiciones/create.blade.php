<h2>Crear Requisición</h2>

<form action="{{ route('requisiciones.store') }}" method="POST">
    @csrf

    <label>Folio Externo:</label>
    <input type="text" name="folio_externo">

    <br><br>

    <label>Descripción:</label>
    <input type="text" name="descripcion">

    <br><br>

    <label>Estado:</label>
    <select name="estado">
        @foreach(App\Enums\EstadoRequisicion::cases() as $estado)
            <option value="{{ $estado->value }}">
                {{ $estado->label() }}
            </option>
        @endforeach
    </select>

    <br><br>

    <button type="submit">Guardar</button>
</form>