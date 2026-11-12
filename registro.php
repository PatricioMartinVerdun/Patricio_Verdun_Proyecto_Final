
<form action="registro.php" method="POST">
<label for="nombre">Nombre</label>
<input type="text"
id="nombre"
name="nombre"
maxlength="80"
required>
<label for="email">Correo electrónico</label>
<input type="email"
id="email"
name="email"
maxlength="254"
required>
<label for="dni">DNI:</label>
<input type="text" id="dni" name="dni" inputmode="numeric" pattern="[0-9]{7,8}" maxlength="8" required>
<label for="plan_pagando">Plan de socio:</label>
<select id="plan_pagando" name="plan_pagando" required>
    <option value="" disabled selected>Seleccione un plan</option>
    <option value="20000">$20.000</option>
    <option value="40000">$40.000</option>
    <option value="60000">$60.000</option>
</select>
<label for="password">Contraseña</label>
<input type="password"
id="password"
name="password"
required>
<button type="submit">Crear cuenta</button>
</form>
<?php

$nombre = trim($_POST['nombre'] ?? '');
$email = trim($_POST['email'] ?? '');
$dni = trim($_POST['dni'] ?? '');
$plan_pagando = trim($_POST['plan_pagando'] ?? '');
$password = $_POST['password'] ?? '';
$confirmar= $_POST['confirmar'] ?? '';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
$errores[] = 'El correo no es válido.';
}   
if ($password !== $confirmar) {
$errores[] = 'Las contraseñas no coinciden.';
}
$passwordHash = password_hash(
$password,
PASSWORD_DEFAULT);
$sql = "INSERT INTO usuarios (nombre, email, dni, plan_pagando, password_hash, rol) 
VALUES (:nombre,:email,:dni,:plan_pagando,:password_hash,:rol)";
require_once 'conexion.php';
$stmt = $conexion->prepare($sql);
$stmt->execute([    
'nombre' => $nombre,
'email' => $email,
'dni' => $dni,
'plan_pagando' => $plan_pagando,
'password_hash' => $passwordHash,
'rol' => 'usuario']);
$sql = 'SELECT id, nombre, email, dni, plan_pagando, password_hash, rol
FROM usuarios
WHERE email = :email
AND archivado_en IS NULL
LIMIT 1';
$stmt = $conexion->prepare($sql);
$stmt->execute(['email' => $email]);
$usuario = $stmt->fetch();
if ($usuario !== false &&
password_verify($password, $usuario['password_hash']))
{
session_start();
session_regenerate_id(true);
$_SESSION['usuario_id'] = $usuario['id'];
$_SESSION['usuario_rol'] = $usuario['rol'];
if ($usuario['rol'] === 'admin') {
header('Location: admin_usuarios.php');
} else {
header('Location: panel.php');
}
exit;
}
