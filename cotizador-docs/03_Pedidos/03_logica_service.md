# Lógica de Negocio en PedidoService

## Introducción

La lógica principal del sistema de pedidos se encuentra centralizada en el servicio `PedidoService`.

Este servicio es responsable de coordinar la creación, actualización y validación de pedidos, asegurando que todas las reglas de negocio se cumplan correctamente.

---

## Responsabilidad del Service

`PedidoService` actúa como el núcleo de la lógica del sistema.

Sus principales responsabilidades son:

- Ejecutar operaciones críticas relacionadas con pedidos
- Aplicar reglas de negocio
- Validar estados y restricciones
- Manejar transacciones de base de datos
- Coordinar la creación y actualización de relaciones

---

## Métodos Principales

### crearPedido(array $data)

Responsable de la creación completa de un pedido.

---

### Flujo general:

1. Inicio de transacción
2. Validaciones iniciales
3. Creación del `Pedido`
4. Creación de datos específicos según tipo
5. Asociación de relaciones
6. Confirmación de la transacción

---

### Detalle de responsabilidades

#### 1. Validaciones iniciales

- Verificar que los datos requeridos estén presentes
- Validar consistencia del tipo de pedido

---

#### 2. Creación del Pedido

- Se crea el registro base en la tabla `pedidos`
- Se asignan:
  - cliente_id
  - proveedor_id
  - empresa_id
  - dependencia_id
  - estado inicial (`en_proceso`)

---

#### 3. Manejo por tipo de pedido

Dependiendo del tipo:

---

##### servicio

- Se crea un registro en `pedido_servicios`
- Se asignan los datos correspondientes

---

##### licencia

- Se crea un registro en `pedido_licencias`
- Se manejan fechas y costos

---

##### mercadeo

- Se crean múltiples registros en `compras`
- Cada compra se asocia al pedido

---

#### 4. Asociación de relaciones

- Se asegura que todas las relaciones estén correctamente vinculadas
- Se validan referencias a cliente y proveedor

---

#### 5. Manejo de transacción

- Toda la operación se ejecuta dentro de una transacción
- Si ocurre un error:
  - se hace rollback
- Si todo es correcto:
  - se confirma (commit)

---

## actualizarPedido(array $data, Pedido $pedido)

Responsable de actualizar un pedido existente.

---

### Validaciones clave

#### 1. Estado del pedido

- No se permite actualizar si el pedido está en estado final (`pagado`)

---

#### 2. Transiciones de estado

- Se valida que el cambio de estado sea válido
- Se respeta el flujo definido

---

#### 3. Restricciones por tipo

- Se valida que los datos coincidan con el tipo de pedido
- Se evita inconsistencia entre modelos

---

### Actualización de datos

- Se actualizan campos generales del pedido
- Se actualizan o reemplazan datos específicos:
  - servicio
  - licencia
  - compras

---

### Manejo de compras (mercadeo)

- Se valida si el estado permite modificación
- Se agregan, actualizan o eliminan compras según corresponda

---

## Manejo de Estados

El Service valida:

- Estado actual del pedido
- Estado solicitado
- Reglas de transición

También se encarga de:

- Registrar cambios en historial de estados

---

## Integración con Models

El Service utiliza los modelos para:

- Crear registros
- Definir relaciones
- Acceder a atributos derivados (accessors)

---

## Integración con Validaciones

El Service asume que:

- Los datos ya fueron validados por FormRequest

Sin embargo, aplica validaciones adicionales relacionadas con reglas de negocio.

---

## Manejo de Errores

El sistema debe:

- Detectar inconsistencias
- Lanzar excepciones cuando sea necesario
- Revertir cambios en caso de error

---

## Ventajas del Enfoque

- Centralización de lógica
- Evita duplicación de código
- Facilita mantenimiento
- Mejora la escalabilidad

---

## Consideraciones de Diseño

- El Service debe mantenerse enfocado en lógica de negocio
- No debe contener lógica de presentación
- Debe ser reutilizable desde distintos controladores

---

## Resumen

`PedidoService`:

- Es el núcleo de la lógica del sistema
- Controla la creación y actualización de pedidos
- Garantiza cumplimiento de reglas de negocio
- Mantiene consistencia mediante transacciones

Es uno de los componentes más críticos del sistema.
