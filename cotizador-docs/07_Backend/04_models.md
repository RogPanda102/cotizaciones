# Modelos del Sistema

## Introducción

Los modelos representan las entidades principales del sistema y se encargan de interactuar con la base de datos mediante Eloquent ORM de Laravel.

Definen:

- Estructura de datos
- Relaciones entre entidades
- Accessors (atributos calculados)

---

## Objetivo

- Representar entidades del dominio
- Gestionar persistencia de datos
- Definir relaciones entre modelos
- Encapsular lógica simple relacionada a datos

---

## Modelos Principales

El sistema está compuesto por los siguientes modelos:

- Pedido
- Cliente
- Proveedor
- Empresa
- Dependencia
- Cotizacion
- Compra
- PedidoServicio
- PedidoLicencia
- PedidoEstado

---

## Modelo Central: Pedido

### Descripción

Es el modelo principal del sistema.

Representa una operación completa dentro del ERP.

---

### Relaciones

#### belongsTo

- cliente
- proveedor
- empresa
- dependencia
- cotizacion

---

#### hasMany

- compras
- historialEstados

---

#### hasOne

- servicio (`PedidoServicio`)
- licencia (`PedidoLicencia`)

---

## Modelos Relacionados

### Cliente

- Representa quien solicita el pedido
- Relación: hasMany pedidos

---

### Proveedor

- Representa quien suministra recursos
- Relación:
  - hasMany pedidos
  - hasMany compras

---

### Compra

- Representa un gasto individual
- Pertenece a:
  - pedido
  - proveedor

---

### PedidoServicio

- Datos específicos de pedidos tipo servicio
- Relación: belongsTo pedido

---

### PedidoLicencia

- Datos específicos de pedidos tipo licencia
- Relación: belongsTo pedido

---

### Empresa

- Agrupa pedidos
- Relación: hasMany pedidos

---

### Dependencia

- Agrupa organizaciones de clientes
- Relación: hasMany pedidos

---

### Cotizacion

- Referencia administrativa
- Relación: hasMany pedidos

---

## Accessors (Atributos Calculados)

El modelo `Pedido` incluye lógica mediante accessors.

---

### Costo Real

- `getCostoRealAttribute()`
- Calcula costo según tipo

---

### Resultado

- `getResultadoAttribute()`
- Calcula ganancia o pérdida

---

### Tipo de Resultado

- `getResultadoTipoAttribute()`
- Clasifica resultado

---

### Días Restantes

- `dias_restantes`
- `dias_restantes_entrega`
- `dias_restantes_licencia`

---

## Responsabilidades de los Modelos

- Definir relaciones
- Encapsular lógica simple
- Exponer atributos derivados

---

## Lo que NO deben hacer

- No deben contener lógica compleja de negocio
- No deben manejar procesos completos
- No deben reemplazar Services

---

## Integración con el Sistema

Los modelos son utilizados por:

- Services (lógica de negocio)
- Controllers (flujo)
- Vistas (renderizado)

---

## Consideraciones Importantes

- Mantener relaciones claras
- Evitar lógica excesiva
- Usar accessors para cálculos simples

---

## Posibles Problemas

- Modelos sobrecargados
- Lógica duplicada con Services
- Relaciones mal definidas

---

## Buenas Prácticas

- Mantener modelos limpios
- Definir correctamente relaciones
- Usar accessors para cálculos derivados
- Evitar lógica pesada

---

## Posibles Mejoras Futuras

- Uso de casts personalizados
- Separación en Value Objects
- Mejora de relaciones complejas

---