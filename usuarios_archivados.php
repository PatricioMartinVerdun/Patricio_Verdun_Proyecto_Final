<?php
SELECT id, nombre, apellido,
dni, plan_pagando email, archivado_en
FROM usuarios
WHERE archivado_en IS NOT NULL
ORDER BY archivado_en DESC;