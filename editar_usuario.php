<?php
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($id === false || $id === null || $id < 1) {
http_response_code(400);
exit('Identificador inválido.');
}
$stmt = $conexion->prepare('SELECT id, nombre, apellido, dni, plan_pagando,  email
FROM usuarios WHERE id = :id AND archivado_en IS NULL LIMIT 1');