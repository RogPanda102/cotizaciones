# Servicios del Sistema (Services)

## Introducción

Los Services encapsulan la lógica de negocio del sistema, actuando como la capa central donde se ejecutan las operaciones críticas.

En este sistema, el principal servicio es `PedidoService`, encargado de manejar la creación, actualización y validación de pedidos.

---

## Objetivo

- Centralizar la lógica de negocio
- Evitar duplicación de código
- Mantener controladores delgados
- Facilitar mantenimiento y escalabilidad

---

## Principio de Diseño

Los Services:

- Contienen lógica de negocio
- No manejan presentación
- No dependen de la capa de UI

---

## Service Principal

### PedidoService

Es el núcleo de la lógica del sistema.

---

## Métodos Principales

### crearPedido(array $data)

Responsable de la creación completa de un pedido.

---

#### Responsabilidades:

- Validar reglas de negocio
- Iniciar transacción
- Crear pedido base
- Crear datos específicos según tipo
- Asociar relaciones
- Guardar compras (si aplica)

---

---

### actualizarPedido(array $data, Pedido $pedido)

Responsable de actualizar un pedido existente.

---

#### Responsabilidades:

- Validar estado del pedido
- Validar transición de estado
- Aplicar restricciones
- Actualizar datos generales
- Actualizar datos específicos
- Manejar compras

---

## Manejo de Transacciones

Todas las operaciones críticas se ejecutan dentro de transacciones.

---

### Comportamiento:

- Si ocurre un error → rollback
- Si todo es correcto → commit

---

## Validaciones de Negocio

El Service valida:

- Estados permitidos
- Transiciones válidas
- Consistencia del tipo de pedido
- Restricciones operativas

---

## Manejo por Tipo de Pedido

El Service adapta su lógica según el tipo:

---

### servicio

- Maneja `PedidoServicio`

---

### licencia

- Maneja `PedidoLicencia`

---

### mercadeo

- Maneja `Compras`

---

## Manejo de Relaciones

El Service se encarga de:

- Asociar cliente
- Asociar proveedor
- Asociar empresa
- Asociar dependencia

---

## Manejo de Estados

- Valida cambios de estado
- Aplica reglas de transición
- Registra historial

---

## Manejo de Compras

- Crear compras
- Actualizar compras
- Eliminar compras (si aplica)
- Validar restricciones por estado

---

## Integración con Otras Capas

### Controllers

- Llaman al Service
- No contienen lógica

---

### Models

- Persistencia de datos
- Relaciones

---

### FormRequest

- Validación inicial
- El Service aplica validaciones adicionales

---

## Manejo de Errores

El Service:

- Lanza excepciones
- Revierte transacciones
- Protege consistencia del sistema

---

## Consideraciones Importantes

- No duplicar lógica en otras capas
- Mantener métodos claros
- Evitar crecimiento descontrolado del Service

---

## Posibles Problemas

- Service demasiado grande
- Lógica difícil de mantener
- Acoplamiento excesivo

---

## Buenas Prácticas

- Separar lógica en métodos internos
- Mantener responsabilidades claras
- Reutilizar lógica cuando sea posible

---

## Posibles Mejoras Futuras

- Dividir en múltiples Services
- Uso de Actions o Use Cases
- Implementación de DTOs

---
