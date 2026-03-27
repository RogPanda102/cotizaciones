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
            <select name="cliente_id" id="clienteSelect" required>
                <option value="">Selecciona cliente</option>

                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}">
                        {{ $cliente->departamento }} - {{ $cliente->contacto }}
                    </option>
                @endforeach
            </select>

        <button type="button" onclick="abrirModalCliente()">
            + Nuevo cliente
        </button>
        <div id="modalCliente" style="display:none; background:white; padding:20px; border:1px solid #ccc; margin-top:20px;">

            <h4>Nuevo Cliente</h4>

            <input type="text" id="nuevo_departamento" placeholder="Departamento">
            <input type="text" id="nuevo_contacto" placeholder="Contacto">
            <input type="text" id="nuevo_telefono" placeholder="Teléfono">
            <input type="email" id="nuevo_email" placeholder="Email">
            <input type="text" id="nuevo_direccion" placeholder="Dirección">

            <br><br>

            <button type="button" onclick="guardarCliente()">Guardar</button>
            <button type="button" onclick="cerrarModalCliente()">Cancelar</button>
        </div>

        <br><br>

        <label>Proveedor:</label>
        <select name="proveedor_id" required>
            <option value="">Selecciona proveedor</option>
            @foreach($proveedores as $proveedor)
                <option value="{{ $proveedor->id }}">
                    {{ $proveedor->empresa }}
                </option>
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

            <textarea name="descripcion_servicio" placeholder="Descripción" x-bind:disabled="tipo !== 'servicio'"></textarea>

            <textarea name="alcance" placeholder="Alcance" x-bind:disabled="tipo !== 'servicio'"></textarea>

            <input type="text" name="responsable" placeholder="Responsable" x-bind:disabled="tipo !== 'servicio'">

            <textarea name="entregables" placeholder="Entregables" x-bind:disabled="tipo !== 'servicio'"></textarea>

            <textarea name="observaciones" placeholder="Observaciones" x-bind:disabled="tipo !== 'servicio'"></textarea>

            <input type="number" step="0.01" name="costo_servicio" placeholder="Costo Servicio" x-bind:disabled="tipo !== 'servicio'">

            <input type="date" name="fecha_inicio" x-bind:disabled="tipo !== 'servicio'">
            <input type="date" name="fecha_fin" x-bind:disabled="tipo !== 'servicio'">
        </div>

        <br><br>

        <div x-show="tipo === 'licencia'" x-transition x-cloak>
            <h5>Datos de Licencia</h5>

            <input type="text" name="nombre_licencia" placeholder="Nombre de licencia" x-bind:disabled="tipo !== 'licencia' ">

            <input type="text" name="tipo_licencia" placeholder="Tipo de licencia" x-bind:disabled="tipo !== 'licencia'">

            <input type="number" name="numero_usuarios" placeholder="Número de usuarios" x-bind:disabled="tipo !== 'licencia'">

            <input type="number" name="costo_licencia" step="0.01" placeholder="Costo Licencia(s)" x-bind:disabled="tipo !== 'licencia'">

            <input type="number" step="0.01" name="costo_renovacion" placeholder="Costo renovación" x-bind:disabled="tipo !== 'licencia'">

            <input type="date" name="fecha_inicio" x-bind:disabled="tipo !== 'licencia'">
            <input type="date" name="fecha_fin" x-bind:disabled="tipo !== 'licencia'">
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

    function abrirModalCliente() {
        document.getElementById('modalCliente').style.display = 'block';
    }

    function cerrarModalCliente() {
        document.getElementById('modalCliente').style.display = 'none';
    }

    function guardarCliente() {

        fetch('/clientes', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                departamento: document.getElementById('nuevo_departamento').value,
                contacto: document.getElementById('nuevo_contacto').value,
                telefono: document.getElementById('nuevo_telefono').value,
                email: document.getElementById('nuevo_email').value,
                direccion: document.getElementById('nuevo_direccion').value,
            })
        })
        .then(res => res.json())
        .then(cliente => {

            let select = document.getElementById('clienteSelect');

            let option = document.createElement('option');
            option.value = cliente.id;
            option.text = cliente.departamento;

            select.appendChild(option);
            select.value = cliente.id;

            cerrarModalCliente();
        });
    }

</script>

@endsection