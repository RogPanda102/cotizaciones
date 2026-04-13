# Uso de Modales en el Sistema

## Introducción

El sistema utiliza modales para permitir la creación de entidades relacionadas sin salir del flujo principal, esto se puede ver en la creación de clientes desde el formulario de pedidos.

Para mejorar la experiencia de usuario, es fundamental evitar la navegación innecesaria manteniendo siempre el contexto del usuario, lo que a su vez permite la creación rápida de datos relacionados sin tener que empezar desde cero cada vez.

---

## Flujo General

El modal permite crear un cliente directamente desde el formulario de pedido con el siguiente flujo:

1. Usuario abre el formulario de creación de pedido
2. Detecta que el cliente no existe o desea crear uno nuevo
3. Abre el modal de cliente
4. Ingresa los datos
5. Se envía la información mediante AJAX
6. El cliente se guarda en backend
7. El cliente se selecciona automáticamente en el formulario principal

---

## Apertura del Modal

El modal se activa mediante:

- Botón dentro del formulario
- Evento de usuario

Ejemplo conceptual:

<button type="button" data-bs-toggle="modal" data-bs-target="#clienteModal">
    Nuevo Cliente
</button>

---

## Estructura del Modal

El modal contiene:

- Formulario de cliente
- Campos de entrada (nombre, email, teléfono, etc.)
- Botón de guardar

---

## Envío de Datos (AJAX)

El formulario del modal no recarga la página.

Se utiliza:

- Fetch API o AJAX

Flujo:

1. Captura de datos del formulario
2. Envío a endpoint:

   /clientes

3. Recepción de respuesta

---

## Integración con Backend

El backend:

- Valida los datos
- Verifica duplicados
- Guarda el cliente
- Retorna la información del cliente creado

---

## Actualización del Formulario Principal

Una vez creado el cliente:

- Se agrega al select de clientes
- Se selecciona automáticamente
- Se cierra el modal

---

## Detección de Duplicados (Integración)

El modal trabaja en conjunto con el sistema de detección:

- Puede prevenir creación duplicada
- Puede sugerir cliente existente

---

## Manejo de Errores

- Mostrar errores dentro del modal
- Evitar cierre automático si falla
- Permitir corrección de datos

---

## Experiencia de Usuario (UX)

El uso de modales permite:

- Flujo continuo
- Menos interrupciones
- Mayor eficiencia

---

## Consideraciones Técnicas

- Mantener sincronización con el formulario principal
- Manejar correctamente estados de carga
- Validar siempre en backend

---

## Posibles Problemas

- Fallos en AJAX
- Desincronización del select
- Duplicación de datos si falla validación

---

## Buenas Prácticas

- Mostrar feedback claro al usuario
- Validar antes de enviar
- Manejar errores correctamente
- Mantener lógica limpia y separada

---

## Posibles Mejoras Futuras

- Reutilización de modales para otros módulos
- Validación en tiempo real
- Mejoras visuales y animaciones
- Confirmaciones antes de guardar

---