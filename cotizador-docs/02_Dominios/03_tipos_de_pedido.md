# Tipos de Pedido

## Introducción

El sistema está diseñado para manejar distintos tipos de pedidos bajo una estructura común, permitiendo especializar la lógica y los datos según la naturaleza de cada operación.

Todos los pedidos comparten una base común a través del modelo `Pedido`, pero delegan su información específica a modelos especializados.

---

## Tipos de Pedido Disponibles

El sistema maneja tres tipos principales de pedido:

- servicio
- licencia
- mercadeo

Cada tipo define cómo se almacenan los datos, cómo se calculan los costos y cómo se comporta el pedido dentro del sistema.

---

## Estructura General

El modelo `Pedido` almacena la información general:

- cliente
- proveedor
- empresa
- dependencia
- estado
- datos administrativos

La información específica se delega según el tipo de pedido.

---

## Pedido de Tipo Servicio

### Modelo asociado

- `PedidoServicio`

### Características

- Contiene datos específicos relacionados a servicios
- Maneja un costo directo asociado al servicio

### Relación

- Un `Pedido` tiene un `PedidoServicio`

### Lógica

- El costo del pedido proviene directamente del campo de servicio
- No utiliza compras

---

## Pedido de Tipo Licencia

### Modelo asociado

- `PedidoLicencia`

### Características

- Maneja información de licencias
- Incluye fechas de vigencia
- Puede involucrar control de expiración

### Relación

- Un `Pedido` tiene un `PedidoLicencia`

### Lógica

- El costo se obtiene del valor de la licencia
- Se utilizan cálculos relacionados con tiempo (vigencia)

---

## Pedido de Tipo Mercadeo

### Modelo asociado

- `Compra`

### Características

- Se basa en múltiples compras
- Cada compra representa un elemento adquirido

### Relación

- Un `Pedido` tiene muchas `Compras`

### Lógica

- El costo total se calcula como la suma de todas las compras
- Permite múltiples proveedores por pedido (a través de compras)

---

## Comparación de Tipos

| Tipo       | Modelo asociado     | Relación     | Fuente de costo        |
|-----------|--------------------|-------------|----------------------|
| servicio  | PedidoServicio     | hasOne      | costo_servicio       |
| licencia  | PedidoLicencia     | hasOne      | costo_licencia       |
| mercadeo  | Compra             | hasMany     | suma de compras      |

---

## Flujo de Creación

Durante la creación de un pedido:

1. Se selecciona el tipo de pedido
2. El formulario se adapta dinámicamente (frontend)
3. Se capturan los datos específicos
4. Se crea el `Pedido`
5. Se crea el registro relacionado según el tipo:
   - servicio → `PedidoServicio`
   - licencia → `PedidoLicencia`
   - mercadeo → compras

---

## Impacto en el Sistema

La implementación de tipos de pedido afecta múltiples áreas:

### 1. Frontend
- Formularios dinámicos con Alpine.js
- Campos condicionales según tipo

### 2. Backend
- Lógica condicional en `PedidoService`
- Validaciones específicas por tipo

### 3. Finanzas
- Diferente cálculo de costos
- Diferente origen de datos financieros

### 4. Relaciones
- Diferente estructura de datos según el tipo

---

## Ventajas del Enfoque

- Evita sobrecargar el modelo `Pedido`
- Permite escalar agregando nuevos tipos
- Mantiene separación clara de responsabilidades
- Facilita mantenimiento y comprensión del sistema

---

## Consideraciones de Diseño

- Cada tipo debe manejar únicamente su lógica específica
- El modelo `Pedido` debe mantenerse lo más genérico posible
- Las validaciones deben adaptarse al tipo seleccionado
- El sistema debe prevenir inconsistencias entre tipo y datos asociados

---

## Resumen

El sistema utiliza un enfoque basado en tipos para:

- Adaptarse a diferentes necesidades de negocio
- Mantener una estructura limpia y escalable
- Separar lógica general de lógica específica

El modelo `Pedido` actúa como base común, mientras que cada tipo define su comportamiento particular.
