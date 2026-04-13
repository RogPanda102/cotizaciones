# Flujo de Creación de Pedido

## Introducción

El proceso de creación de un pedido es uno de los flujos más importantes del sistema, ya que involucra múltiples capas:

- Interfaz de usuario (frontend)
- Validación de datos
- Lógica de negocio
- Persistencia en base de datos

Este flujo está diseñado para ser dinámico, validado y consistente.

---

## Flujo General

El proceso completo sigue estos pasos:

1. Selección de empresa
2. Acceso al formulario de creación
3. Captura de datos (formulario dinámico)
4. Gestión de cliente (detección o creación)
5. Envío de formulario
6. Validación (FormRequest)
7. Procesamiento (PedidoService)
8. Persistencia en base de datos
9. Redirección a vista de detalle

---

## 1. Selección de Empresa

Antes de crear un pedido:

- El usuario selecciona una empresa
- El sistema muestra los pedidos asociados a dicha empresa

Esto permite contextualizar el pedido dentro de una organización.

---

## 2. Formulario de Creación

El formulario se encuentra en:

- `pedidos/create`

Características:

- Dinámico
- Basado en el tipo de pedido
- Uso de Alpine.js

---

## 3. Comportamiento Dinámico (Frontend)

Se utiliza Alpine.js para adaptar el formulario en tiempo real.

### Ejemplo:

- `x-model="tipo"`
- `x-show` para mostrar/ocultar campos

Dependiendo del tipo seleccionado:

- servicio → muestra campos de servicio
- licencia → muestra campos de licencia
- mercadeo → muestra sección de compras, pero para mejor interfaz de usuario se opto por dejar un mensaje y manejar las compras desde `compras.blade.php`

---

## 4. Gestión de Cliente (Flujo Dinámico)

Este es un componente clave del sistema.

### Selección de cliente

- Se utiliza un select (`cliente_id`)

---

### Creación de cliente (modal)

- El usuario puede abrir un modal
- Captura datos del cliente sin salir del formulario

---

### Detección de duplicados

Durante la captura:

1. El usuario escribe email o teléfono
2. Se realiza una petición AJAX a:

   `/clientes/buscar`

3. El sistema verifica si existe un cliente

---

### Resultado de la detección

- Si existe:
  - Se muestra una alerta
  - Se permite seleccionar el cliente existente

- Si no existe:
  - Se permite crear uno nuevo mediante:

    `/clientes` (store)

---

### Normalización de datos

Antes de validar:

- email y teléfono se normalizan
- se evitan duplicados por formato

---

## 5. Envío del Formulario

Una vez capturados los datos:

- Se envía la solicitud al controlador correspondiente
- Se incluyen:
  - datos generales del pedido
  - datos específicos según tipo
  - cliente_id (existente o recién creado)

---

## 6. Validación (FormRequest)

El FormRequest:

- valida todos los campos requeridos
- aplica reglas según el tipo de pedido
- asegura consistencia de los datos

---

## 7. Procesamiento (PedidoService)

El controlador delega la lógica a:

- `PedidoService`

---

### Método principal:

- `crearPedido()`

---

### Responsabilidades:

- Iniciar transacción
- Crear el registro de `Pedido`
- Crear el registro específico:
  - `PedidoServicio`
  - `PedidoLicencia`
  - o múltiples `Compras`
- Asociar relaciones:
  - cliente
  - proveedor
  - empresa
  - dependencia
- Validar reglas de negocio
- Confirmar consistencia de datos

---

## 8. Persistencia en Base de Datos

La información se guarda en:

- tabla `pedidos`
- tablas relacionadas según el tipo:
  - `pedido_servicios`
  - `pedido_licencias`
  - `compras`
- tabla `clientes` (si aplica)

Todo dentro de una transacción.

---

## 9. Redirección

Una vez completado el proceso:

- El usuario es redirigido a la vista `show` del pedido
- Puede visualizar:
  - información general
  - detalles
  - estado
  - datos financieros

---

## Consideraciones Importantes

- El flujo depende fuertemente del tipo de pedido
- El cliente puede ser creado en tiempo real
- Se evita duplicación de datos
- Se garantiza integridad mediante transacciones
- El frontend y backend trabajan de forma coordinada

---

## Posibles Puntos Críticos

- Validación incorrecta según tipo
- Duplicación de clientes
- Inconsistencia entre tipo y datos
- Fallos en transacciones

Estos deben ser monitoreados y validados cuidadosamente.

---

## Resumen

El flujo de creación de pedidos:

- Es dinámico y adaptable
- Integra frontend y backend
- Centraliza la lógica en `PedidoService`
- Garantiza consistencia y escalabilidad

Es uno de los procesos más importantes del sistema y base para futuras funcionalidades.
