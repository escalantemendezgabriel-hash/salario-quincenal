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

// Sueldo por turno
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
</head>
<body>
  <h1>Comprobante de Sueldo Quincenal</h1>
  <hr>

  <h2>Datos del Empleado</h2>
  <p><strong>Nombre:</strong> <?= $nombre ?></p>
  <p><strong>Cedula:</strong> <?= $cedula ?></p>

  <h2>Sueldo por Turno</h2>
  <table border="1" cellpadding="6">
    <tr><td>Diurno (<?= $horas_diurna ?> h x 675 Bs.)</td><td><?= bs($sueldo_diurno) ?></td></tr>
    <tr><td>Vespertino (<?= $horas_vespertina ?> h x 700 Bs.)</td><td><?= bs($sueldo_vespertino) ?></td></tr>
    <tr><td>Nocturno (<?= $horas_nocturna ?> h x 956,23 Bs.)</td><td><?= bs($sueldo_nocturno) ?></td></tr>
    <tr><td><strong>Sueldo Bruto</strong></td><td><strong><?= bs($sueldo_bruto) ?></strong></td></tr>
  </table>

  <h2>Deducciones</h2>
  <table border="1" cellpadding="6">
    <tr><td>Ahorro Habitacional (<?= $pct_ahorro * 100 ?>%)</td><td><?= bs($desc_ahorro) ?></td></tr>
    <tr><td>Seguro Social (<?= $pct_seguro * 100 ?>%)</td><td><?= bs($desc_seguro) ?></td></tr>
  </table>

  <h2>Sueldo Neto Quincenal: <?= bs($sueldo_neto) ?></h2>
  <hr>

  <a href="index.php">Calcular otro empleado</a>
</body>
</html>
