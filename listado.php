<?php
require_once __DIR__ . '/conexion.php';
try {
$sql = 'SELECT id, nombre, apellido,
dni, plan_pagando
FROM socio
ORDER BY id DESC';
$consulta = $conexion->query($sql);
$socio = $consulta->fetchAll(
PDO::FETCH_ASSOC);
} catch (PDOException $e) {
error_log($e->getMessage());
http_response_code(500);
exit('no se pudo consultar el socio.');
}
function escaparListado(string $v): string {
return htmlspecialchars(
$v, ENT_QUOTES, 'UTF-8'
);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Listado de socios</title>
</head>
<body><main>
<h1>Listado de socios</h1>
<p><strong>Total:</strong>
<?= count($socio) ?></p>
<?php if (empty($socio)): ?>
<p>No hay socios registrados.</p>
<?php else: ?>
<table>
<thead><tr>
<th>ID</th>
<th>Nombre</th>
<th>Apellido</th>
<th>DNI</th>
<th>Plan</th>
</tr></thead>
<tbody>
<?php foreach ($socio
as $socio): ?>
<tr>
<td><?= escaparListado(
(string)$socio['id']
) ?></td>
<td><?= escaparListado(
$socio['nombre']
) ?></td>
<td><?= escaparListado(
$socio['apellido']
) ?></td>
<td><?= escaparListado(
$socio['dni']
) ?></td>
<td><?= escaparListado(
$socio['plan_pagando']
) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php endif; ?>
</main></body></html>