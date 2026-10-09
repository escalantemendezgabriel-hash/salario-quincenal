<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Salario Quincenal</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f2f2f2;
      display: flex;
      justify-content: center;
      padding: 40px 10px;
    }

    .caja {
      background: white;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.15);
      width: 100%;
      max-width: 420px;
    }

    h1 {
      font-size: 1.3rem;
      color: #333;
      text-align: center;
      margin-bottom: 20px;
    }

    p.info {
      font-size: 0.85rem;
      background: #eef4fb;
      border-left: 3px solid #2980b9;
      padding: 8px 12px;
      margin-bottom: 20px;
      color: #333;
    }

    label {
      display: block;
      font-size: 0.9rem;
      font-weight: bold;
      margin-bottom: 4px;
      color: #444;
    }

    input {
      width: 100%;
      padding: 9px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 0.95rem;
      box-sizing: border-box;
      margin-bottom: 14px;
    }

    button {
      width: 100%;
      padding: 11px;
      background: #2980b9;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 1rem;
      cursor: pointer;
    }

    button:hover {
      background: #1f6690;
    }
  </style>
</head>
<body>
<div class="caja">
  <h1>Calculo de Salario Quincenal</h1>

  <p class="info">
    Tarifas: Diurna 675 Bs. | Vespertina 700 Bs. | Nocturna 956.23 Bs.
  </p>

  <form method="POST" action="calcular.php">
    <label>Nombre:</label>
    <input type="text" name="nombre" required>

    <label>Cedula:</label>
    <input type="text" name="cedula" required>

    <label>Horas turno diurno:</label>
    <input type="number" name="horas_diurna" min="0" step="0.5" value="0" required>

    <label>Horas turno vespertino:</label>
    <input type="number" name="horas_vespertina" min="0" step="0.5" value="0" required>

    <label>Horas turno nocturno:</label>
    <input type="number" name="horas_nocturna" min="0" step="0.5" value="0" required>

    <button type="submit">Calcular</button>
  </form>
</div>
</body>
</html>
