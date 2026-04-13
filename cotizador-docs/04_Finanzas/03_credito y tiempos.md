# Crédito y Gestión de Tiempos

## Introducción

El sistema incluye un mecanismo para gestionar tiempos y créditos asociados a los pedidos, permitiendo dar seguimiento a fechas clave y determinar el estado de cumplimiento o vencimiento.

Esta funcionalidad es fundamental para el control operativo y financiero.

---

## Conceptos Clave

### 1. Días de crédito

Representa el número de días otorgados al cliente para realizar el pago después de la facturación.
Aun no tiene funcionalidad definida mas alla del registro
---

### 2. Fecha de vencimiento

Es la fecha límite en la que el pedido debe ser pagado.

Se calcula en función de:

- fecha de facturación
- días de crédito
**sin implementar aun**
---

### 3. Estado de crédito

Define si un pedido está:

- vigente (dentro del plazo)
- vencido (fuera del plazo)
**sin implementar aun**
---

## Implementación

La lógica se implementa mediante accessors en el modelo `Pedido`.

Ejemplos:

- `dias_restantes`
- `dias_restantes_entrega`
- `dias_restantes_licencia`

---

## Cálculo de Días Restantes

### Concepto

Representa cuántos días faltan para una fecha límite.

---

### Casos principales

#### 1. Días restantes de entrega

- Basado en fecha de entrega comprometida
- Aplica a pedidos en proceso o entregados

---

#### 2. Días restantes de licencia

- Basado en fecha de expiración de la licencia
- Aplica a pedidos tipo licencia

---

#### 3. Días restantes de crédito

- Basado en fecha de vencimiento de pago
- Aplica a pedidos facturados
**sin implementar aun**
---

## Cálculo de Fecha de Vencimiento

Fórmula conceptual:

fecha_vencimiento = fecha_facturacion + dias_credito
**sin implementar aun**
---

## Determinación del Estado de Crédito

El sistema evalúa:

- Si la fecha actual es menor o igual a la fecha de vencimiento → vigente
- Si la fecha actual es mayor → vencido
**sin implementar aun**
---

## Comportamiento Dinámico

Los valores:

- Se calculan en tiempo real
- No se almacenan como datos fijos
- Se actualizan automáticamente según la fecha actual

---

## Impacto en el Sistema

La gestión de tiempos afecta:

1. Finanzas
    - Control de pagos pendientes
    - Identificación de cuentas vencidas
2. UI / UX
    - Indicadores visuales (alertas, colores)
    - Información clave en vista de pedido
3. Operación
    - Seguimiento de entregas
    - Control de vencimientos

---

## Consideraciones Importantes

- Las fechas deben estar correctamente definidas
- Los días de crédito deben ser válidos

---

## Posibles Problemas

- Fechas no definidas
- Cálculos incorrectos por datos inconsistentes
- Falta de actualización en estados visuales

---

## Buenas Prácticas

- Centralizar cálculos en accessors
- Validar datos de entrada
- Mostrar información clara al usuario

---

## Posibles Mejoras Futuras

- Notificaciones de vencimiento
- Alertas automáticas
- Reportes de pedidos vencidos
- implementacion apropiada del calculo de dias de credito
