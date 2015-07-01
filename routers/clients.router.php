<?php

$app->get('/clientes/modal/novo', 'auth', function () use ($app) {

    $app->render('clients/modal.html');

});

$app->post('/clientes/modal/novo', 'auth', function () use ($app) {

    $data = $app->request()->post();

    $client = new models\Client();

    $client->insert($data);

});

$app->get('/clientes/select', 'auth', function () use ($app) {

    $model = new models\Client();

    $clientes = $model->getAll('nome','ASC');

    $last = $model->get();

    $app->render('clients/select.html', ['clientes'=>$clientes,'id'=>$last[0]['id']]);

});