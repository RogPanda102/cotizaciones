# Historial de Estados del Pedido

## Introducción

El sistema mantiene un historial de estados para cada pedido, permitiendo registrar todos los cambios a lo largo de su ciclo de vida.

Este historial es fundamental para:

- Auditoría
- Trazabilidad
- Seguimiento operativo

---

## Objetivo

El historial de estados permite:

- Saber en qué momento cambió un pedido de estado
- Identificar la secuencia de eventos
- Evitar pérdida de información histórica

---

## Comportamiento General

Cada vez que un pedido cambia de estado:

- Se registra un nuevo evento en el historial
- No se sobrescribe el estado anterior
- Se mantiene un registro cronológico

---

## Estructura Conceptual

Cada registro de historial contiene:

- pedido_id
- estado
- fecha del cambio

---

## Flujo de Registro

Cuando ocurre una transición de estado:

1. Se valida la transición (en `PedidoService`)
2. Se actualiza el estado actual del pedido
3. Se crea un nuevo registro en el historial

---

## Relación con Pedido

- Un `Pedido` tiene muchos registros de historial de estado
- Cada registro pertenece a un único pedido

---

## Uso del Historial

El historial puede utilizarse para:

### 1. Visualización

- Mostrar línea de tiempo del pedido
- Ver evolución de estados en la UI

---

### 2. Auditoría

- Revisar cambios realizados
- Detectar inconsistencias o comportamientos inusuales

---

### 3. Reportes

- Medir tiempos entre estados
- Analizar eficiencia operativa

---

## Consideraciones de Diseño

- El historial es inmutable (no se edita)
- Se agrega información, no se modifica
- Debe ser confiable y consistente

---

## Posibles Extensiones

A futuro y solo si se requiere, se puede agregar:

- Usuario responsable del cambio
- Comentarios por cambio de estado
- Motivo del cambio
- Registro de cambios automáticos vs manuales

---

## Resumen

El historial de estados:

- Registra todos los cambios de estado
- Es inmutable
- Permite auditoría y análisis
- Complementa el flujo de estados

Es un componente clave para la transparencia y control del sistema.
