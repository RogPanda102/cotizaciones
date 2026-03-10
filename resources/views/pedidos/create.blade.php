<h2>Crear Pedido</h2>

@if ($errors->any())
    <div style="color:red;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<form action="{{ route('pedidos.store') }}" method="POST">
    @csrf

    <label>Requisición:</label>
    <select name="requisicion_id">
        @foreach($requisiciones as $req)
            <option value="{{ $req->id }}">
                {{ $req->folio_externo }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label>Dependencia:</label>
    <select name="dependencia_id">
        @foreach($dependencias as $dep)
            <option value="{{ $dep->id }}">
                {{ $dep->nombre }}
            </option>
        @endforeach
    </select>

    <br><br>

    <label>Monto Total Aprobado:</label>
    <input type="number" step="0.01" name="monto_total_aprobado">

    <br><br>

    <label>Fecha Adjudicación:</label>
    <input type="date" name="fecha_adjudicacion">

    <br><br>

    <label>Dias para Entrega:</label>
    <input type="number" name="dias_entrega" min="0" class="form-control">

    <br><br>

    <label>Fecha Facturación:</label>
    <input type="date" name="fecha_facturacion">

    <br><br>

    <label>Tipo de Días:</label>
    <select name="tipo_dias">
        <option value="naturales">Naturales</option>
        <option value="habiles">Hábiles</option>
    </select>

    <br><br>

    <label>Días de Crédito:</label>
    <input type="number" name="dias_credito">

    <br><br>

    <label>Estado:</label>
    <select name="estado">
        @foreach(App\Enums\EstadoPedido::cases() as $estado)
            <option value="{{ $estado->value }}">
                {{ $estado->label() }}
            </option>
        @endforeach
    </select>

    <br><br>

    <button type="submit">Guardar Pedido</button>
</form>