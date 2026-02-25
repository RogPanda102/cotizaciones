<!DOCTYPE html>
<html>
<head>
    <title>Crear Dependencia</title>
</head>
<body>

<h2>Nueva Dependencia</h2>

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

<form action="{{ route('dependencias.store') }}" method="POST">
    @csrf

    <div>
        <label>Nombre:</label>
        <input type="text" name="nombre" required>
    </div>

    <div>
        <label>Ubicación:</label>
        <input type="text" name="ubicacion" required>
    </div>

    <button type="submit">Guardar</button>
</form>

</body>
</html>