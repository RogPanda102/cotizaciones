@extends('layouts.app')

@section('content')
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
    <div x-data="pedidoForm()">
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

        <select name="empresa_id">
            <option value="">Selecciona empresa</option>
            @foreach($empresas as $empresa)
                <option 
                    value="{{ $empresa->id }}"
                    {{ old('empresa_id', request('empresa_id')) == $empresa->id ? 'selected' : '' }}
                >
                    {{ $empresa->nombre }}
                </option>
            @endforeach
        </select>

        <br><br>

        <label>Cliente:</label>
        <input type="text" name="departamento_cliente" placeholder="Departamento" required>
        <input type="text" name="contacto_cliente" placeholder="Contacto">
        <input type="text" name="telefono_cliente" placeholder="Teléfono">
        <input type="email" name="email_cliente" placeholder="Email">
        <input type="text" name="direccion_cliente" placeholder="Dirección">

        <br><br>

        <label>Proveedor:</label>
        <select name="proveedor_id" required>
            <option value="">Selecciona proveedor</option>
            @foreach($proveedores as $proveedor)
                <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
            @endforeach
        </select>

        <br><br>

        <label>Tipo de Pedido</label>
        <select name="tipo" x-model="tipo" class="form-control" required>
            <option value="">Selecciona tipo de servicio</option>
            <option value="servicio">Servicio</option>
            <option value="licencia">Licencia</option>
            <option value="mercadeo">Mercadeo</option>
        </select>

        <br><br>

        <div x-show="tipo === 'servicio'" x-transition x-cloak>
            <h5>Datos del Servicio</h5>

            <div>
                <label>Descripción</label>
                <input type="text" name="descripcion_servicio" class="form-control" x-bind:disabled="tipo !== 'servicio'">
            </div>

            <div>
                <label>Fecha inicio</label>
                <input type="date" name="servicio_fecha_inicio" class="form-control" x-bind:disabled="tipo !== 'servicio'">
            </div>

            <div>
                <label>Fecha fin</label>
                <input type="date" name="servicio_fecha_fin" class="form-control" x-bind:disabled="tipo !== 'servicio'">
            </div>
        </div>

        <br><br>

        <div x-show="tipo === 'licencia'" x-transition x-cloak>
            <h5>Datos de Licencia</h5>

            <div>
                <label>Nombre de licencia</label>
                <input type="text" name="nombre_licencia" class="form-control" x-bind:disabled="tipo !== 'licencia'">
            </div>

            <div>
                <label>Fecha inicio</label>
                <input type="date" name="licencia_fecha_inicio" class="form-control" x-bind:disabled="tipo !== 'licencia'">
            </div>

            <div>
                <label>Fecha fin</label>
                <input type="date" name="licencia_fecha_fin" class="form-control" x-bind:disabled="tipo !== 'licencia'">
            </div>
        </div>

        <br><br>

        <div x-show="tipo === 'mercadeo'" x-transition>
            <h5>Gestión de Mercadeo</h5>

            <p>
                Este tipo de pedido se gestiona mediante compras.
                Podrás agregar productos o servicios después de crear el pedido.
            </p>
        </div>

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
    </div>
</form>
<script>
function pedidoForm() {
    return {
        tipo: '{{ old('tipo') }}'
    }
}
</script>
@endsection