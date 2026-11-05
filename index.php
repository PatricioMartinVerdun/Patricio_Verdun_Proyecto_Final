<?php
$errores = [];
$nombre = '';
$apellido = '';
$dni = '';
$plan_pagando = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
$nombre = trim($_POST['nombre'] ?? '');
$apellido = trim($_POST['apellido'] ?? '');
$dni = trim($_POST['dni'] ?? '');
$plan_pagando = trim($_POST['plan_pagando'] ?? '');
if ($nombre === '') {
$errores[] = 'El nombre es obligatorio.';
}
if ($apellido === '') {
$errores[] = 'El apellido es obligatorio.';
}
if ($dni === '' || !preg_match('/^[0-9]{7,8}$/', $dni)) {
$errores[] = 'El DNI debe tener 7 u 8 números.';
}
 $planes_validos = ['20000', '40000', '60000'];
       if ($plan_pagando === '' || !in_array($plan_pagando, $planes_validos)) {
            $errores[] = 'Selecciona un plan de socio valido.';
}
}


require_once __DIR__ . '/conexion.php';
$errores = [];
$mensaje = '';
$nombre = '';
$apellido = '';
$dni = '';
$plan_pagando = '';

function escapar(string $valor): string {
return htmlspecialchars($valor, ENT_QUOTES, 'UTF-8');
}

