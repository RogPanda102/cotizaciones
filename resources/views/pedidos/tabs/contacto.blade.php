<div class="row">

    {{-- CLIENTE --}}
    <div class="col-md-6 mb-3">
        <div class="card h-100">
            <div class="card-header">
                Cliente
            </div>

            <div class="card-body">

                <p>
                    <strong>Departamento:</strong><br>
                    {{ $pedido->cliente->departamento ?? '—' }}
                </p>

                <p>
                    <strong>Nombre de contacto:</strong><br>
                    {{ $pedido->cliente->contacto ?? '—' }}
                </p>

                <p>
                    <strong>Teléfono:</strong><br>
                    {{ $pedido->cliente->telefono ?? '—' }}
                </p>

                <p>
                    <strong>Email:</strong><br>
                    {{ $pedido->cliente->email ?? '—' }}
                </p>

                <p class="mb-0">
                    <strong>Dirección:</strong><br>
                    {{ $pedido->cliente->direccion ?? '—' }}
                </p>

            </div>
        </div>
    </div>

    {{-- PROVEEDOR --}}
    <div class="col-md-6 mb-3">
        <div class="card h-100">
            <div class="card-header">
                Proveedor
            </div>

            <div class="card-body">

                <p>
                    <strong>Nombre de empresa:</strong><br>
                    {{ $pedido->proveedor->empresa ?? '—' }}
                </p>

                <p>
                    <strong>Nombre de contacto:</strong><br>
                    {{ $pedido->proveedor->nombre_contacto ?? '—' }}
                </p>

                <p>
                    <strong>Email:</strong><br>
                    {{ $pedido->proveedor->email ?? '—' }}
                </p>

                <p>
                    <strong>Teléfono:</strong><br>
                    {{ $pedido->proveedor->telefono ?? '—' }}
                </p>
                {{-- agrega más campos si tienes --}}
                {{-- teléfono, contacto, etc. --}}

            </div>
        </div>
    </div>

</div>