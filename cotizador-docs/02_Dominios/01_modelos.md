# Modelos del Sistema

## Introducción

Los modelos representan las entidades principales del sistema y definen la estructura de los datos, así como las relaciones entre ellos.

El sistema está centrado en el modelo `Pedido`, el cual actúa como núcleo y se relaciona con múltiples entidades para construir la lógica completa del ERP.

---

## Modelo Central

### Pedido

Es la entidad principal del sistema.

Representa una operación completa desde su creación hasta su cierre, incluyendo información administrativa, financiera y operativa.

Responsabilidades:

- Centralizar la información general del pedido
- Relacionarse con clientes, proveedores y entidades organizacionales
- Servir como base para los distintos tipos de pedido
- Controlar estados y flujo del pedido
- Exponer información financiera mediante accessors

---

## Modelos Relacionados

### Cliente

Representa a la persona o entidad que solicita el pedido.

Responsabilidades:

- Almacenar datos de contacto
- Relacionarse con múltiples pedidos
- Evitar duplicados mediante validación de email y teléfono

---

### Proveedor

Representa a la entidad que provee productos o servicios para cumplir el pedido.

Responsabilidades:

- Asociarse a pedidos y compras
- Proveer información de contacto
- Participar en el flujo de costos del sistema

---

### Empresa

Representa la organización bajo la cual se agrupan los pedidos.

Responsabilidades:

- Agrupar pedidos
- Permitir segmentación organizacional

---

### Dependencia

Representa una entidad publica o federativa a la que se le brinda el servicio.

Responsabilidades:

- Asociarse a pedidos
- Permitir una organización más detallada

---

### Cotizacion

Representa el origen administrativo del pedido.

Responsabilidades:

- Asociarse a pedidos
- Servir como referencia interna o documental

---

## Modelos por Tipo de Pedido

El sistema maneja distintos tipos de pedido mediante modelos específicos, manteniendo una base común en `Pedido`.

---

### PedidoServicio

Contiene la información específica de pedidos de tipo servicio.

Responsabilidades:

- Almacenar datos propios de servicios
- Manejar costos asociados al servicio

Relación:

- Un `Pedido` tiene un `PedidoServicio`

---

### PedidoLicencia

Contiene la información específica de pedidos de tipo licencia.

Responsabilidades:

- Almacenar datos de licencias
- Manejar fechas y vigencias
- Gestionar costos asociados

Relación:

- Un `Pedido` tiene un `PedidoLicencia`

---

### Compra

Representa compras realizadas para pedidos de tipo mercadeo.

Responsabilidades:

- Registrar productos o conceptos adquiridos
- Asociar proveedores
- Contribuir al cálculo de costos del pedido

Campos típicos:

- fecha
- cantidad
- unidad
- descripción
- monto
- proveedor_id

Relación:

- Un `Pedido` tiene muchas `Compras`

---

## Estructura General

El modelo `Pedido` funciona como contenedor principal, mientras que:

- Los modelos específicos (`PedidoServicio`, `PedidoLicencia`, `Compra`) almacenan información especializada
- Las entidades (`Cliente`, `Proveedor`, etc.) complementan el contexto del pedido

---

## Consideraciones de Diseño

- Se evita sobrecargar el modelo `Pedido` con lógica específica de cada tipo
- Se separa la información según su naturaleza
- Se prioriza la claridad y escalabilidad del sistema

---

## Resumen

El sistema se construye alrededor de `Pedido`, el cual:

- Se relaciona con múltiples entidades
- Se especializa mediante modelos adicionales
- Permite extender el sistema sin romper su estructura base
