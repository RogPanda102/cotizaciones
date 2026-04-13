# Cálculo de Resultados

## Introducción

El sistema calcula el resultado financiero de cada pedido con el objetivo de determinar su rentabilidad.

El resultado identifica si un pedido genera:

- Ganancia
- Pérdida
- Equilibrio

---

## Concepto de Resultado

El resultado se define como la diferencia entre:

- Ingresos (precio de venta)
- Costos (**costo real** del pedido)

---

## Implementación

El cálculo se realiza mediante accessors en el modelo `Pedido`:

- `getResultadoAttribute()`
- `getResultadoTipoAttribute()`

---

## Cálculo del Resultado

Fórmula general:

resultado = ingreso - costo_real

---

### Componentes

#### 1. Ingreso

Representa el monto total cobrado al cliente.

- Se obtiene del pedido
- Puede incluir el precio total del servicio, licencia o ventas

---

#### 2. Costo Real

Se obtiene del cálculo definido en:

- `getCostoRealAttribute()`

---

## Tipos de Resultado

El sistema clasifica el resultado en tres categorías:

---

### Ganancia

Condición:

resultado > 0

Interpretación:

- El pedido genera utilidad

---

### Pérdida

Condición:

resultado < 0

Interpretación:

- El pedido genera pérdida económica

---

### Equilibrio

Condición:

resultado = 0

Interpretación:

- El ingreso cubre exactamente el costo

---

## Implementación del Tipo de Resultado

El accessor:

- `getResultadoTipoAttribute()`

Determina el tipo de resultado basándose en el valor calculado.

---

## Comportamiento Dinámico

El resultado:

- Se calcula en tiempo real
- Depende de los datos actuales del pedido
- Se actualiza automáticamente si cambian costos o ingresos

---

## Impacto en el Sistema

El resultado se utiliza para:

- Mostrar rentabilidad en la vista del pedido
- Apoyar decisiones operativas
- Generar reportes financieros

---

## Visualización

En la interfaz:

- Se puede mostrar el valor del resultado
- Se puede indicar el tipo (ganancia/pérdida/equilibrio)
- Se pueden aplicar indicadores visuales (colores, etiquetas)

---

## Consideraciones Importantes

- El resultado depende de la precisión de costos e ingresos
- Errores en datos afectan directamente la rentabilidad
- Debe validarse que ambos valores estén definidos

---

## Posibles Problemas

- Ingresos no definidos
- Costos incorrectos
- Inconsistencia entre tipo de pedido y datos asociados

---

## Buenas Prácticas

- Validar datos antes del cálculo
- Mantener lógica centralizada en accessors
- Evitar duplicar cálculos en otras partes del sistema

---

## Posibles Mejoras Futuras

- Soporte para múltiples ingresos
- Análisis de margen porcentual
- Comparación entre pedidos
- Reportes agregados