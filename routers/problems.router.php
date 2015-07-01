<?php

$app->get('/problemas', 'auth', function () use ($app) {

    $model = new models\Problem();

    $problemas = $model->getAll();

    $app->render('problems/index.html', ['problemas' => $problemas]);

});

$app->get('/problemas/novo', 'auth', function () use ($app) {

    $client = new models\Client();
    $clientes = $client->getAll();
    $category = new models\Category();
    $categorias = $category->getAll('titulo', 'ASC');

    $app->render('problems/form.html', ['clientes' => $clientes, 'categorias' => $categorias]);

});

$app->post('/problemas/novo', 'auth', function () use ($app) {

    $data = $app->request()->post();

    $helpers = new lib\Helpers();

    $data['cliente_id'] = $data['cliente_id'];
    $data['categoria_id'] = $data['categoria_id'];
    $data['data_hora'] = $helpers->dateTimeDB($data['data'], $data['hora']);
    unset($data['data']);
    unset($data['hora']);
    unset($data['_wysihtml5_mode']);
    $data['usuario_id'] = $_SESSION['user']['id'];

    $problem = new models\Problem();

    $problem->insert($data);

    $app->redirect($app->url . '/problemas');

});


$app->post('/problemas/:id/editar', 'auth', function ($id) use ($app) {

    $data = $app->request()->post();

    $data['id'] = $id;
    unset($data['_wysihtml5_mode']);

    $problem = new models\Topic();

    $problem->update($data);

    $app->redirect($app->url . '/topicos');

});