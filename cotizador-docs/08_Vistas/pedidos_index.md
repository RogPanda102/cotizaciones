# Vista de Listado de Pedidos (Index)

## Introducción

La vista de listado de pedidos (`index`) muestra un resumen general de los pedidos registrados en el sistema.

Está diseñada para ser clara, rápida y enfocada en la consulta.

---

## Objetivo

- Mostrar pedidos de forma resumida
- Permitir navegación hacia detalle
- Facilitar filtrado por contexto (empresa)

---

## Ubicación

- `pedidos/index`

---

## Contexto de Uso

Antes de acceder a esta vista:

- El usuario selecciona una empresa
- Se cargan únicamente los pedidos asociados a esa empresa

---

## Información Mostrada

Cada pedido muestra información básica:

- Identificador
- Dependencia
- Monto con indicador de perdida o ganancia pequeño
- Tipo de pedido/Estado
- Fecha limite entrega
- Dias restantes

---

## Estructura Visual

Generalmente organizada como:

- Tabla
- Lista

---

## Acciones Disponibles

Por cada pedido:

- Ver detalle (`show`)
- Eliminar

---

Acciones globales:

- Crear nuevo pedido

---

## Navegación

Desde esta vista se puede:

- Ir a `create` (nuevo pedido)
- Ir a `show` (detalle)
- Ir a `edit` (si aplica)

---

## Integración con Backend

La vista recibe:

- Colección de pedidos
- Relaciones cargadas (cliente, etc.)
- Datos filtrados por empresa

---

## Consideraciones de UX

- Información clara y resumida
- Evitar saturación
- Acceso rápido a acciones

---

## Posibles Problemas

- Listas muy largas
- Información insuficiente

---

## Buenas Prácticas

- Mostrar solo lo necesario
- Incluir indicadores visuales de estado

---

## Posibles Mejoras Futuras

- Filtros avanzados
- Búsqueda
- Ordenamiento
- Indicadores financieros rápidos

---