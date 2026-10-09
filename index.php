<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Salario Quincenal</title>
</head>
<body>
  <h1>Calculo de Salario Quincenal</h1>
  <p>Tarifas: Diurna 675 Bs. | Vespertina 700 Bs. | Nocturna 956.23 Bs.</p>
  <hr>

  <form method="POST" action="calcular.php">
    <label>Nombre:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Cedula:</label><br>
    <input type="text" name="cedula" required><br><br>

    <label>Horas turno diurno:</label><br>
    <input type="number" name="horas_diurna" min="0" step="0.5" value="0" required><br><br>

    <label>Horas turno vespertino:</label><br>
    <input type="number" name="horas_vespertina" min="0" step="0.5" value="0" required><br><br>

    <label>Horas turno nocturno:</label><br>
    <input type="number" name="horas_nocturna" min="0" step="0.5" value="0" required><br><br>

    <input type="submit" value="Calcular">
  </form>
</body>
</html>
