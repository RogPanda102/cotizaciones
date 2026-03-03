<h2>Crear Dependencia</h2>

<form action="{{ route('dependencias.store') }}" method="POST">
    @csrf

    <label>Nombre:</label>
    <input type="text" name="nombre">

    <label>Dirección:</label>
    <input type="text" name="direccion">

    <button type="submit">Guardar</button>
</form>