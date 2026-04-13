# Arquitectura del Sistema

## Enfoque General

El sistema está desarrollado en Laravel siguiendo una arquitectura orientada a la separación de responsabilidades, con el objetivo de mantener un código limpio, escalable y fácil de mantener.

La lógica del sistema se divide en diferentes capas, cada una con un rol específico dentro del flujo de ejecución.

---

## Capas de la Arquitectura

### 1. Controllers (Orquestación)

Los controladores son responsables de:

- Recibir las solicitudes HTTP
- Delegar la lógica al Service correspondiente
- Retornar respuestas (vistas o redirecciones)

No contienen lógica de negocio compleja.

Su función principal es actuar como punto de entrada al sistema.

---

### 2. Form Requests (Validación)

Las validaciones se manejan a través de clases FormRequest.

Responsabilidades:

- Validar datos de entrada
- Autorizar solicitudes (si aplica)
- Mantener los controladores limpios

Esto permite centralizar las reglas de validación y evitar duplicación de lógica.

---

### 3. Services (Lógica de Negocio)

La lógica principal del sistema se encuentra en los Services, particularmente en:

- `PedidoService`

Responsabilidades:

- Crear pedidos
- Actualizar pedidos
- Aplicar reglas de negocio
- Validar estados
- Manejar transacciones
- Coordinar la creación de relaciones (cliente, proveedor, compras, etc.)

Esta capa es el núcleo del sistema.

---

### 4. Models (Eloquent ORM)

Los modelos representan las entidades del sistema y manejan:

- Relaciones entre entidades
- Accessors y mutators
- Lógica derivada simple

Ejemplo de responsabilidades:

- Definir relaciones (belongsTo, hasMany, hasOne)
- Calcular atributos como costos o resultados

---

### 5. Enums (Control de Estados)

Se utilizan Enums para controlar valores críticos del sistema, especialmente:

- Estados del pedido (`EstadoPedido`)

Responsabilidades:

- Definir estados válidos
- Controlar transiciones
- Evitar valores inválidos

Esto garantiza consistencia en la lógica del sistema.

---

## Flujo de Ejecución

El flujo típico de una operación es el siguiente:

1. El usuario interactúa con la interfaz (formulario)
2. El Controller recibe la solicitud
3. El FormRequest valida los datos
4. El Controller delega la operación al Service
5. El Service ejecuta la lógica de negocio:
   - Validaciones adicionales
   - Manejo de estados
   - Transacciones
   - Creación/actualización de modelos
6. Los Models gestionan relaciones y atributos derivados
7. Se retorna la respuesta al usuario

---

## Separación de Responsabilidades

El sistema sigue los siguientes principios:

- Controllers sin lógica de negocio
- Services como única fuente de lógica compleja
- Models enfocados en datos y relaciones
- Validaciones centralizadas en FormRequest
- Estados controlados mediante Enums

---

## Manejo de Transacciones

Las operaciones críticas (como la creación o actualización de pedidos) se ejecutan dentro de transacciones de base de datos.

Esto garantiza:

- Consistencia de datos
- Integridad del sistema
- Prevención de datos incompletos

---

## Escalabilidad

La arquitectura permite:

- Agregar nuevos tipos de pedido sin afectar la base existente
- Extender la lógica de negocio desde los Services
- Incorporar nuevas reglas sin modificar múltiples capas

---

## Decisiones Clave

- Uso de Services para evitar lógica en Controllers
- Uso de Enums para controlar estados
- Separación de tipos de pedido en diferentes modelos
- Uso de accessors para lógica financiera

Estas decisiones permiten mantener el sistema organizado y preparado para crecimiento futuro.
