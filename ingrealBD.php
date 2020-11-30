<?php

use Illuminate\Database\Capsule\Manager as DB;

require 'vendor/autoload.php';
require 'config/database.php';

DB::table("alumnos")->insert([
	"nombre" => $_POST["nombre"],
    "primer_apellido" => $_POST["primer_apellido"],
    "segundo_apellido" => $_POST["segundo_apellido"],
]);

echo <<<_HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Negocio Web</title>
    <link rel="stylesheet" href="node_modules\bulma\css\bulma.min.css">
</head>
<body>
	<h1> Click al boton para el siguiente formulario</h1>
	<br>
    <a href="insertarcali.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Siguiente</a>
</body>
</html>
_HTML;