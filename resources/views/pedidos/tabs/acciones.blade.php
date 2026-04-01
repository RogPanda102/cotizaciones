@if($pedido->estado->esFinal())

    <div class="alert alert-warning">
    Este pedido ya fue pagado y no puede modificarse.
    </div>

@else

    <h4>Cambiar estado</h4>

    <form id="update-form-{{ $pedido->id }}" action="{{ route('pedidos.update', $pedido->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">

            <label>Estado</label>

            <select name="estado" id="estadoSelect" class="form-control">

                <option value="{{ $pedido->estado->value }}" selected>
                    {{ $pedido->estado->label() }}
                </option>

                @foreach($pedido->estado->siguientesEstados() as $estado)

                    <option value="{{ $estado->value }}">
                    {{ $estado->label() }}
                    </option>

                @endforeach

            </select>

        </div>


        <div class="mb-3" id="fechaFacturacionGroup" style="display:none;">

            <label>Fecha facturación</label>

            <input type="date"
            name="fecha_facturacion"
            class="form-control"
            value="{{ old('fecha_facturacion', $pedido->fecha_facturacion) }}">

        </div>



        <button type="button" class="btn btn-primary" onclick="confirmUpdate({{ $pedido->id }})">
        Actualizar
        </button>
    </form>
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const estadoSelect = document.getElementById('estadoSelect');
            const fechaGroup = document.getElementById('fechaFacturacionGroup');

            if (!estadoSelect) return;

            function toggleFechaFacturacion() {

                if (estadoSelect.value === 'facturado') {
                    fechaGroup.style.display = 'block';
                } else {
                    fechaGroup.style.display = 'none';
                }

            }

            estadoSelect.addEventListener('change', toggleFechaFacturacion);

            toggleFechaFacturacion();

        });

        function confirmUpdate(id) {
            const estado = document.getElementById('estadoSelect').value;
            Swal.fire({
                title: '¿Actualizar estado?',
                text: `El pedido pasará a: ${estado}`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#0d6efd',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sí, actualizar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.getElementById('update-form-' + id);
                    if (form) {
                        form.submit();
                    }
                }
            });
        }

    </script>
@endif
