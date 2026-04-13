# Decisiones Técnicas del Sistema

## Introducción

Este documento describe las principales decisiones técnicas tomadas durante el desarrollo del sistema ERP, así como las razones detrás de cada una.

---

## Arquitectura Basada en Services

### Decisión

Separar la lógica de negocio en Services (`PedidoService`).

Razón:
- Evitar lógica en controladores
- Facilitar mantenimiento
- Permitir reutilización de lógica
- Mejorar escalabilidad

Impacto:
- Código más limpio
- Mejor separación de responsabilidades
- Mayor control sobre reglas de negocio

---

## Uso de FormRequest para Validaciones

### Decisión

Utilizar FormRequest para validar datos de entrada.

Razón:
- Centralizar validaciones
- Evitar validaciones en controladores
- Aprovechar herramientas de Laravel

Impacto:
- Código más limpio
- Validaciones consistentes
- Menor riesgo de errores

---

## Uso de Enums para Estados

### Decisión

Definir estados de pedidos mediante Enum (`EstadoPedido`).

Razón:
- Evitar errores con strings
- Controlar flujo de estados
- Mejorar legibilidad

Impacto:
- Menos errores
- Código más robusto
- Flujo controlado

---

## Separación por Tipo de Pedido

### Decisión

Dividir la lógica en:

- Pedido (general)
- PedidoServicio
- PedidoLicencia
- Compras (mercadeo)

Razón:
- Evitar tablas con demasiados campos opcionales
- Mantener estructura clara
- Facilitar mantenimiento

Impacto:
- Modelo más limpio
- Mejor organización de datos
- Mayor flexibilidad

---

## Uso de Accessors para Lógica Financiera

### Decisión

Calcular valores como:

- costo_real
- resultado
- días_restantes

mediante accessors en el modelo `Pedido`.

Razón:
- Evitar almacenamiento redundante
- Mantener datos dinámicos
- Centralizar lógica simple

Impacto:
- Datos siempre actualizados
- Menor duplicación
- Código más limpio

---

## Uso de Alpine.js en Frontend

### Decisión

Utilizar Alpine.js para comportamiento dinámico.

Razón:
- Ligero y fácil de integrar con Blade
- Evitar frameworks complejos
- Resolver necesidades específicas

Impacto:
- Formularios dinámicos
- Mejor UX
- Menor complejidad

---

## Uso de Modales para Creación de Entidades

### Decisión

Permitir creación de clientes mediante modales con AJAX.

Razón:
- Evitar salir del flujo
- Mejorar experiencia de usuario
- Reducir fricción

Impacto:
- Flujo más rápido
- Menor interrupción
- Mejor usabilidad

---

## Detección de Duplicados en Clientes

### Decisión

Implementar detección por email/teléfono.

Razón:
- Evitar duplicación de datos
- Mantener integridad

Impacto:
- Base de datos más limpia
- Mejor calidad de información

---

## Uso de Transacciones en Services

### Decisión

Encapsular operaciones críticas en transacciones.

Razón:
- Evitar inconsistencias
- Garantizar integridad de datos

Impacto:
- Mayor seguridad en operaciones
- Reducción de errores críticos

---

## Uso de Tabs en Vista Show

### Decisión

Organizar información en tabs.

Razón:
- Manejar gran cantidad de datos
- Mejorar navegación

Impacto:
- Mejor UX
- Información más clara

---

## Diseño de Restricciones por Estado

### Decisión

Restringir acciones según estado del pedido.

Razón:
- Evitar inconsistencias operativas
- Controlar flujo del sistema

Impacto:
- Mayor control
- Menor riesgo de errores

---

## Consideraciones Generales

Durante el desarrollo se priorizó:

- Claridad sobre complejidad
- Separación de responsabilidades
- Escalabilidad futura
- Integridad de datos

---

## Posibles Mejoras Futuras

- Modularización de Services
- Uso de DTOs

---

## Resumen

Las decisiones técnicas del sistema:

- Buscan mantener código limpio y mantenible
- Priorizan integridad y control
- Permiten escalabilidad futura

Este documento sirve como referencia para futuras mejoras y mantenimiento.
