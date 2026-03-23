@extends('layouts.app')

@section('content')
<h2>Selecciona una empresa</h2>

<div style="display: flex; gap: 30px; justify-content: center; margin-top: 40px;">

    @foreach($empresas as $empresa)
        <a href="{{ route('empresas.pedidos', $empresa->id) }}" style="text-decoration: none; color: inherit;">
            
            <div style="
                width: 180px;
                height: 180px;
                border: 1px solid #ccc;
                border-radius: 12px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                transition: 0.2s;
                cursor: pointer;
            "
            onmouseover="this.style.transform='scale(1.05)'"
            onmouseout="this.style.transform='scale(1)'"
            >

                <!-- Imagen -->
                <img src="{{ $empresa->logo ? asset('images/empresas/' . $empresa->logo) : asset('images/default.png') }}" 
                     alt="{{ $empresa->nombre }}" 
                     style="width: 80px; height: 80px; object-fit: contain; margin-bottom: 10px;">

                <!-- Nombre -->
                <strong>{{ $empresa->nombre }}</strong>

            </div>
        </a>
    @endforeach

</div>
@endsection