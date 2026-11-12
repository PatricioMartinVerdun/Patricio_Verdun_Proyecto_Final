<?php
function escapar(string $valor): string {
return htmlspecialchars(
$valor,
ENT_QUOTES,
'UTF-8'
);
}

foreach ($usuarios as $usuario):
<tr>
<td><?= escapar($usuario['nombre']) ?></td>
<td><?= escapar($usuario['email']) ?></td>
<td><?= escapar($usuario['dni']) ?></td>
<td><?= escapar($usuario['plan_pagando']) ?></td>
<td><?= escapar($usuario['rol']) ?></td>
</tr>
endforeach;