<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

// Datos personales
$nombre  = htmlspecialchars(trim($_POST["nombre"]));
$cedula  = htmlspecialchars(trim($_POST["cedula"]));

// Horas por turno
$horas_diurna     = floatval($_POST["horas_diurna"]);
$horas_vespertina = floatval($_POST["horas_vespertina"]);
$horas_nocturna   = floatval($_POST["horas_nocturna"]);

// Calcular sueldo por turno
$sueldo_diurno     = $horas_diurna     * 675.00;
$sueldo_vespertino = $horas_vespertina * 700.00;
$sueldo_nocturno   = $horas_nocturna   * 956.23;

// Sueldo bruto
$sueldo_bruto = $sueldo_diurno + $sueldo_vespertino + $sueldo_nocturno;

// Porcentajes segun escala salarial
if ($sueldo_bruto < 85000) {
    $pct_ahorro = 0.001;   // 0.1%
    $pct_seguro = 0.0015;  // 0.15%
} elseif ($sueldo_bruto <= 150000) {
    $pct_ahorro = 0.0015;  // 0.15%
    $pct_seguro = 0.002;   // 0.2%
} else {
    $pct_ahorro = 0.003;   // 0.3%
    $pct_seguro = 0.0025;  // 0.25%
}

// Deducciones
$desc_ahorro = $sueldo_bruto * $pct_ahorro;
$desc_seguro = $sueldo_bruto * $pct_seguro;
$sueldo_neto = $sueldo_bruto - $desc_ahorro - $desc_seguro;

// Formato de numero
function bs($n) {
    return number_format($n, 2, ',', '.') . ' Bs.';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultado</title>
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

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 16px;
      font-size: 0.92rem;
    }

    table caption {
      text-align: left;
      font-weight: bold;
      color: #444;
      margin-bottom: 6px;
      font-size: 0.9rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    td {
      padding: 7px 4px;
      border-bottom: 1px solid #eee;
      color: #333;
    }

    td:last-child {
      text-align: right;
      font-weight: bold;
    }

    .rojo { color: #c0392b; }

    .neto {
      background: #2980b9;
      color: white;
      border-radius: 6px;
      padding: 12px 16px;
      display: flex;
      justify-content: space-between;
      font-size: 1.05rem;
      font-weight: bold;
      margin-bottom: 20px;
    }

    a {
      display: block;
      text-align: center;
      padding: 10px;
      background: #555;
      color: white;
      text-decoration: none;
      border-radius: 5px;
      font-size: 0.95rem;
    }

    a:hover { background: #333; }
  </style>
</head>
<body>
<div class="caja">
  <h1>Comprobante de Sueldo</h1>

  <table>
    <caption>Datos del Empleado</caption>
    <tr><td>Nombre</td><td><?= $nombre ?></td></tr>
    <tr><td>Cedula</td><td><?= $cedula ?></td></tr>
  </table>

  <table>
    <caption>Horas y Sueldo por Turno</caption>
    <tr><td>Diurno (<?= $horas_diurna ?> h x 675 Bs.)</td><td><?= bs($sueldo_diurno) ?></td></tr>
    <tr><td>Vespertino (<?= $horas_vespertina ?> h x 700 Bs.)</td><td><?= bs($sueldo_vespertino) ?></td></tr>
    <tr><td>Nocturno (<?= $horas_nocturna ?> h x 956,23 Bs.)</td><td><?= bs($sueldo_nocturno) ?></td></tr>
    <tr><td>Sueldo Bruto</td><td><?= bs($sueldo_bruto) ?></td></tr>
  </table>

  <table>
    <caption>Deducciones</caption>
    <tr>
      <td>Ahorro Habitacional (<?= ($pct_ahorro * 100) ?>%)</td>
      <td class="rojo">- <?= bs($desc_ahorro) ?></td>
    </tr>
    <tr>
      <td>Seguro Social (<?= ($pct_seguro * 100) ?>%)</td>
      <td class="rojo">- <?= bs($desc_seguro) ?></td>
    </tr>
  </table>

  <div class="neto">
    <span>Sueldo Neto Quincenal</span>
    <span><?= bs($sueldo_neto) ?></span>
  </div>

  <a href="index.php">Calcular otro empleado</a>
</div>
</body>
</html>
