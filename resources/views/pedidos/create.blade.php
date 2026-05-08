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
            <div class="col-md-4 mb-3">
                <label class="form-label">Cotización</label>
                <select name="cotizacion_id" class="form-control w-100">
                    @foreach($cotizaciones as $cot)
                        <option value="{{ $cot->id }}">{{ $cot->folio_externo }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-4 mb-3">
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

            <div class="col-md-4 mb-3">
                <label class="form-label">Dependencia</label>
                <select name="dependencia_id" class="form-control">
                    <option value="">Seleccionar dependencia</option>
                    @foreach($dependencias as $dep)
                        <option value="{{ $dep->id }}">{{ $dep->nombre_oficial }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <hr>

        {{-- 🔹 DEPARTAMENTO / PROVEEDOR --}}
        <h5 class="mb-3">Departamento, analista y proveedor</h5>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Departamento</label>
                <select name="departamento_id" id="departamentoSelect" class="form-control w-100" x-model="departamentoId">
                    <option value="">Selecciona departamento</option>
                    @foreach($departamentos as $departamento)
                        <option value="{{ $departamento->id }}" {{ old('departamento_id') == $departamento->id ? 'selected' : '' }}>
                            {{ $departamento->nombre_departamento }} - {{ $departamento->responsable }}
                        </option>
                    @endforeach
                </select>

                <button type="button" class="btn btn-outline-secondary mt-2" data-bs-toggle="modal" data-bs-target="#modalDepartamento">
                    + Nuevo departamento
                </button>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Analista</label>
                <select name="analista_id" id="analistaSelect" class="form-control w-100" x-model="analistaId">
                    <option value="">Selecciona analista</option>
                    @foreach($analistas as $analista)
                        @php
                            $nombreCompleto = trim(implode(' ', array_filter([
                                $analista->nombre,
                                $analista->apellido_paterno,
                                $analista->apellido_materno,
                            ])));
                        @endphp
                        <option value="{{ $analista->id }}" {{ old('analista_id') == $analista->id ? 'selected' : '' }}>
                            {{ $nombreCompleto }}
                        </option>
                    @endforeach
                </select>
                <button type="button" class="btn btn-outline-secondary mt-2" data-bs-toggle="modal" data-bs-target="#modalAnalista">
                    + Nuevo analista
                </button>
            </div>

            <div class="col-md-4 mb-3">
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
                <label class="form-label">Lugar de entrega</label>
                <input type="text" name="lugar_entrega" class="form-control" value="{{ old('lugar_entrega') }}" placeholder="Lugar de entrega">
            </div>
        </div>

        <div class="row">
            <div class="col-12 mb-3">
                <label class="form-label">Condición de entrega</label>
                <textarea name="condiciones_entrega" class="form-control" rows="2" placeholder="Condiciones de entrega">{{ old('condiciones_entrega') }}</textarea>
            </div>
        </div>

        {{-- SERVICIO --}}
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
            <label class="form-label">Observaciones</label>
            <textarea name="observaciones" class="form-control mb-2" placeholder="Observaciones"></textarea>

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

<div class="modal fade" id="modalAnalista" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Nuevo Analista</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <input type="text" id="nuevo_analista_nombre" class="form-control" placeholder="Nombre">
                </div>
                <div class="col-md-6 mb-3">
                    <input type="text" id="nuevo_analista_apellido_paterno" class="form-control" placeholder="Apellido paterno">
                </div>
                <div class="col-md-6 mb-3">
                    <input type="text" id="nuevo_analista_apellido_materno" class="form-control" placeholder="Apellido materno">
                </div>
                <div class="col-md-6 mb-3">
                    <input type="text" id="nuevo_analista_telefono" class="form-control" placeholder="Teléfono">
                </div>
                <div class="col-12 mb-3">
                    <input type="email" id="nuevo_analista_email" class="form-control" placeholder="Email">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-primary" onclick="guardarAnalista()">Guardar</button>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalDepartamento" tabindex="-1">
  <div class="modal-dialog modal-lg"> <!-- lg = más ancho -->
    <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Nuevo Departamento</h5>
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
            <div id="departamento-existente" class="alert alert-warning d-none">
                Departamento existente: <span id="departamento-info"></span>
                <br>
                <button type="button" class="btn btn-sm btn-primary mt-2" onclick="usarClienteExistente()">
                    Usar este departamento
                </button>
            </div>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Cancelar
            </button>
            <button type="button" class="btn btn-primary" onclick="guardarDepartamento()">
            Guardar
            </button>
        </div>

    </div>
  </div>
</div>
<script>

let departamentoDetectado = null;

function pedidoForm() {
    return {
        tipo: '{{ old('tipo') }}',
        departamentoId: '{{ old('departamento_id') }}',
        analistaId: '{{ old('analista_id') }}'
    }
}

// 🔥 CERRAR MODAL BIEN (Bootstrap)
function cerrarModalDepartamento() {
    const modalEl = document.getElementById('modalDepartamento');
    const modal = bootstrap.Modal.getInstance(modalEl);
    if (modal) modal.hide();
}

function cerrarModalAnalista() {
    const modalEl = document.getElementById('modalAnalista');
    const modal = bootstrap.Modal.getInstance(modalEl);
    if (modal) modal.hide();
}

function guardarAnalista() {
    const payload = {
        nombre: (document.getElementById('nuevo_analista_nombre').value || '').trim(),
        apellido_paterno: (document.getElementById('nuevo_analista_apellido_paterno').value || '').trim(),
        apellido_materno: (document.getElementById('nuevo_analista_apellido_materno').value || '').trim(),
        telefono: (document.getElementById('nuevo_analista_telefono').value || '').trim(),
        email: (document.getElementById('nuevo_analista_email').value || '').trim().toLowerCase(),
    };

    if (!payload.nombre || !payload.apellido_paterno) {
        alert('Nombre y apellido paterno son obligatorios');
        return;
    }

    fetch('{{ route('analistas.store') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify(payload),
    })
    .then(async res => {
        const data = await res.json();
        if (!res.ok) {
            throw new Error(data.message || 'Error al guardar analista');
        }
        return data;
    })
    .then(analista => {
        const select = document.getElementById('analistaSelect');
        const option = document.createElement('option');
        option.value = analista.id;
        option.text = analista.nombre;
        select.appendChild(option);
        select.value = analista.id;

        cerrarModalAnalista();
    })
    .catch(error => {
        console.error(error);
        alert('Ocurrió un error al guardar el analista');
    });
}

// 🔥 GUARDAR DEPARTAMENTO
function guardarDepartamento() {
    if (departamentoDetectado) {
        alert('Este departamento ya existe, usa "Usar este departamento"');
        return;
    }

    const payload = {
        nombre_departamento: document.getElementById('nuevo_departamento').value.trim(),
        responsable: document.getElementById('nuevo_contacto').value.trim(),
        telefono: (document.getElementById('nuevo_telefono').value || '').replace(/\D/g, ''),
        email: (document.getElementById('nuevo_email').value || '').trim().toLowerCase(),
        direccion: document.getElementById('nuevo_direccion').value.trim(),
    };

    if (!payload.nombre_departamento) {
        alert('El nombre del departamento es obligatorio');
        return;
    }

    fetch('/departamentos', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: JSON.stringify(payload),
    })
    .then(res => {
        if (!res.ok) {
            throw new Error('Error al guardar departamento');
        }
        return res.json();
    })
    .then(departamento => {
        const select = document.getElementById('departamentoSelect');
        let option = document.createElement('option');
        option.value = departamento.id;
        option.text = departamento.nombre;

        select.appendChild(option);
        select.value = departamento.id;

        departamentoDetectado = null;
        document.getElementById('departamento-existente').classList.add('d-none');

        cerrarModalDepartamento();
    })
    .catch(error => {
        console.error(error);
        alert('Ocurrió un error al guardar el departamento');
    });
}


// 🔥 BUSCAR DEPARTAMENTO EXISTENTE
function buscarDepartamentoExistente() {
    const email = (document.getElementById('nuevo_email').value || '').trim().toLowerCase();
    const telefono = (document.getElementById('nuevo_telefono').value || '').replace(/\D/g, '');

    if (!email && !telefono) return;

    fetch(`/departamentos/buscar?email=${encodeURIComponent(email)}&telefono=${encodeURIComponent(telefono)}`)
        .then(res => res.json())
        .then(departamento => {
            if (departamento && departamento.id) {
                departamentoDetectado = departamento;

                document.getElementById('departamento-existente').classList.remove('d-none');

                document.getElementById('departamento-info').innerText =
                    `${departamento.nombre_departamento ?? 'Sin departamento'} - ${departamento.responsable ?? 'Sin responsable'}`;
            } else {
                departamentoDetectado = null;
                document.getElementById('departamento-existente').classList.add('d-none');
            }
        });
}


// 🔥 USAR DEPARTAMENTO DETECTADO
function usarClienteExistente() {
    if (!departamentoDetectado) return;

    let select = document.getElementById('departamentoSelect');

    select.value = departamentoDetectado.id;

    cerrarModalDepartamento();
}


// 🔥 ACTIVAR DETECCIÓN AUTOMÁTICA
document.addEventListener('DOMContentLoaded', () => {
    const email = document.getElementById('nuevo_email');
    const telefono = document.getElementById('nuevo_telefono');

    if (email) email.addEventListener('blur', buscarDepartamentoExistente);
    if (telefono) telefono.addEventListener('blur', buscarDepartamentoExistente);
});

</script>

@endsection