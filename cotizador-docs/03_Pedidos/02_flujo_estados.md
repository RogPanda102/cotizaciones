# Flujo de Estados del Pedido

## Introducción

El sistema implementa un flujo controlado de estados para los pedidos, con el objetivo de garantizar consistencia en el proceso operativo y financiero.

Los estados representan la etapa en la que se encuentra un pedido dentro de su ciclo de vida.

---

## Estados Definidos

El sistema utiliza los siguientes estados:

- en_proceso
- entregado
- facturado
- pagado

Estos estados están definidos mediante un Enum (`EstadoPedido`), lo que garantiza que solo se puedan usar valores válidos.

---

## Flujo de Estados

El flujo permitido es estrictamente secuencial:

en_proceso → entregado → facturado → pagado

---

## Reglas de Transición

### 1. Secuencia obligatoria

- No se puede avanzar a un estado sin haber pasado por el anterior
- Ejemplo:
  - No se puede pasar de `en_proceso` directamente a `facturado`

---

### 2. No retroceso

- No está permitido regresar a un estado anterior
- Ejemplo:
  - No se puede pasar de `facturado` a `entregado`

---

### 3. Estado final

- El estado `pagado` es considerado final
- Un pedido en este estado no puede modificarse

---

## Validación de Estados

Las transiciones de estado son validadas en:

- `PedidoService`
- Enum `EstadoPedido` (si aplica lógica adicional)

El sistema debe rechazar cualquier transición inválida.

---

## Historial de Estados

Cada cambio de estado genera un registro histórico.

### Objetivos:

- Auditoría
- Trazabilidad
- Seguimiento del pedido

---

### Características:

- No se sobrescriben estados anteriores
- Se mantiene un registro cronológico
- Cada cambio queda registrado de forma persistente

---

## Impacto en el Sistema

Los estados afectan múltiples áreas:

---

### 1. Edición de pedidos

- Si el pedido está en estado final (`pagado`), no se permite edición

---

### 2. Compras (mercadeo)

- A partir de `facturado`, las compras quedan bloqueadas

---

### 3. Finanzas

- Los estados determinan cuándo un pedido debe considerarse cerrado
- Impactan reportes financieros

---

### 4. UI / UX

- Los estados controlan:
  - botones disponibles
  - acciones permitidas
  - visualización del flujo

---

## Implementación Técnica

### Enum `EstadoPedido`

Define:

- Estados válidos
- (Opcional) lógica de transición

---

### Validación en Service

El `PedidoService`:

- Verifica el estado actual
- Evalúa el estado destino
- Permite o rechaza la transición

---

### Posible estructura de validación

- Estado actual
- Estado solicitado
- Regla de transición válida

---

## Consideraciones de Diseño

- El flujo es lineal y no permite bifurcaciones
- Se prioriza la simplicidad y control
- Las restricciones evitan inconsistencias operativas y financieras

---

## Resumen

El flujo de estados:

- Controla el ciclo de vida del pedido
- Garantiza consistencia del sistema
- Evita modificaciones indebidas
- Permite trazabilidad completa

Es un componente crítico del sistema y debe mantenerse estrictamente controlado.
