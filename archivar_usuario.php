<?php
UPDATE usuarios
SET archivado_en = CURRENT_TIMESTAMP
WHERE id = :id
AND archivado_en IS NULL;