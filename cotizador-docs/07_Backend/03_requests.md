# Validaciones con FormRequest

## Introducción

El sistema utiliza FormRequest de Laravel para validar los datos de entrada antes de que lleguen a los controladores. Las validaciones se aplican a pedidos y compras, que son los componentes principales del flujo de cotizaciones.

---

## Objetivo

- Validar datos de entrada de pedidos y compras
- Proteger la integridad de las relaciones entre entidades
- Separar validaciones de controladores
- Mantener código limpio y organizado

---

## Principio de Diseño

Las validaciones:

- Se ejecutan antes de llegar al controlador
- Detienen la ejecución si fallan
- Retornan errores automáticamente

---

## FormRequests Principales

### StorePedidoRequest

Valida la creación de nuevos pedidos con reglas dinámicas según el tipo.

### UpdatePedidoRequest

Valida actualizaciones de estado y datos de facturación de pedidos.

### StoreCompraRequest

Valida la creación de compras asociadas a pedidos.

### UpdateCompraRequest

Valida actualizaciones de compras existentes.

---

## Flujo de Validación

1. Usuario envía datos (pedido o compra)
2. Laravel intercepta la request
3. Se ejecuta el FormRequest correspondiente
4. Si falla:
   - Se redirige con errores
5. Si pasa:
   - Se envían datos validados al controlador

---

## Validación de Pedidos

### Campos Generales

Validados en todos los tipos de pedidos:

- `cotizacion_id` - Debe existir en tabla cotizaciones
- `dependencia_id` - Debe existir en tabla dependencias
- `empresa_id` - Debe existir en tabla empresas
- `cliente_id` - Debe existir en tabla clientes
- `proveedor_id` - Opcional, debe existir si se proporciona
- `monto_total_aprobado` - Numérico, mínimo 0
- `fecha_adjudicacion` - Formato de fecha válido
- `dias_entrega` - Entero positivo (mínimo 1)
- `tipo_dias` - Solo valores: "naturales" o "habiles"
- `dias_credito` - Entero, mínimo 0
- `tipo` - Requerido, valores: "servicio", "licencia" o "mercadeo"

---

### Validación por Tipo de Pedido

#### Tipo: Licencia

Campos adicionales:

- `nombre_licencia` - Texto requerido, máximo 255 caracteres
- `tipo_licencia` - Texto opcional, máximo 100 caracteres
- `numero_usuarios` - Entero opcional, mínimo 1
- `costo_licencia` - Numérico requerido, mínimo 0
- `costo_renovacion` - Numérico opcional, mínimo 0
- `fecha_inicio` - Fecha requerida
- `fecha_fin` - Fecha requerida, no puede ser anterior a fecha_inicio

#### Tipo: Servicio

Campos adicionales:

- `descripcion_servicio` - Texto requerido
- `alcance` - Texto opcional
- `responsable` - Texto opcional, máximo 255 caracteres
- `entregables` - Texto opcional
- `costo_servicio` - Numérico requerido, mínimo 0
- `observaciones` - Texto opcional
- `fecha_inicio` - Fecha requerida
- `fecha_fin` - Fecha requerida, no puede ser anterior a fecha_inicio

#### Tipo: Mercadeo

Se valida con campos generales. Las compras específicas se validan por separado.

---

## Validación de Compras

### Creación (StoreCompraRequest)

- `pedido_id` - Requerido, debe existir en tabla pedidos
- `proveedor_id` - Requerido, debe existir en tabla proveedores
- `fecha` - Formato de fecha válido
- `cantidad` - Entero requerido, mínimo 1
- `unidad` - Texto requerido, máximo 50 caracteres
- `descripcion` - Texto requerido, máximo 1000 caracteres
- `monto` - Numérico requerido, mínimo 0

### Actualización (UpdateCompraRequest)

Valida los mismos campos que la creación.

---

## Integración con Controladores

Ejemplo de uso:

```php
public function store(StorePedidoRequest $request)
{
    $data = $request->validated();
    // Los datos ya fueron validados
}

public function update(UpdatePedidoRequest $request, $id)
{
    $data = $request->validated();
    // Los datos ya fueron validados
}