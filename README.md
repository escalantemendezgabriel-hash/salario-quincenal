# Cálculo de Salario Quincenal

Aplicación web en PHP que calcula el sueldo quincenal de un trabajador según las horas trabajadas en tres turnos y aplica deducciones según la escala salarial.

## Cómo funciona

1. El usuario ingresa su nombre, cédula y las horas trabajadas en cada turno (diurno, vespertino y nocturno).
2. El sistema calcula el **sueldo bruto** multiplicando las horas por la tarifa correspondiente:
   - Diurna: **675 Bs./h**
   - Vespertina: **700 Bs./h**
   - Nocturna: **956,23 Bs./h**
3. Se aplican deducciones por **Ahorro Habitacional** y **Seguro Social** según la escala:

| Sueldo Bruto          | Ahorro Habitacional | Seguro Social |
|-----------------------|---------------------|---------------|
| Menor a 85.000 Bs.    | 0,10%               | 0,15%         |
| 85.000 – 150.000 Bs.  | 0,15%               | 0,20%         |
| Mayor a 150.000 Bs.   | 0,30%               | 0,25%         |

4. Se muestra el **sueldo neto** con el desglose completo.

## Archivos

- `index.php` — Formulario de entrada de datos.
- `calcular.php` — Lógica de cálculo y página de resultados.

## Requisitos

- PHP 7.4 o superior
- Servidor web (Apache, Nginx o servidor integrado de PHP)

## Ejecución local

```bash
php -S localhost:8000
```

Luego abre `http://localhost:8000` en tu navegador.
