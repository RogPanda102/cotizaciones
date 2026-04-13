# Módulo de Proveedores

## Introducción

El módulo de proveedores permite gestionar las entidades que suministran productos o servicios necesarios para cumplir los pedidos.

Es un componente clave en la estructura financiera del sistema, ya que influye directamente en los costos.

---

## Funcionalidades Principales

- Registro de proveedores
- Asociación a pedidos
- Asociación a compras

---

## Estructura General

El sistema maneja proveedores mediante:

- Modelo `Proveedor`
- CRUD independiente

---

## Relación con Pedidos

- Un proveedor puede estar asociado a múltiples pedidos
- Cada pedido puede tener un proveedor principal

Esto permite identificar quién participa en la ejecución del pedido.

---

## Relación con Compras

- Un proveedor puede estar asociado a múltiples compras
- Cada compra pertenece a un proveedor

Esto permite:

- Registrar el origen de cada gasto
- Identificar proveedores por operación

---

## Uso en Pedidos

El proveedor se asigna en:

- Creación del pedido
- Edición del pedido (aun sin integrar)

---

## Uso en Compras (Mercadeo)

En pedidos tipo mercadeo:

- Cada compra incluye un `proveedor_id`
- Permite múltiples proveedores en un mismo pedido

---

## Impacto en el Sistema

Los proveedores afectan:

### 1. Costos

- Cada compra tiene un proveedor asociado
- Influye en el cálculo de costo total

---

### 2. Trazabilidad

- Permite identificar quién suministró cada recurso
- Facilita auditoría de gastos

---

### 3. Reportes

- Análisis por proveedor
- Identificación de proveedores más utilizados

---

## Consideraciones Importantes

- Un proveedor debe existir antes de ser asignado
- Las relaciones deben mantenerse consistentes
- No deben existir compras sin proveedor

---

## Validaciones

- Validación de existencia de proveedor
- Validación en relaciones con compras y pedidos

---

## Diferencia con Clientes

| Aspecto     | Cliente                  | Proveedor               |
|------------|--------------------------|------------------------|
| Rol        | Solicita el pedido       | Suministra recursos    |
| Detección  | Sí (email/teléfono)      | No implementada        |
| Flujo UI   | Dinámico con modal       | CRUD tradicional       |

---

## Posibles Problemas

- Proveedores duplicados (sin control actual)
- Datos incompletos
- Relaciones mal definidas

---

## Buenas Prácticas

- Validar datos antes de guardar
- Mantener consistencia en relaciones
- Evitar duplicados manualmente

---

## Posibles Mejoras Futuras

- Detección de duplicados similar a clientes
- Clasificación de proveedores
- Historial de compras por proveedor
- Evaluación de desempeño