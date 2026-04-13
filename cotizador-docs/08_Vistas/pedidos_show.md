# Vista de Detalle del Pedido (Show)

## Introducción

La vista de detalle (`show`) permite visualizar toda la información de un pedido de forma organizada y estructurada.

Debido a la complejidad de los datos, se utiliza un sistema de pestañas (tabs) para separar la información por contexto.

---

## Objetivo

- Mostrar información completa del pedido
- Organizar datos complejos
- Permitir acciones según estado
- Facilitar análisis del pedido

---

## Ubicación

- `pedidos/show`

---

## Estructura General

La vista general del pedido incluye informacion sobre el pedido_id, estado y la fecha de entrega.

Tambien cuenta con un historial de estados en el que se guarda y se muestra la fecha en la que cambio el estado de dicho pedido.

La informacion detallada se organiza mediante tabs:

- Información general
- Contacto
- Finanzas
- Plazos
- Detalles/Compras (depende del tipo de pedido)
- Acciones

---

## Tab: Información General

Contiene:

- Dependencia
- Requisición
- Dias registrados para la entrega/tipo de dias para credito
- Dias registrados de credito


---

## Tab: Contacto

Contiene:

- Información del cliente
. Informacion del proveedor
- Datos de contacto

---

## Tab: Finanzas

Contiene:

- Monto aprobado
- Costo real (`costo_real`)
- Resultado (`resultado`)
- Tipo de resultado (ganancia/pérdida/equilibrio)

---

## Tab: Plazos

Contiene:

- Fechas relevantes
- Estado de la facturacion
- Informacion sobre la puntualidad del pago

---

## Tab: Detalles

Contenido dinámico según tipo:

### servicio

- Datos de `PedidoServicio`

---

### licencia

- Datos de `PedidoLicencia`

---

### mercadeo

- Resumen de compras

---

## Tab: Compras

(Solo visible en tipo mercadeo)

Contiene:

- Lista de compras
- Detalles:
  - cantidad
  - descripción
  - monto
  - proveedor

---

## Tab: Acciones

Permite:

- Cambiar estado del pedido
- Editar pedido (si está permitido) **aun sin implementar**
- Insertar fecha de facturación (si aplica)

---

## Comportamiento Dinámico

- Tabs visibles según tipo
- Acciones disponibles según estado
- Información adaptada al contexto

---

## Integración con Backend

La vista utiliza:

- Modelo `Pedido`
- Relaciones:
  - cliente
  - proveedor
  - compras
  - servicio/licencia
- Accessors:
  - costo_real
  - resultado
  - días restantes

---

## Consideraciones de UX

- Separación clara por secciones
- Navegación sencilla
- Información relevante agrupada

---

## Consideraciones Técnicas

- Uso de tabs (Bootstrap)
- Renderizado con Blade
- Uso de relaciones cargadas

---

## Restricciones por Estado

- Si el pedido está en estado final:
  - no se muestran acciones editables
- Si el pedido está en estado entregado:
  - no se pueden agregar o editar las compras
- Acciones limitadas según estado

---

## Posibles Problemas

- Demasiada información en una sola vista
- Problemas de rendimiento
- Datos incompletos

---

## Buenas Prácticas

- Mostrar solo información relevante
- Usar indicadores visuales
- Mantener consistencia entre tabs

---

## Posibles Mejoras Futuras

- Lazy loading por tab
- Exportación a PDF
- Mejoras visuales

---