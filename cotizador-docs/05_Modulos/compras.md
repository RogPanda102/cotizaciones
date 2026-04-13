# Módulo de Compras

## Introducción

El módulo de compras permite registrar los elementos adquiridos para cumplir pedidos de tipo mercadeo.

Cada compra representa un gasto individual y contribuye directamente al cálculo del costo total del pedido.

---

## Alcance

Este módulo aplica exclusivamente a:

- Pedidos de tipo **mercadeo**

---

## Estructura General

Las compras se gestionan mediante:

- Modelo `Compra`
- Relación directa con `Pedido`
- Relación con `Proveedor`

---

## Relación con Pedido

- Un pedido puede tener múltiples compras
- Cada compra pertenece a un pedido

Esto permite descomponer el costo total en múltiples elementos.

---

## Relación con Proveedor

- Cada compra está asociada a un proveedor
- Permite identificar el origen del gasto

---

## Datos de una Compra

Cada compra incluye información como:

- fecha
- cantidad
- unidad
- descripción
- monto
- proveedor_id

---

## Flujo de Registro de Compras

Las compras se gestionan dentro del flujo del pedido:

### Creación

- Se agregan despues de la creación del pedido
- Se envían como parte de los detalles

---

### Edición

- Se pueden modificar mientras el estado del pedido lo permita
- Se pueden:
  - agregar nuevas compras
  - editar existentes
  - eliminar registros

---

## Restricciones por Estado

Las compras están sujetas a restricciones:

- En estados iniciales → completamente editables
- A partir de `entregado` → bloqueadas
- En `pagado` → solo lectura

---

## Impacto en Costos

Las compras son la base del costo en pedidos de tipo mercadeo.

Cálculo:

costo_total = suma de todos los montos de compras

---

## Integración con PedidoService

El `PedidoService` se encarga de:

- Controlar restricciones por estado

---

## Validaciones

El sistema debe validar:

- Existencia de proveedor
- Datos completos
- Consistencia con el tipo de pedido

Esto se logra haciendo las validaciones en el Form request y en el modelo

---

## Integración con Frontend

Las compras pueden gestionarse mediante:

- Formularios dinámicos
- Secciones repetibles (lista de compras)
- Inputs para cada campo

---

## Consideraciones Importantes

- Las compras no deben existir en otros tipos de pedido
- Todos los montos deben ser válidos
- Debe mantenerse integridad entre pedido y compras

---

## Posibles Problemas

- Compras sin proveedor
- Montos incorrectos
- Edición en estados no permitidos
- Desincronización entre frontend y backend

---

## Buenas Prácticas

- Validar datos antes de guardar
- Mantener lógica en el Service
- Evitar duplicación de lógica en frontend

---

## Posibles Mejoras Futuras

- Importación masiva de compras
- Historial de cambios en compras
- Clasificación de compras
- Reportes por tipo de gasto