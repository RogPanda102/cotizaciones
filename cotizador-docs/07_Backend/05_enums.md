# Uso de Enums en el Sistema

## Introducción

El sistema utiliza Enums para representar valores constantes y controlados, especialmente en el manejo de estados de pedidos.

Esto permite evitar errores por valores inválidos y facilita la validación del flujo del sistema.

---

## Objetivo

- Definir valores permitidos
- Evitar uso de strings “mágicos”
- Controlar lógica de estados
- Mejorar legibilidad del código

---

## Enum Principal

### EstadoPedido

Representa los estados posibles de un pedido.

---

## Estados Definidos

- en_proceso
- entregado
- facturado
- pagado

---

## Uso en el Sistema

El Enum se utiliza en múltiples partes del sistema:

---

### 1. Modelo Pedido

- Campo `estado`
- Se guarda como valor controlado

---

### 2. PedidoService

- Validación de transiciones
- Control del flujo de estados

---

### 3. Lógica de negocio

- Restricciones por estado
- Bloqueo de edición
- Control de compras

---

## Flujo de Estados

El Enum ayuda a definir el flujo:

en_proceso → entregado → facturado → pagado

---

## Validación de Transiciones

El sistema utiliza el Enum para:

- Verificar estado actual
- Validar estado destino
- Permitir o rechazar cambios

---

## Ventajas del Uso de Enums

- Evita errores tipográficos
- Centraliza definición de valores
- Facilita mantenimiento
- Mejora legibilidad

---

## Integración con Laravel

El Enum puede utilizarse para:

- Casting en modelos
- Validaciones
- Comparaciones seguras

---

## Ejemplo Conceptual

if ($pedido->estado === EstadoPedido::FACTURADO) {
    // aplicar restricción
}

---

## Consideraciones Importantes

- No usar strings directamente en el código
- Centralizar todos los estados en el Enum
- Mantener consistencia con base de datos

---

## Posibles Problemas

- Desincronización entre Enum y base de datos
- Uso incorrecto fuera del Enum
- Falta de validación de transiciones

---

## Buenas Prácticas

- Usar Enum en lugar de strings
- Validar siempre estados
- Mantener lógica centralizada
- Documentar cambios en estados

---

## Posibles Mejoras Futuras

- Métodos dentro del Enum (ej: puedeTransicionar())
- Configuración dinámica de estados
- Soporte para más flujos

---
