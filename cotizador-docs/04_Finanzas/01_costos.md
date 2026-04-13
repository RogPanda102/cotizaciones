# Cálculo de Costos

## Introducción

El sistema implementa un modelo de cálculo de costos basado en el tipo de pedido, permitiendo obtener el costo real de cada operación de forma consistente.

El cálculo de costos es fundamental para determinar la rentabilidad del pedido.

Gran parte de esta logica se encuentra en el modelo de pedido pero en posteriores actualizaciones se busca optimizar su estructura, distribuyendo la información y la lógica de manera más ligera y modular, evitando que el modelo de pedido se vuelva demasiado pesado.

---

## Concepto de Costo Real

El costo real representa el gasto total necesario para cumplir un pedido.

Se calcula dinámicamente a partir de la información asociada al pedido.

---

## Implementación

El cálculo de costos se encuentra implementado mediante un accessor en el modelo `Pedido`:

- `getCostoRealAttribute()`

Este método encapsula la lógica necesaria para determinar el costo según el tipo de pedido.
El uso de este método se encuentra en el tab de finanzas.blade.php
---

## Cálculo por Tipo de Pedido

El costo depende directamente del tipo de pedido.

---

### Pedido tipo mercadeo

Fuente de costo:

- Compras asociadas al pedido

Cálculo:

- Suma de los montos de todas las compras

Ejemplo conceptual:

**costo_total = suma(compra.monto)**

---

### Pedido tipo servicio

Fuente de costo:

- Campo de costo en `PedidoServicio`

Cálculo:

- Valor directo del servicio

Ejemplo conceptual:

costo_total = costo_servicio

---

### Pedido tipo licencia

Fuente de costo:

- Campo de costo en `PedidoLicencia`

Cálculo:

- Valor directo de la licencia

Ejemplo conceptual:

costo_total = costo_licencia

---

## Comportamiento Dinámico

El costo:

- Se calcula automáticamente al consultar el atributo
- No se almacena como valor fijo
- Siempre refleja el estado actual de los datos

---

## Consideraciones Importantes

- El cálculo depende de la integridad de las relaciones
- En pedidos de mercadeo:
  - todas las compras deben ser válidas
- En servicio/licencia:
  - el costo debe estar correctamente definido

---

## Impacto en el Sistema

El costo es utilizado para:

- Calcular resultados (ganancia/pérdida)
- Mostrar información financiera en la vista
- Generar reportes (proximamente)

---

## Posibles Problemas

- Compras incompletas o incorrectas
- Costos no definidos en servicio/licencia
- Inconsistencia entre tipo y datos

---

## Posibles Mejoras Futuras

- Soporte para múltiples costos por servicio
- Historial de cambios de costos
- Costos adicionales (impuestos, comisiones, etc.)