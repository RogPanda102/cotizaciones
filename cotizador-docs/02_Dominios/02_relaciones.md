# Relaciones entre Modelos

## Introducción

Las relaciones entre modelos definen cómo se conecta la información dentro del sistema.

El modelo `Pedido` actúa como eje central, relacionándose con múltiples entidades para construir una estructura completa y coherente.

---

## Relaciones del Modelo Pedido

El modelo `Pedido` contiene las siguientes relaciones:

### Relaciones belongsTo

Un pedido pertenece a:

- requisicion
- dependencia
- empresa
- cliente
- proveedor

Esto significa que cada pedido está asociado a una única instancia de estas entidades.

Ejemplo conceptual:

Un pedido:
- pertenece a una empresa
- pertenece a una dependencia
- pertenece a un cliente
- pertenece a un proveedor
- puede tener una requisición asociada

---

### Relaciones hasMany

Un pedido puede tener múltiples:

- compras

Esto aplica principalmente para pedidos de tipo **mercadeo**, donde cada compra representa un elemento adquirido para cumplir el pedido.

---

### Relaciones hasOne

Un pedido puede tener:

- un servicio (`PedidoServicio`)
- una licencia (`PedidoLicencia`)

Estas relaciones dependen del tipo de pedido.

---

## Relaciones por Tipo de Pedido

### Pedido → PedidoServicio

- Tipo: uno a uno (hasOne)
- Aplica cuando el pedido es de tipo **servicio**

---

### Pedido → PedidoLicencia

- Tipo: uno a uno (hasOne)
- Aplica cuando el pedido es de tipo **licencia**

---

### Pedido → Compras

- Tipo: uno a muchos (hasMany)
- Aplica cuando el pedido es de tipo **mercadeo**

---

## Relaciones de Compra

El modelo `Compra` tiene las siguientes relaciones:

- pertenece a un pedido
- pertenece a un proveedor

Esto permite:

- asociar costos directamente al pedido
- identificar qué proveedor participó en cada compra

---

## Relaciones de Cliente

El modelo `Cliente`:

- tiene muchos pedidos

Esto permite:

- consultar historial de pedidos por cliente
- reutilizar información sin duplicación

---

## Relaciones de Proveedor

El modelo `Proveedor`:

- tiene muchos pedidos
- tiene muchas compras

Esto permite:

- identificar participación en pedidos completos
- rastrear compras específicas

---

## Relaciones Organizacionales

### Empresa

- tiene muchos pedidos

---

### Dependencia

- tiene muchos pedidos

---

### Requisicion

- tiene muchos pedidos

---

## Flujo de Información

La estructura relacional permite el siguiente flujo:

- Un pedido se crea dentro de una empresa y dependencia
- Se asocia a un cliente y proveedor
- Dependiendo del tipo:
  - se crea un registro en servicio o licencia
  - o múltiples compras en caso de mercadeo
- Las compras alimentan el cálculo financiero
- El cliente y proveedor permiten trazabilidad

---

## Consideraciones de Diseño

- Se centraliza la lógica en `Pedido`
- Se evita duplicar información en modelos secundarios
- Las relaciones permiten extender el sistema sin romper la estructura existente
- Cada modelo tiene una responsabilidad clara

---

## Resumen

Las relaciones del sistema permiten:

- Conectar entidades de negocio de forma clara
- Mantener integridad de datos
- Facilitar cálculos y consultas complejas
- Escalar el sistema de forma ordenada

El modelo `Pedido` funciona como el nodo central que articula toda la información.
