# Reglas de Negocio

## Introducción

Las reglas de negocio definen el comportamiento del sistema y establecen restricciones que garantizan la consistencia, integridad y lógica correcta de los datos.

Estas reglas se aplican principalmente en la capa de Services (`PedidoService`) y en algunos casos mediante validaciones adicionales.

---

## Reglas Generales del Pedido

### 1. Inmutabilidad en estados finales

- Un pedido que se encuentra en un estado final no puede ser editado.
- El estado final del sistema es: `pagado`.

Esto garantiza que la información histórica no sea modificada después de cerrarse el ciclo del pedido.

---

### 2. Control de transiciones de estado

Los estados del pedido deben seguir un flujo definido:

en_proceso → entregado → facturado → pagado

Reglas:

- No se puede avanzar a un estado sin haber pasado por el anterior
- No se puede retroceder a estados anteriores
- Las transiciones son validadas en el sistema

---

### 3. Historial de estados

- Cada cambio de estado debe registrarse
- Se debe mantener un historial para auditoría
- No se deben sobrescribir estados anteriores

---

## Reglas sobre Compras (Pedidos de Mercadeo)

### 4. Restricción por estado

- Las compras no pueden ser modificadas cuando el pedido está en estado `facturado` o superior.

Esto evita inconsistencias en los cálculos financieros después de la facturación.

---

### 5. Asociación obligatoria

- Toda compra debe estar asociada a:
  - un pedido
  - un proveedor

---

## Reglas sobre Clientes

### 6. Prevención de duplicados

El sistema debe evitar la creación de clientes duplicados.

Criterios de detección:

- email
- teléfono

---

### 7. Detección automática

Durante la captura de datos:

- El sistema busca coincidencias en tiempo real
- Si encuentra un cliente existente:
  - notifica al usuario
  - permite seleccionar el cliente existente

---

### 8. Normalización de datos

- Los datos de email y teléfono deben normalizarse antes de validarse
- Esto evita duplicados por diferencias de formato

---

## Reglas sobre Tipos de Pedido

### 9. Consistencia entre tipo y datos

- Un pedido de tipo servicio solo puede tener datos en `PedidoServicio`
- Un pedido de tipo licencia solo puede tener datos en `PedidoLicencia`
- Un pedido de tipo mercadeo solo puede tener `Compras`

El sistema debe prevenir combinaciones inválidas.

---

## Reglas Financieras

### 10. Cálculo de costos

El costo del pedido depende del tipo:

- mercadeo → suma de compras
- servicio → costo del servicio
- licencia → costo de la licencia

---

### 11. Cálculo de resultado

El sistema debe calcular:

- ganancia
- pérdida
- equilibrio

Basado en:

- ingresos
- costos

---

## Reglas de Tiempo

### 12. Cálculo de plazos

El sistema debe calcular dinámicamente:

- días restantes de entrega
- días restantes de licencia
- días restantes de crédito

---

### 13. Estado de crédito

El sistema debe determinar si un pedido está:

- vigente
- vencido

Basado en fechas y días de crédito.

---

## Reglas de Integridad

### 14. Uso de transacciones

- Las operaciones críticas deben ejecutarse dentro de transacciones
- Si ocurre un error, se debe revertir toda la operación

---

### 15. Consistencia de datos

- No deben existir registros incompletos
- Las relaciones deben mantenerse válidas en todo momento

---

## Ubicación de las Reglas

Las reglas de negocio se implementan principalmente en:

- `PedidoService`
- Enums (para estados)
- Accessors (para cálculos derivados)

---

## Resumen

Las reglas de negocio permiten:

- Mantener consistencia en el sistema
- Evitar errores humanos
- Controlar el flujo del pedido
- Garantizar integridad de la información

Son el componente más crítico del sistema y deben mantenerse centralizadas y bien definidas.
