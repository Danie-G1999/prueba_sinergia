# Consultas SQL — Tabla productos

# Tabla de Productos

| Id_fabricante | Id_producto | Descripción        | Precio | Existencia |
|---------------|-------------|--------------------|--------|------------|
| Aci           | 41001       | Aguja              | 58     | 227        |
| Aci           | 41002       | Micropore          | 80     | 150        |
| Aci           | 41003       | Gasa               | 112    | 80         |
| Aci           | 41004       | Equipo macrogoteo  | 110    | 50         |
| Bic           | 41003       | Curas              | 120    | 20         |
| Inc           | 41089       | Canaleta           | 500    | 30         |
| Qsa           | Xk47        | Compresa           | 150    | 200        |
| Bic           | Xk47        | Compresa           | 200    | 200        |

## Lista de todos los productos con precio y precio con IVA (10%)

```sql
SELECT 
    id_fabricante,
    id_producto,
    descripcion,
    precio,
    precio * 1.10 AS precio_con_iva
FROM productos;
```

## Cantidad total de existencias por producto

```sql
SELECT 
    id_producto,
    descripcion,
    SUM(existencias) AS total_existencias
FROM productos
GROUP BY id_producto, descripcion;
```
## Promedio de precio por fabricante

```sql
SELECT 
    id_fabricante,
    AVG(precio) AS promedio_precio
FROM productos
GROUP BY id_fabricante;
```
## Producto con mayor precio

```sql
SELECT 
    id_fabricante,
    id_producto,
    descripcion,
    precio
FROM productos
ORDER BY precio DESC
LIMIT 1;
```

## Cargar un nuevo pedido de 500 Curas del fabricante Bic

```sql
INSERT INTO productos (
    id_fabricante,
    id_producto,
    descripcion,
    precio,
    existencias
)
VALUES ('Bic', '41003', 'Curas', 120, 500);
```
## Eliminar productos del fabricante Osa

```sql
DELETE FROM productos
WHERE id_fabricante = 'Osa';
```