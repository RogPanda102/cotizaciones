@extends('layouts.app')
@section('content')

@if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<div x-data="cotizacionForm()" class="container">

    <form method="POST" action="{{ route('cotizaciones.store') }}">
        @csrf

        <!-- ===================== -->
        <!-- 🔹 BLOQUE 1: BASE -->
        <!-- ===================== -->
        <div class="card mb-3">
            <div class="card-header fw-bold">Información base</div>
            <div class="card-body row">

                <div class="col-md-4">
                    <label>Empresa</label>
                    <select name="empresa_id" class="form-control" required>
                        <option value="">Seleccionar</option>
                        @foreach($empresas as $empresa)
                            <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label>Tipo de cotización</label>
                    <select name="tipo_cotizacion" x-model="tipo" class="form-control" required>
                        <option value="">Seleccionar</option>
                        <option value="omg">OMG</option>
                        <option value="dependencia_directa">Dependencia directa</option>
                        <option value="cliente_externo">Cliente externo</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label>Estado</label>
                    <select name="estado" x-model="estado" class="form-control" required @change="if (estado !== 'enviado') fechaEnvio = ''">
                        <option value="enviado">Enviado</option>
                        <option value="respaldo">Respaldo</option>
                        <option value="no_cotiza">No cotiza</option>
                    </select>
                </div>

                <div class="col-md-6 mt-3">
                    <label>Número de cotización</label>
                    <input type="number" name="numero_cotizacion" class="form-control">
                </div>

                <div class="col-md-6 mt-3">
                    <label>Folio externo</label>
                    <input type="text" name="folio_externo" class="form-control">
                </div>

            </div>
        </div>

        <!-- ===================== -->
        <!-- 🔹 BLOQUE 2: RELACIONES -->
        <!-- ===================== -->
        <div class="card mb-3" x-show="tipo !== 'cliente_externo'">
            <div class="card-header fw-bold">Relaciones</div>
            <div class="card-body row">

                <template x-if="tipo !== 'cliente_externo'">
                    <div class="col-md-4">
                        <label>Dependencia</label>
                        <select name="dependencia_id" class="form-control">
                            <option value="">Seleccionar</option>
                            <template x-for="dep in dependencias" :key="dep.id">
                                <option :value="dep.id" x-text="dep.nombre"></option>
                            </template>
                        </select>
                    </div>
                </template>

                <template x-if="tipo !== 'cliente_externo'">
                    <div class="col-md-4">
                        <label>
                            Departamento
                        </label>
                        <select
                            name="departamento_id"
                            class="form-control"
                            x-model="departamentoId">
                            <option value="">Seleccionar</option>
                            <template x-for="dep in departamentos" :key="dep.id">
                                
                                <option :value="dep.id" x-text="dep.responsable"></option>
                            </template>
                        </select>
                        <button
                            type="button"
                            class="btn btn-outline-primary px-3"
                            style="white-space: nowrap;"
                            @click="openModal('departamento')">
                            Nuevo departamento +
                        </button>
                    </div>
                </template>

                <!-- Analista (NO cliente externo) -->
                <template x-if="tipo !== 'cliente_externo'">
                    <div class="col-md-4">
                        <label>
                            Analista
                        </label>
                        <select
                            name="analista_id"
                            class="form-control"
                            x-model="analistaId">
                            <option value="">Seleccionar</option>
                            <template x-for="analista in analistas" :key="analista.id">
                                <option :value="analista.id" x-text="analista.nombre"></option>
                            </template>
                        </select>
                        <button
                            type="button"
                            class="btn btn-outline-primary px-3"
                            style="white-space: nowrap;"
                            x-on:click="openModal('analista')">
                            Nuevo analista +
                        </button>
                    </div>
                </template>

            </div>
        </div>

        <!-- ===================== -->
        <!-- 🔹 BLOQUE 3: FECHAS -->
        <!-- ===================== -->
        <div class="card mb-3">
            <div class="card-header fw-bold">Fechas</div>
            <div class="card-body row">

                <div class="col-md-6">
                    <label>Fecha envío</label>
                    <input type="date" 
                    name="fecha_envio" 
                    class="form-control" 
                    x-model="fechaEnvio"
                    :readonly="estado !== 'enviado'" 
                    :required="estado === 'enviado'">
                </div>

                <div class="col-md-6">
                    <label>Fecha recepción</label>
                    <input type="date" name="fecha_recepcion" class="form-control">
                </div>

            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header fw-bold">Garantia</div>
            <div class="card-body row">

                <div class="col-md-6">
                    <label>Garantía</label>
                    <input type="number" name="garantia" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Monto total</label>
                    <input type="number" step="0.01" name="monto_total" class="form-control">
                </div>
            </div>
        </div>

        <!-- ================== --->
        <!--  BLOQUE 4: HORA Y LUGAR --->
        <!-- =================== --->

        <template x-if="tipo !== 'cliente_externo'">
            <div class="card mb-3">
                <div class="card-header fw-bold">Entrega</div>
                <div class="card-body row">

                    <div class="col-md-6">
                        <label>Horario de entrega</label>
                        <input type="time"
                            name="horario_de_entrega"
                            class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label>Lugar de entrega</label>
                        <input type="text"
                            name="lugar_de_entrega"
                            class="form-control">
                    </div>

                </div>
            </div>
        </template>

        <!-- ===================== -->
        <!-- 🔹 BLOQUE 4: FINANCIEROS -->
        <!-- ===================== -->

        <!-- SOLO OMG -->
        <template x-if="tipo === 'omg'">
            <div class="card mb-3">
                <div class="card-header fw-bold">Financieros</div>
                <div class="card-body row">

                    
                    <div class="col-md-3">
                        <label>Días crédito</label>
                        <input type="number" name="dias_credito" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label>Tipo días</label>
                        <select name="tipo_dias" class="form-control">
                            <option value="naturales">Naturales</option>
                            <option value="habiles">Hábiles</option>
                        </select>
                    </div>


                </div>
            </div>
        </template>

        <!-- ===================== -->
        <!-- 🔘 BOTÓN -->
        <!-- ===================== -->

        <div class="text-end">
            <button class="btn btn-primary">
                Guardar cotización
            </button>
        </div>

    </form>

    <div
        x-cloak
        x-show="modal.open"
        x-bind:class="modal.open ? 'd-flex align-items-center justify-content-center' : ''"
        class="position-fixed top-0 start-0 w-100 h-100"
        style="background: rgba(0, 0, 0, 0.45); z-index: 1050;"
        x-on:click.self="closeModal()">
        <div class="bg-white rounded shadow p-4" style="width: min(95%, 640px); max-height: 90vh; overflow-y: auto;">
            <h5 class="mb-3" x-text="modal.title"></h5>

            <template x-if="modal.type === 'analista'">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Nombre *</label>
                        <input type="text" class="form-control" x-model="modal.form.nombre">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Apellido paterno *</label>
                        <input type="text" class="form-control" x-model="modal.form.apellido_paterno">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Apellido materno</label>
                        <input type="text" class="form-control" x-model="modal.form.apellido_materno">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control" x-model="modal.form.telefono">
                    </div>
                    <div class="col-12 mb-2">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" x-model="modal.form.email">
                    </div>
                </div>
            </template>

            <template x-if="modal.type === 'departamento'">
                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Dependencia</label>
                        <select class="form-control" x-model="modal.form.dependencia_id">
                            <option value="">Seleccionar</option>
                            <template x-for="dep in dependencias" :key="dep.id">
                                <option :value="String(dep.id)" x-text="dep.nombre"></option>
                            </template>
                        </select>
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Nombre departamento *</label>
                        <input type="text" class="form-control" x-model="modal.form.nombre_departamento">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Responsable</label>
                        <input type="text" class="form-control" x-model="modal.form.responsable">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label class="form-label">Teléfono</label>
                        <input type="text" class="form-control" x-model="modal.form.telefono" x-on:blur="buscarDepartamentoExistente">
                    </div>
                    <div class="col-12 mb-2">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" x-model="modal.form.email" x-on:blur="buscarDepartamentoExistente">
                    </div>
                    <div class="col-12 mb-2">
                        <label class="form-label">Dirección</label>
                        <input type="text" class="form-control" x-model="modal.form.direccion">
                    </div>
                    <div class="col-12">
                        <div class="alert alert-warning py-2 mb-0" x-show="departamentoDetectado">
                            Este cliente ya existe:
                            <strong x-text="`${departamentoDetectado?.nombre_departamento ?? 'Sin nombre'} - ${departamentoDetectado?.responsable ?? 'Sin responsable'}`"></strong>
                            <button type="button" class="btn btn-sm btn-primary ms-2 mt-2 mt-md-0" x-on:click="usarDepartamentoExistente">
                                Usar este departamento
                            </button>
                        </div>
                    </div>
                </div>
            </template>

            <p class="text-danger small mb-2" x-show="modal.error" x-text="modal.error"></p>

            <div class="d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-outline-secondary" x-on:click="closeModal()">Cancelar</button>
                <button type="button" class="btn btn-primary" x-bind:disabled="modal.saving" x-on:click="saveModalItem()">
                    <span x-show="!modal.saving">Guardar</span>
                    <span x-show="modal.saving">Guardando...</span>
                </button>
            </div>
        </div>
    </div>
</div>
<style>
[x-cloak] { display: none !important; }
</style>
@php
    $analistasJson = $analistas->map(function ($a) {
        $nombreCompleto = trim(implode(' ', array_filter([
            $a->nombre,
            $a->apellido_paterno,
            $a->apellido_materno,
        ])));

        return [
            'id' => $a->id,
            'nombre' => $nombreCompleto,
        ];
    })->values();
@endphp
<script>
    window.cotizacionData = {
        old: {
            tipo: "{{ old('tipo_cotizacion') }}",
            estado: "{{ old('estado', 'enviado') }}",
            fechaEnvio: "{{ old('fecha_envio') }}",
            dependenciaId: "{{ old('dependencia_id') }}",
            analistaId: "{{ old('analista_id') }}",
            departamentoId: "{{ old('departamento_id') }}"
        },
        dependencias: @json(
            $dependencias->map(fn($d) => [
                'id' => $d->id,
                'nombre' => $d->nombre_oficial
            ])->values()
        ),
        analistas: @json($analistasJson),
        departamentos: @json(
            $departamentos->map(fn($d) => [
                'id' => $d->id,
                'responsable' => $d->responsable
            ])->values()
        ),
        csrfToken: "{{ csrf_token() }}",
        routes: {
            analistasStore: "{{ route('analistas.store') }}",
            departamentosStore: "{{ route('departamentos.store') }}",
            departamentosBuscar: "{{ route('departamentos.buscar') }}"
        }
    };
</script>

<script src="{{ asset(config('rutas.js_especificos') . 'cotizaciones/cotizaciones_create.js') }}"></script>

@endsection