# Vista de Detalle del Pedido (Tabs)

## Introducción

La vista de detalle del pedido (show) permite visualizar toda la información relacionada a un pedido de forma organizada, y debido a la cantidad de datos, se utiliza un sistema de pestañas (tabs) para estructurar dicha información y así mejorar la experiencia de usuario.

---

## Objetivo

El objetivo de los tabs es organizar información compleja, evitar saturación visual, facilitar la navegación dentro del pedido y separar la información por contexto.

---

## Ubicación

- `views/pedidos/show`

---

## Estructura General

La vista se divide en múltiples tabs, cada uno enfocado en un área específica del pedido.

---

## Tabs Principales

### 1. Información General

Contiene:

- Dependencia
- Requisición
- Tipo de dias
- Dias de entrega
- Dias de cradito

---

### 2. Finanzas

Contiene:

- Monto aprobado
- Ingreso
- Resultado (ganancia/pérdida/equilibrio)
- Indicadores financieros

---

### 3. Plazos

Contiene:

- Fechas relevantes
- Días restantes
- Estado del pago
- Estado de crédito (vigente/vencido) **aun sin implementar**

---

### 4. Detalles

Contiene información específica según tipo:

#### servicio

- Datos de `PedidoServicio`

#### licencia

- Datos de `PedidoLicencia`

#### mercadeo

- Resumen de compras

---

### 5. Compras

(Solo para pedidos tipo mercadeo)

Contiene:

- Lista completa de compras
- Detalle por compra
- Formulario de compras

---

### 6. Acciones

Contiene:

- Cambios de estado
- Edición del pedido **aun sin implementar**
- Acciones permitidas según estado

---

### 7. Contacto

Contiene:

- Información del cliente
- Información del proveedor
- Datos de contacto relevantes

---

## Comportamiento Dinámico

- Algunos tabs pueden mostrarse u ocultarse según el tipo de pedido
- Ejemplo:
  - Tab de compras solo visible en tipo mercadeo

---

## Integración con Backend

La vista consume:

- Datos del modelo `Pedido`
- Relaciones (cliente, proveedor, compras, etc.)
- Accessors (costos, resultados, tiempos)

---

## Consideraciones de UX

- Separación clara por contexto
- Navegación intuitiva
- Información relevante agrupada
- Evitar sobrecarga visual

---

## Consideraciones Técnicas

- Uso de componentes de Bootstrap (tabs)
- Carga eficiente de datos
- Uso de Blade para renderizado

---

## Posibles Problemas

- Demasiada información en un solo tab
- Datos no sincronizados
- Problemas de rendimiento si crece demasiado

---

## Buenas Prácticas

- Mantener tabs claros y específicos
- Evitar duplicación de información
- Mostrar solo lo necesario
- Usar indicadores visuales

---

## Posibles Mejoras Futuras

- Carga diferida (lazy loading) por tab
- Mejoras visuales
- Personalización de vista
- Exportación de información

---