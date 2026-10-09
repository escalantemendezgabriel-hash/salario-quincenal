<?php
// Verificar que se recibieron los datos del formulario
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

// Obtener y limpiar datos personales
$nombre  = htmlspecialchars(trim($_POST["nombre"]));
$cedula  = htmlspecialchars(trim($_POST["cedula"]));

// Obtener horas trabajadas por turno
$horas_diurna     = floatval($_POST["horas_diurna"]);
$horas_vespertina = floatval($_POST["horas_vespertina"]);
$horas_nocturna   = floatval($_POST["horas_nocturna"]);

// Tarifas por hora (en Bs.)
$tarifa_diurna     = 675.00;
$tarifa_vespertina = 700.00;
$tarifa_nocturna   = 956.23;

// Calcular sueldo por cada turno
$sueldo_diurno     = $horas_diurna     * $tarifa_diurna;
$sueldo_vespertino = $horas_vespertina * $tarifa_vespertina;
$sueldo_nocturno   = $horas_nocturna   * $tarifa_nocturna;

// Sueldo bruto quincenal
$sueldo_bruto = $sueldo_diurno + $sueldo_vespertino + $sueldo_nocturno;

// Determinar porcentajes de deducción según escala salarial
if ($sueldo_bruto < 85000) {
    $pct_ahorro   = 0.001;  // 0.1%
    $pct_seguro   = 0.0015; // 0.15%
} elseif ($sueldo_bruto <= 150000) {
    $pct_ahorro   = 0.0015; // 0.15%
    $pct_seguro   = 0.002;  // 0.2%
} else {
    $pct_ahorro   = 0.003;  // 0.3%
    $pct_seguro   = 0.0025; // 0.25%
}

// Calcular montos de deducción
$descuento_ahorro = $sueldo_bruto * $pct_ahorro;
$descuento_seguro = $sueldo_bruto * $pct_seguro;
$total_deducciones = $descuento_ahorro + $descuento_seguro;

// Sueldo neto
$sueldo_neto = $sueldo_bruto - $total_deducciones;

// Función para formatear números con puntos de miles y coma decimal (estilo venezolano)
function bs(float $valor): string {
    return number_format($valor, 2, ',', '.') . ' Bs.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultado — Sueldo Quincenal</title>
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
      max-width: 520px;
    }

    h1 {
      text-align: center;
      color: #2c3e50;
      font-size: 1.4rem;
      margin-bottom: 25px;
    }

    .seccion {
      background: #f9f9f9;
      border: 1px solid #ddd;
      border-radius: 8px;
      padding: 18px 22px;
      margin-bottom: 18px;
    }

    .seccion h2 {
      margin: 0 0 14px 0;
      font-size: 1rem;
      color: #2c3e50;
      border-bottom: 1px solid #ddd;
      padding-bottom: 8px;
    }

    .fila {
      display: flex;
      justify-content: space-between;
      padding: 5px 0;
      font-size: 0.93rem;
      border-bottom: 1px dashed #eee;
    }

    .fila:last-child { border-bottom: none; }

    .fila .valor { font-weight: bold; color: #2c3e50; }

    .descuento .valor { color: #c0392b; }

    .neto {
      background: #27ae60;
      color: white;
      border-radius: 8px;
      padding: 18px 22px;
      display: flex;
      justify-content: space-between;
      font-size: 1.15rem;
      font-weight: bold;
      margin-bottom: 18px;
    }

    .btn-volver {
      display: block;
      text-align: center;
      padding: 12px;
      background: #2980b9;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      font-size: 1rem;
    }

    .btn-volver:hover { background: #1a6a9a; }
  </style>
</head>
<body>
<div class="container">
  <h1>📋 Comprobante de Sueldo Quincenal</h1>

  <!-- Datos del empleado -->
  <div class="seccion">
    <h2>👤 Datos del Empleado</h2>
    <div class="fila"><span>Nombre:</span>  <span class="valor"><?= $nombre ?></span></div>
    <div class="fila"><span>Cédula:</span>  <span class="valor"><?= $cedula ?></span></div>
  </div>

  <!-- Desglose por turno -->
  <div class="seccion">
    <h2>⏱ Horas Trabajadas y Sueldo por Turno</h2>
    <div class="fila">
      <span>🌤 Diurno (<?= $horas_diurna ?> h × 675 Bs.):</span>
      <span class="valor"><?= bs($sueldo_diurno) ?></span>
    </div>
    <div class="fila">
      <span>🌆 Vespertino (<?= $horas_vespertina ?> h × 700 Bs.):</span>
      <span class="valor"><?= bs($sueldo_vespertino) ?></span>
    </div>
    <div class="fila">
      <span>🌙 Nocturno (<?= $horas_nocturna ?> h × 956,23 Bs.):</span>
      <span class="valor"><?= bs($sueldo_nocturno) ?></span>
    </div>
  </div>

  <!-- Sueldo bruto -->
  <div class="seccion">
    <h2>💼 Sueldo Bruto Quincenal</h2>
    <div class="fila">
      <span>Total Bruto:</span>
      <span class="valor"><?= bs($sueldo_bruto) ?></span>
    </div>
  </div>

  <!-- Deducciones -->
  <div class="seccion">
    <h2>➖ Deducciones</h2>
    <div class="fila descuento">
      <span>Ahorro Habitacional (<?= ($pct_ahorro * 100) ?>%):</span>
      <span class="valor">− <?= bs($descuento_ahorro) ?></span>
    </div>
    <div class="fila descuento">
      <span>Seguro Social (<?= ($pct_seguro * 100) ?>%):</span>
      <span class="valor">− <?= bs($descuento_seguro) ?></span>
    </div>
    <div class="fila">
      <span>Total Deducciones:</span>
      <span class="valor" style="color:#c0392b">− <?= bs($total_deducciones) ?></span>
    </div>
  </div>

  <!-- Sueldo neto -->
  <div class="neto">
    <span>✅ Sueldo Neto Quincenal:</span>
    <span><?= bs($sueldo_neto) ?></span>
  </div>

  <a href="index.php" class="btn-volver">← Calcular otro empleado</a>
</div>
</body>
</html>
