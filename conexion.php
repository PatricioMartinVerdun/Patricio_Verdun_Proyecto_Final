    <?php
$host = 'localhost';
$dbname = 'riverplate';
$usuario = 'root';
$password = '';
try {
$conexion = new PDO(
"mysql:host=$host;dbname=$dbname;charset=utf8mb4",
$usuario,
$password
);
$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
error_log($e->getMessage());
http_response_code(500);
exit('No se pudo conectar con la base de datos.');
}
?>

<form action="index.php" method="POST">
<label for="nombre">Nombre:</label>
<input type="text" id="nombre" name="nombre" maxlength="80" required>
<label for="apellido">Apellido:</label>
<input type="text" id="apellido" name="apellido" maxlength="80" required>
<label for="dni">DNI:</label>
<input type="text" id="dni" name="dni" inputmode="numeric" pattern="[0-9]{7,8}" maxlength="8" required>
<label for="plan_pagando">Plan de socio:</label>
<select id="plan_pagando" name="plan_pagando" required>
    <option value="" disabled selected>Seleccione un plan</option>
    <option value="20000">$20.000</option>
    <option value="40000">$40.000</option>
    <option value="60000">$60.000</option>
</select>

    <button type="submit">Registrar socio</button>
<?php
    if (empty($errores)) {
try {
$sql = 'INSERT INTO socio (nombre, apellido, dni, plan_pagando) VALUES (:nombre, :apellido, :dni, :plan_pagando)';
$stmt = $conexion->prepare($sql);
$stmt->execute([
'nombre' => $nombre,
'apellido' => $apellido,
'dni' => $dni,
'plan_pagando' => $plan_pagando
]);
$mensaje = 'Se registro de forma correcta al socio hincha de river.';

$nombre = '';
$apellido = '';
$dni = '';
$plan_pagando = '';
} catch (PDOException $e) {
if ($e->getCode() === '23000') {
$errores[] = 'Ese DNI ya está registrado.';
} else {
error_log($e->getMessage());
$errores[] = 'Ocurrió un error al guardar los datos.';
}
}
}