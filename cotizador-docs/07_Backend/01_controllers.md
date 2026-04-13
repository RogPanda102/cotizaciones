# Controladores del Sistema

## Introducción

Los controladores son responsables de manejar las solicitudes HTTP, coordinar el flujo de la aplicación y delegar la lógica de negocio a los servicios correspondientes.

En este sistema, los controladores siguen una arquitectura delgada, evitando contener lógica compleja.

---

## Objetivo

- Recibir solicitudes del usuario
- Validar datos mediante FormRequest
- Delegar la lógica al Service
- Retornar respuestas (vistas o redirecciones)

Los controladores NO contienen lógica de negocio.

Su responsabilidad se limita a:

- Orquestación
- Comunicación entre capas

---

## Estructura General

Un controlador típico sigue este flujo:

1. Recibe la request
2. Aplica validación (FormRequest)
3. Llama a un Service
4. Retorna respuesta

---

## Ejemplo Conceptual

public function store(PedidoRequest $request)
{
    $pedido = $this->pedidoService->crearPedido($request->validated());

    return redirect()->route('pedidos.show', $pedido);
}

---

## Controladores Principales

### PedidoController

Responsable de gestionar pedidos.

---

#### Funciones principales:

- index → listar pedidos
- create → mostrar formulario
- store → crear pedido
- show → mostrar detalle
- edit → mostrar formulario de edición
- update → actualizar pedido

---

### ClienteController

Responsable de gestionar clientes.

---

#### Funciones principales:

- store → crear cliente (usado en modal) y normalizar datos
- buscar → detectar clientes existentes

---

### ProveedorController

Responsable de gestionar proveedores.

---

#### Funciones principales:

- CRUD básico
- Gestión independiente

---

## Integración con Services

Los controladores delegan lógica a:

- `PedidoService`

Esto permite:

- Centralizar lógica
- Evitar duplicación
- Mantener controladores limpios

---

## Integración con FormRequest

Antes de llegar al Service:

- Los datos son validados
- Se garantiza estructura correcta

---

## Tipos de Respuesta

Los controladores retornan:

### 1. Vistas

- Para renderizar páginas

---

### 2. Redirecciones

- Después de crear o actualizar datos

---

### 3. JSON

- Para peticiones AJAX (ej: clientes)

---

## Manejo de Errores

- Validaciones automáticas con FormRequest
- Manejo de excepciones en Service
- Respuestas adecuadas al usuario

---

## Consideraciones Importantes

- No duplicar lógica del Service
- No incluir lógica compleja
- Mantener métodos claros y pequeños

---

## Posibles Problemas

- Controladores sobrecargados
- Lógica duplicada
- Falta de delegación

---

## Buenas Prácticas

- Mantener controladores delgados
- Usar inyección de dependencias
- Delegar siempre al Service
- Nombrar métodos claramente

---

## Posibles Mejoras Futuras

- Uso de Resource Controllers más estructurados
- Uso de DTOs para transferencia de datos

---
