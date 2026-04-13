# Comportamiento Dinámico con Alpine.js

## Introducción

El sistema utiliza Alpine.js para implementar comportamiento dinámico en los formularios, especialmente en la creación y edición de pedidos.

Esto permite adaptar la interfaz en tiempo real según las acciones del usuario, sin necesidad de recargar la página.

---

## Objetivo

- Mostrar u ocultar campos según el tipo de pedido
- Mejorar la experiencia de usuario
- Reducir complejidad visual
- Mantener formularios limpios y contextuales

---

## Uso de Alpine.js

Alpine.js se utiliza directamente en las vistas Blade mediante atributos HTML.

---

## Conceptos Utilizados

### 1. x-data

Define el estado del componente.

Ejemplo:

<div x-data="{ tipo: '' }">

---

### 2. x-model

Permite enlazar un valor entre el frontend y el estado interno.

Ejemplo:

<select x-model="tipo">

Esto permite que el valor seleccionado controle el comportamiento de la interfaz.

---

### 3. x-show

Permite mostrar u ocultar elementos dinámicamente.

Ejemplo:

<div x-show="tipo === 'servicio'">

---

## Comportamiento por Tipo de Pedido

El formulario cambia dinámicamente según el tipo seleccionado:

### Tipo: servicio

- Se muestran campos relacionados a `PedidoServicio`
- Se ocultan compras y datos de licencia

---

### Tipo: licencia

- Se muestran campos de licencia
- Se ocultan servicio y compras

---

### Tipo: mercadeo

- Se muestra sección de compras
- Se ocultan servicio y licencia

---

## Flujo de Interacción

1. Usuario selecciona tipo de pedido
2. `x-model` actualiza el estado `tipo`
3. `x-show` evalúa condiciones
4. Se muestran/ocultan secciones del formulario

---

## Integración con Backend

- El valor de `tipo` también se envía en el formulario
- El backend utiliza este valor para:
  - Validaciones
  - Lógica en `PedidoService`

---

## Ventajas del Enfoque

- Interfaz reactiva sin frameworks pesados
- Mejor experiencia de usuario
- Menor complejidad en JavaScript
- Integración directa con Blade

---

## Consideraciones Importantes

- El valor inicial de `tipo` debe sincronizarse con `old()` en Blade
- El frontend debe reflejar correctamente el estado del backend
- No confiar únicamente en lógica frontend (validar en backend)

---

## Posibles Problemas

- Desincronización entre frontend y backend
- Campos ocultos con datos inválidos
- Problemas al editar registros existentes

---

## Buenas Prácticas

- Inicializar correctamente el estado (`x-data`)
- Usar condiciones claras en `x-show`
- Mantener lógica simple en frontend
- Validar siempre en backend

---

## Posibles Mejoras Futuras

- Componentes reutilizables con Alpine
- Validación en tiempo real
- Animaciones para transiciones
- Manejo más avanzado de estados

---