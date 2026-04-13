# Módulo de Requisiciones, Dependencias y Empresas

## Introducción

Este módulo agrupa las entidades organizacionales del sistema, permitiendo estructurar los pedidos dentro de un contexto administrativo claro.

Estas entidades son fundamentales para la organización, clasificación y trazabilidad de los pedidos.

---

## Entidades Incluidas

El módulo está compuesto por:

- Empresa
- Dependencia
- Requisición

---

## Empresa

### Descripción

Representa la organización principal bajo la cual se registran los pedidos.

---

### Funcionalidades

- Agrupar pedidos
- Permitir segmentación organizacional
- Servir como contexto principal del sistema

---

### Relación

- Una empresa tiene muchos pedidos
- Un pedido pertenece a una empresa

---

### Uso en el Sistema

- Es el primer nivel de organización
- Se selecciona antes de crear un pedido
- Filtra los pedidos visibles

---

## Dependencia

### Descripción

Representa una entidad publica o federativa a la que se le brinda el servicio.

---

### Funcionalidades

- Organizar pedidos dentro de una estructura más específica
- Permitir clasificación interna

---

### Relación

- Una dependencia tiene muchos pedidos
- Un pedido pertenece a una dependencia

---

### Uso en el Sistema

- Se selecciona al crear un pedido
- Complementa la organización de la empresa

---

## Requisición

### Descripción

Representa el origen administrativo o documental de un pedido.

---

### Funcionalidades

- Servir como referencia interna
- Relacionar pedidos con procesos administrativos previos

---

### Relación

- Una requisición tiene muchos pedidos
- Un pedido puede pertenecer a una requisición

---

### Uso en el Sistema

- Puede utilizarse como identificador o referencia
- Ayuda en trazabilidad administrativa

---

## Relación entre Entidades

Estas entidades se relacionan indirectamente a través del pedido:

Empresa → Pedido  
Dependencia → Pedido  
Requisición → Pedido  

El modelo `Pedido` actúa como punto de unión.

---

## Consideraciones Importantes

- Estas entidades deben existir antes de ser asignadas
- No deben romperse las relaciones
- Deben mantenerse consistentes

---

## Validaciones

- Validar existencia de registros
- Validar relaciones correctas en pedidos