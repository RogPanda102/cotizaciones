# Restricciones del Sistema de Pedidos

## Introducción

Las restricciones definen qué acciones están permitidas o prohibidas dentro del sistema, en función del estado del pedido, su tipo y las reglas de negocio.

Estas restricciones garantizan consistencia, evitan errores y protegen la integridad de la información.

---

## Restricciones por Estado del Pedido

### Estado: en_proceso

Acciones permitidas:

- Editar pedido
- Agregar, editar o eliminar compras
- Modificar datos generales
- Cambiar tipo (si aplica validación)

---

### Estado: entregado

Acciones permitidas:

- Editar datos limitados del pedido
- Consultar información

Acciones restringidas:

- Modificaciones sensibles (según reglas del sistema)
- Cambios que afecten estructura financiera (compras)

---

### Estado: facturado

Acciones permitidas:

- Consulta del pedido
- Visualización de datos financieros

Acciones restringidas:

- Editar pedido
- Agregar, editar o eliminar compras
- Modificar costos

---

### Estado: pagado (estado final)

Acciones permitidas:

- Solo lectura

Acciones restringidas:

- Cualquier tipo de modificación

---

## Restricciones por Tipo de Pedido

### Pedido tipo servicio

Permitido:

- Manejar datos en `PedidoServicio`

Restringido:

- Tener compras asociadas
- Tener datos de licencia

---

### Pedido tipo licencia

Permitido:

- Manejar datos en `PedidoLicencia`

Restringido:

- Tener compras
- Tener datos de servicio

---

### Pedido tipo mercadeo

Permitido:

- Manejar múltiples compras

Restringido:

- Tener datos en `PedidoServicio`
- Tener datos en `PedidoLicencia`

---

## Restricciones sobre Compras

- Cada compra debe pertenecer a un pedido
- Cada compra debe tener un proveedor válido

---

### Restricción por estado

- No se pueden modificar compras si el pedido está en:
  - entregado
  - facturado
  - pagado

---

## Restricciones sobre Cliente

- No se deben crear clientes duplicados
- El sistema debe validar:
  - email
  - teléfono

---

## Restricciones de Integridad

- Todas las relaciones deben ser válidas
- No deben existir referencias a registros inexistentes
- No se deben guardar datos incompletos

---

## Restricciones de Flujo

- El estado debe seguir el flujo definido
- No se permiten saltos ni retrocesos
- Las transiciones deben ser validadas

---

## Validación de Restricciones

Las restricciones se aplican en:

- `PedidoService`
- FormRequest
- Validaciones adicionales en backend

---

## Impacto en el Sistema

Estas restricciones afectan:

- UI (botones, formularios)
- Backend (validaciones y lógica)
- Base de datos (consistencia)