<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Cálculo de Salario Quincenal</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f4f8;
      display: flex;
      justify-content: center;
      align-items: flex-start;
      min-height: 100vh;
      margin: 0;
      padding: 30px 10px;
    }

    .container {
      background: white;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 480px;
    }

    h1 {
      text-align: center;
      color: #2c3e50;
      font-size: 1.4rem;
      margin-bottom: 25px;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
      color: #34495e;
      font-size: 0.9rem;
    }

    input[type="text"],
    input[type="number"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
      box-sizing: border-box;
      margin-bottom: 16px;
    }

    input[type="submit"] {
      width: 100%;
      padding: 12px;
      background: #2980b9;
      color: white;
      font-size: 1rem;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background: #1a6a9a;
    }

    .tarifas {
      background: #eaf4fb;
      border-left: 4px solid #2980b9;
      padding: 10px 14px;
      border-radius: 6px;
      margin-bottom: 20px;
      font-size: 0.85rem;
      color: #2c3e50;
    }

    .resultado {
      margin-top: 30px;
      background: #f9f9f9;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 20px;
    }

    .resultado h2 {
      color: #2c3e50;
      margin-top: 0;
      font-size: 1.1rem;
      border-bottom: 1px solid #ddd;
      padding-bottom: 10px;
    }

    .fila {
      display: flex;
      justify-content: space-between;
      padding: 6px 0;
      font-size: 0.95rem;
      border-bottom: 1px dashed #eee;
    }

    .fila:last-child { border-bottom: none; }

    .fila .valor { font-weight: bold; color: #2c3e50; }
    .fila.neto { margin-top: 10px; background: #27ae60; color: white; padding: 10px; border-radius: 6px; border: none; }
    .fila.neto .valor { color: white; }
    .descuento .valor { color: #c0392b; }
  </style>
</head>
<body>
<div class="container">
  <h1>💰 Cálculo de Salario Quincenal</h1>

  <div class="tarifas">
    <strong>Tarifas por hora:</strong><br>
    🌤 Diurna: <strong>675 Bs.</strong> &nbsp;|&nbsp;
    🌆 Vespertina: <strong>700 Bs.</strong> &nbsp;|&nbsp;
    🌙 Nocturna: <strong>956.23 Bs.</strong>
  </div>

  <form method="POST" action="calcular.php">
    <label>Nombre completo:</label>
    <input type="text" name="nombre" placeholder="Ej: Juan Pérez" required>

    <label>Cédula:</label>
    <input type="text" name="cedula" placeholder="Ej: V-12345678" required>

    <label>Horas trabajadas — Turno Diurno:</label>
    <input type="number" name="horas_diurna" min="0" step="0.5" placeholder="0" required>

    <label>Horas trabajadas — Turno Vespertino:</label>
    <input type="number" name="horas_vespertina" min="0" step="0.5" placeholder="0" required>

    <label>Horas trabajadas — Turno Nocturno:</label>
    <input type="number" name="horas_nocturna" min="0" step="0.5" placeholder="0" required>

    <input type="submit" value="Calcular Sueldo">
  </form>
</div>
</body>
</html>
