# Módulo de Clientes

## Introducción

El módulo de clientes permite gestionar la información de las entidades que solicitan pedidos, asegurando integridad de datos y evitando duplicados mediante un sistema de detección automática.

Este módulo está integrado directamente en el flujo de creación de pedidos.

---

## Funcionalidades Principales

- Registro de clientes
- Selección de clientes existentes
- Detección de duplicados
- Creación dinámica desde formulario de pedidos

---

## Estructura General

El sistema maneja clientes mediante:

- Modelo `Cliente`
- CRUD básico
- Integración con pedidos

---

## Relación con Pedidos

- Un cliente puede tener múltiples pedidos
- Cada pedido pertenece a un cliente

---

## Flujo de Selección de Cliente

En el formulario de creación de pedido:

- Se utiliza un campo select (`cliente_id`)
- Permite elegir un cliente existente

---

## Creación de Cliente (Modal)

El sistema permite crear clientes sin salir del flujo de pedidos.

### Características:

- Modal integrado en la vista
- Captura de datos básicos
- Envío mediante AJAX

---

## Flujo de Creación

1. Usuario abre el modal
2. Ingresa datos del cliente
3. Se envía petición a:

   `/clientes`

4. El backend procesa y guarda el cliente
5. El cliente se selecciona automáticamente en el formulario

---

## Detección de Clientes Duplicados

Este es uno de los componentes más importantes del módulo.

---

### Criterios de detección

El sistema verifica si ya existe un cliente con:

- email
- teléfono

---

### Flujo de detección

1. Usuario escribe email o teléfono
2. Se realiza una petición AJAX a:

   `/clientes/buscar`

3. El sistema busca coincidencias

---

### Resultado

#### Si existe un cliente:

- Se muestra una alerta
- Se ofrece seleccionar el cliente existente

---

#### Si no existe:

- Se permite continuar con la creación

---

## Normalización de Datos

Antes de realizar la búsqueda:

- El email se normaliza (formato consistente)
- El teléfono se limpia/formatea

Esto evita falsos negativos en la detección de duplicados.

---

## Prevención de Duplicados en Backend

Además del frontend:

- El backend valida duplicados
- Se evita la creación de registros repetidos

Esto garantiza integridad incluso si falla el frontend.

---

## Integración con Frontend

El sistema utiliza:

- Alpine.js para comportamiento dinámico
- Fetch/AJAX para comunicación con backend

---

## Experiencia de Usuario (UX)

El flujo está diseñado para:

- Evitar interrupciones
- Reducir duplicación de datos
- Facilitar selección de clientes existentes

---

## Consideraciones Importantes

- La detección no debe bloquear la operación
- El usuario debe poder decidir
- La validación backend es obligatoria

---

## Posibles Problemas

- Falsos positivos en detección
- Datos incompletos
- Fallos en llamadas AJAX

---

## Buenas Prácticas

- Validar tanto en frontend como en backend
- Mantener lógica de detección consistente
- Informar claramente al usuario

---

## Posibles Mejoras Futuras

- Búsqueda más avanzada (nombre, empresa)
- Sugerencias automáticas
- Historial de interacciones
- Clasificación de clientes
