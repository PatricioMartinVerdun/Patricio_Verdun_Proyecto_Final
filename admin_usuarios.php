<form method="GET" action="admin_usuarios.php">
<input type="search" name="buscar" maxlength="100"
placeholder="Nombre, apellido, dni, Plan pagando o correo">
<button type="submit">Buscar</button>
</form>
<?php
session_start();
if (
!isset($_SESSION['usuario_id']) ||
($_SESSION['usuario_rol'] ?? '') !== 'admin'
) {
http_response_code(403);
exit('Acceso denegado.');
}
$buscar = trim($_GET['buscar'] ?? '');
$sql = 'SELECT id, nombre, apellido, dni, plan_pagando, email,
rol, creado_en, archivado_en FROM usuarios
WHERE archivado_en IS NULL';
if ($buscar !== '') {
$sql .= ' AND (nombre LIKE :nombre OR apellido LIKE :apellido plan_pagando LIKE :plan_pagando OR
OR dni LIKE :dni OR email LIKE :email)';
$termino = '%' . $buscar . '%';
}
$stmt = $conexion->prepare($sql);
$stmt->execute($parametros);