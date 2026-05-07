<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Gestión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f6f9;
        }

        header {
            background-color: #2c3e50;
            padding: 15px;
            color: white;
        }

        nav a {
            color: white;
            margin-right: 20px;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .container {
            padding: 20px;
        }

        .alert-success {
            background-color: #d4edda;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }

        table {
            background: white;
            border-collapse: collapse;
            width: 100%;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        table th {
            background-color: #ecf0f1;
        }

        .btn {
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
        }

        .btn-primary {
            background-color: #3498db;
            color: white;
        }

        .btn-danger {
            background-color: #e74c3c;
            color: white;
        }

        .btn-secondary {
            background-color: #7f8c8d;
            color: white;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
    
</head>
<body>

    <header>
        <div style="display: flex; align-items: center; justify-content: space-between;">

            <!-- LOGO -->
            <a href="{{ route('empresas.index') }}" style="display: flex; align-items: center;">
                <img 
                    src="{{ asset('images/logo-header-2.png') }}" 
                    alt="Inicio"
                    style="height: 40px; margin-right: 20px; cursor: pointer; transition: 0.2s;"
                    onmouseover="this.style.transform='scale(1.1)'"
                    onmouseout="this.style.transform='scale(1)'"
                >
            </a>

            <!-- NAV -->
            <nav>
                <a href="{{ route('cotizaciones.index') }}">Cotizaciones</a>
                <a href="{{ route('dependencias.index') }}">Dependencias</a>
                <a href="{{ route('proveedores.index') }}">Proveedores</a>
            </nav>

        </div>
    </header>

<div class="container" >

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="content-header">
        <div class="container-fluid">
            {!! $breadcrumb !!}
        </div>
    </div>

    @yield('content')

</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {!! mostrar_mensaje() !!}
</body>
</html>