@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">

            <h4 class="mb-4">Crear Pedido</h4>

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

    <div x-data="pedidoForm()">

        {{-- 🔹 DATOS GENERALES --}}
        <h5 class="mb-3">Datos generales</h5>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Requisición</label>
                <select name="requisicion_id" class="form-control w-100">
                    @foreach($requisiciones as $req)
                        <option value="{{ $req->id }}">{{ $req->folio_externo }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Empresa</label>
                <select name="empresa_id" class="form-control w-100">
                    @foreach($empresas as $empresa)
                        <option
                            value="{{ $empresa->id }}"
                            {{ old('empresa_id', request('empresa_id')) == $empresa->id ? 'selected' : '' }}>
                            {{ $empresa->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <hr>

        {{-- 🔹 CLIENTE / PROVEEDOR --}}
        <h5 class="mb-3">Cliente y proveedor</h5>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Cliente</label>
                <select name="cliente_id" id="clienteSelect" class="form-control w-100">
                    <option value="">Selecciona cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}">
                            {{ $cliente->departamento }} - {{ $cliente->contacto }}
                        </option>
                    @endforeach
                </select>

                <button type="button" class="btn btn-outline-secondary mt-2" data-bs-toggle="modal" data-bs-target="#modalCliente">
                    + Nuevo cliente
                </button>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Proveedor</label>
                <select name="proveedor_id" class="form-control w-100">
                    <option value="">Selecciona proveedor</option>
                    @foreach($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}">
                            {{ $proveedor->empresa }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <hr>

        {{-- 🔹 TIPO DE PEDIDO --}}
        <h5 class="mb-3">Tipo de pedido</h5>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Tipo</label>
                <select name="tipo" x-model="tipo" class="form-control">
                    <option value="">Selecciona tipo</option>
                    <option value="servicio">Servicio</option>
                    <option value="licencia">Licencia</option>
                    <option value="mercadeo">Mercadeo</option>
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Dependencia</label>
                <select name="dependencia_id" class="form-control">
                    @foreach($dependencias as $dep)
                        <option value="{{ $dep->id }}">{{ $dep->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{-- 🔸 SERVICIO --}}
        <div x-show="tipo === 'servicio'" x-cloak>
            <hr>
            <h5>Datos del servicio</h5>

            <label class="form-label">Descripción</label>
            <textarea name="descripcion_servicio" class="form-control mb-2" placeholder="Descripción"></textarea>
            <label class="form-label">Alcance</label>
            <textarea name="alcance" class="form-control mb-2" placeholder="Alcance"></textarea>
            <label class="form-label">Responsable</label>
            <input type="text" name="responsable" class="form-control mb-2" placeholder="Responsable">
            <label class="form-label">Entregables</label>
            <textarea name="entregables" class="form-control mb-2" placeholder="Entregables"></textarea>

            <div class="row">
                <div class="col-md-6 mb-2">
                    <label class="form-label">Fecha de inicio</label>
                    <input type="date" name="fecha_inicio_servicio" class="form-control">
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label">Fecha de fin</label>
                    <input type="date" name="fecha_fin_servicio" class="form-control">
                </div>
            </div>
            <label class="form-label">Costo del servicio</label>
            <input type="number" name="costo_servicio" class="form-control mb-2" placeholder="Costo">
                
        </div>

        {{-- LICENCIA --}}
        <div x-show="tipo === 'licencia'" x-cloak>
            <hr>
            <h5>Datos de licencia</h5>

            <label class="form-label">Nombre</label>
            <input type="text" name="nombre_licencia" class="form-control mb-2" placeholder="Nombre">
            <label class="form-label">Tipo</label>
            <input type="text" name="tipo_licencia" class="form-control mb-2" placeholder="Tipo">
            <label class="form-label">Número de usuarios</label>
            <input type="number" name="numero_usuarios" class="form-control mb-2" placeholder="Número de usuarios">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label class="form-label">Costo de renovación</label>
                    <input type="number" name="costo_renovacion" class="form-control" placeholder="Costo de renovación">
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label">Costo de licencia</label>
                    <input type="number" name="costo_licencia" class="form-control" placeholder="Costo de licencia">
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-2">
                    <label class="form-label">Fecha de inicio</label>
                    <input type="date" name="fecha_inicio_licencia" class="form-control">
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label">Fecha de fin</label>
                    <input type="date" name="fecha_fin_licencia" class="form-control">
                </div>
            </div>
        </div>

        {{--  MERCADEO --}}
        <div x-show="tipo === 'mercadeo'" x-cloak>
            <hr>
            <p class="text-muted">
                Este pedido se gestionará mediante compras después de crearlo.
            </p>
        </div>

        <hr>

        {{-- 🔹 FINANZAS Y FECHAS --}}
        <h5 class="mb-3">Condiciones</h5>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label>Monto aprobado</label>
                <input type="number" name="monto_total_aprobado" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Días entrega</label>
                <input type="number" name="dias_entrega" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label>Días crédito</label>
                <input type="number" name="dias_credito" class="form-control">
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Fecha adjudicación</label>
                <input type="date" name="fecha_adjudicacion" class="form-control">
            </div>

            <div class="col-md-6 mb-3">
                <label>Tipo de días</label>
                <select name="tipo_dias" class="form-control">
                    <option value="naturales">Naturales</option>
                    <option value="habiles">Hábiles</option>
                </select>
            </div>
        </div>

        <hr>

        {{-- 🔹 BOTÓN --}}
        <button type="submit" class="btn btn-primary">
            Guardar Pedido
        </button>

    </div>
</form>

</div>
</div>
</div>
<div class="modal fade" id="modalCliente" tabindex="-1">
  <div class="modal-dialog modal-lg"> <!-- lg = más ancho -->
    <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Nuevo Cliente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <div class="modal-body">

            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="text" id="nuevo_departamento" class="form-control" placeholder="Departamento">
                </div>

                <div class="col-md-6 mb-3">
                    <input type="text" id="nuevo_contacto" class="form-control" placeholder="Contacto">
                </div>

                <div class="col-md-6 mb-3">
                    <input type="text" id="nuevo_telefono" class="form-control" placeholder="Teléfono">
                </div>

                <div class="col-md-6 mb-3">
                    <input type="email" id="nuevo_email" class="form-control" placeholder="Email">
                </div>

                <div class="col-12 mb-3">
                    <input type="text" id="nuevo_direccion" class="form-control" placeholder="Dirección">
                </div>
            </div>
            <div id="cliente-existente" class="alert alert-warning d-none">
                Cliente existente: <span id="cliente-info"></span>
                <br>
                <button type="button" class="btn btn-sm btn-primary mt-2" onclick="usarClienteExistente()">
                    Usar este cliente
                </button>
            </div>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Cancelar
            </button>
            <button type="button" class="btn btn-primary" onclick="guardarCliente()">
            Guardar
            </button>
        </div>

    </div>
  </div>
</div>
<script>

let clienteDetectado = null;

function pedidoForm() {
    return {
        tipo: '{{ old('tipo') }}'
    }
}

// 🔥 CERRAR MODAL BIEN (Bootstrap)
function cerrarModalCliente() {
    const modalEl = document.getElementById('modalCliente');
    const modal = bootstrap.Modal.getInstance(modalEl);
    if (modal) modal.hide();
}

// 🔥 GUARDAR CLIENTE (MEJORADO)
function guardarCliente() {

    if (clienteDetectado) {
        alert('Este cliente ya existe, usa "Usar este cliente"');
        return;
    }
    
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
    .then(res => {
        if (!res.ok) {
            throw new Error('Error al guardar cliente');
        }
        return res.json();
    })
    .then(data => {

        // 🚫 Ya existe
        if (data.existe) {
            clienteDetectado = data.cliente;

            document.getElementById('cliente-existente').classList.remove('d-none');

            document.getElementById('cliente-info').innerText =
                `${data.cliente.departamento} - ${data.cliente.contacto}`;

            return;
        }

        // ✅ Cliente nuevo
        let cliente = data;

        let select = document.getElementById('clienteSelect');

        let option = document.createElement('option');
        option.value = cliente.id;
        option.text = cliente.departamento + ' - ' + cliente.contacto;

        select.appendChild(option);
        select.value = cliente.id;

        clienteDetectado = null;

        cerrarModalCliente();
    })
    .catch(error => {
        console.error(error);
        alert('Ocurrió un error al guardar el cliente');
    });
}


// 🔥 BUSCAR CLIENTE EXISTENTE
function buscarClienteExistente() {

    const email = document.getElementById('nuevo_email').value;
    const telefono = document.getElementById('nuevo_telefono').value;

    if (!email && !telefono) return;

    fetch(`/clientes/buscar?email=${email}&telefono=${telefono}`)
        .then(res => res.json())
        .then(cliente => {
            if (cliente && cliente.id) {
                clienteDetectado = cliente;

                document.getElementById('cliente-existente').classList.remove('d-none');

                document.getElementById('cliente-info').innerText =
                    `${cliente.departamento ?? 'Sin departamento'} - ${cliente.contacto ?? 'Sin contacto'}`;
            } else {
                clienteDetectado = null;
                document.getElementById('cliente-existente').classList.add('d-none');
            }
        });
}


// 🔥 USAR CLIENTE DETECTADO
function usarClienteExistente() {
    if (!clienteDetectado) return;

    let select = document.getElementById('clienteSelect');

    select.value = clienteDetectado.id;

    cerrarModalCliente();
}


// 🔥 ACTIVAR DETECCIÓN AUTOMÁTICA
document.addEventListener('DOMContentLoaded', () => {
    const email = document.getElementById('nuevo_email');
    const telefono = document.getElementById('nuevo_telefono');

    if (email) email.addEventListener('blur', buscarClienteExistente);
    if (telefono) telefono.addEventListener('blur', buscarClienteExistente);
});

</script>

@endsection