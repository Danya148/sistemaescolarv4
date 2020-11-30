<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Illuminate\Database\Capsule\Manager as DB;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../config/database.php';

// Instantiate app
$app = AppFactory::create();
$app->setBasePath('/sistemaescolarv4/api/index.php');

// Add Error Handling Middleware
$app->addErrorMiddleware(true, false, false);

// Add route callbacks
$app->get('/', function (Request $request, Response $response, array $args) {
    $response->getBody()->write('Hello World');
    return $response;
});

$app->post('/login/{usuario}', function (Request $request, Response $response, array $args) {

    $data = json_decode($request->getBody()->getContents(), false);
    
    $users = DB::table('usuarios')
    ->where('usuarios.nombreusuario', $args['usuario'])
    ->first();

    $msg = new stdClass();

    $msg->mensaje = 'OK aceptado';

    if($users->password == $data->password){
        $msg->aceptado = true;
        $msg->idusuarios = $users->idusuarios;
    } else {
        $msg->aceptado = false;
    }

    $response->getBody()->write(json_encode($msg));
    return $response;
});

$app->post('/alumno', function (Request $request, Response $response, array $args) {

    $data = json_decode($request->getBody()->getContents(), false);
    
    DB::table('alumnos')->insert(
        ['nombre' => $data->nombre],
        ['primer_apellido' => $data->primer_apellido],
        ['segundo_apellido' => $data->segundo_apellido],
    );

    $msg = 'Datos Guardados';

    $response->getBody()->write(json_encode($msg));
    return $response;
});


// Run application
$app->run();