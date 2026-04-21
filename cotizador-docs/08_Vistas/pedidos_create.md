# Vista de Creación de Pedido (Create)

## Introducción

La vista de creación de pedidos (`create`) permite registrar nuevos pedidos en el sistema.

Es uno de los componentes más complejos, ya que integra múltiples módulos y comportamiento dinámico.

---

## Objetivo

- Capturar toda la información necesaria para un pedido
- Adaptarse dinámicamente según el tipo
- Permitir creación de entidades relacionadas (cliente)

---

## Ubicación

- `pedidos/create`

---

## Estructura General

El formulario está dividido en secciones:

- Datos generales de empresa y cotizacion (empresa ya queda preseleccionado)
- Cliente
- Proveedor
- Tipo de pedido/Dependencia
- Datos específicos (monto, dias de entrega, dias de credito, tipo de dias para credito)

---

## Datos Generales

Incluye:

- empresa_id
- cotizacion_id

---

## Selección de Cliente

Opciones:

- Seleccionar cliente existente (`cliente_id`)
- Crear nuevo cliente mediante modal

---

### Integración con Modal

- Botón para abrir modal
- Creación vía AJAX
- Selección automática al guardar

---

### Detección de Duplicados

- Búsqueda por email/teléfono
- Llamada a `/clientes/buscar`
- Alerta si existe cliente

---

## Selección de Proveedor

- Select de proveedores existentes
- Relación directa con el pedido

---

## Tipo de Pedido

Campo clave del formulario:

- servicio
- licencia
- mercadeo

---

## Comportamiento Dinámico

Usando Alpine.js:

- `x-model="tipo"`
- `x-show`

---

### Según tipo:

#### servicio

- Campos de `PedidoServicio`

---

#### licencia

- Campos de licencia (fechas, costos)

---

#### mercadeo

- Texto para crear las compras despues de que el pedido haya sido creado

---

## Envío del Formulario

- Método POST
- Ruta: `pedidos.store`

---

## Validación

- FormRequest (`PedidoRequest`)
- Validaciones por tipo
- Manejo automático de errores

---

## Manejo de Errores

- Mensajes por campo
- Uso de `old()` para conservar datos
- Feedback visual

---

## Integración con Backend

Flujo:

1. Usuario envía formulario
2. Controller recibe request
3. Validación (FormRequest)
4. Service procesa (`PedidoService`)
5. Redirección a `index`

---

## Consideraciones de UX

- Formulario dinámico
- Flujo continuo (sin salir de la vista)
- Reducción de pasos

---

## Consideraciones Técnicas

- Inputs correctamente nombrados
- Manejo de arrays (compras)
- Sincronización con backend

---

## Posibles Problemas

- Formularios largos
- Validaciones inconsistentes
- Desincronización frontend/backend

---

## Buenas Prácticas

- Separar secciones claramente
- Validar siempre en backend
- Mantener lógica simple en frontend

---

## Posibles Mejoras Futuras

- Componentización del formulario
- Validación en tiempo real
- Mejoras visuales
- Guardado parcial

---