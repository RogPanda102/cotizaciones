@extends('layouts.app')

@section('content')

<div class="container">
    <h2>Editar Pedido</h2>

    <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Estado --}}
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" class="form-control">
                @foreach(\App\Enums\EstadoPedido::cases() as $estado)
                    <option value="{{ $estado->value }}"
                        {{ old('estado', $pedido->estado->value) == $estado->value ? 'selected' : '' }}>
                        {{ $estado->label() }}
                    </option>
                @endforeach
            </select>

            @error('estado')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        {{-- Fecha Facturación --}}
        <div class="mb-3">
            <label for="fecha_facturacion" class="form-label">
                Fecha de facturación
            </label>

            <input type="date"
                   name="fecha_facturacion"
                   class="form-control"
                   value="{{ old('fecha_facturacion', $pedido->fecha_facturacion) }}">

            @error('fecha_facturacion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            Actualizar Pedido
        </button>

        <a href="{{ route('pedidos.index') }}" class="btn btn-secondary">
            Cancelar
        </a>
    </form>
</div>
@endsection