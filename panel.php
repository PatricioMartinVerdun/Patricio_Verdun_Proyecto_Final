<?php
session_start();
if (!isset($_SESSION['usuario_id']) ||
($_SESSION['usuario_rol'] ?? '') !== 'admin') {
http_response_code(403);
exit('Acceso denegado.');
}