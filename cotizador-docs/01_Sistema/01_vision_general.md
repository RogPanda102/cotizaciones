# Visión General del Sistema

## Descripción

Este proyecto es un sistema administrativo tipo **ERP** desarrollado en Laravel, enfocado en la gestión de pedidos institucionales.

El sistema permite controlar de forma estructurada todo el ciclo de vida de un pedido, desde su creación hasta su cierre financiero, incluyendo la gestión de clientes, proveedores, compras y seguimiento de estados.

---

## Objetivo del Sistema

El objetivo principal es centralizar y optimizar la administración de pedidos, permitiendo:

- Registrar pedidos de distintos tipos (servicio, licencia, mercadeo)
- Gestionar clientes y proveedores
- Controlar estados del pedido a lo largo de su ciclo de vida
- Calcular resultados financieros (ganancia, pérdida, equilibrio)
- Dar seguimiento a plazos de entrega y vencimientos
- Mantener consistencia y validación en reglas de negocio

---

## Alcance

El sistema cubre las siguientes áreas:

### 1. Gestión de pedidos
- Creación y edición de pedidos
- Manejo de diferentes tipos de pedido
- Asociación con clientes, proveedores y entidades organizacionales

### 2. Gestión de entidades
- Clientes
- Proveedores
- Empresas
- Dependencias
- Cotizaciones

### 3. Control financiero
- Registro de costos
- Cálculo de resultados
- Evaluación de rentabilidad por pedido

### 4. Seguimiento de estados
- Flujo controlado de estados del pedido
- Restricciones basadas en estado

### 5. Gestión de compras (para pedidos de mercadeo)
- Registro de compras asociadas a pedidos
- Control de proveedores en compras

---

## Tipos de Pedido

El sistema maneja tres tipos principales de pedido:

- **Servicio**
- **Licencia**
- **Mercadeo**

Cada tipo de pedido tiene características y lógica específica, pero comparte una base común a través del modelo `Pedido`.

---

## Enfoque del Sistema

El sistema está diseñado bajo los siguientes principios:

- Separación de responsabilidades (Controllers, Services, Requests)
- Centralización de la lógica de negocio
- Uso de relaciones entre modelos para estructurar la información
- Validación estricta de reglas de negocio
- Escalabilidad para futuras funcionalidades

---

## Estado Actual

El sistema se encuentra en desarrollo activo, con funcionalidades principales ya implementadas como:

- Flujo de creación de pedidos
- Sistema de clientes con detección de duplicados
- Manejo de tipos de pedido
- Control de estados
- Cálculos financieros básicos

Se continúa trabajando en mejoras, optimizaciones y nuevas funcionalidades.
