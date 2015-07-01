<?php

$app->get('/programador/modal/novo', 'auth', function () use ($app) {

    $app->render('programmers/modal.html');

});

$app->post('/programador/modal/novo', 'auth', function () use ($app) {

    $data = $app->request()->post();

    $programmer = new models\Programmer();

    $programmer->insert($data);

});

$app->get('/programadores/select', 'auth', function () use ($app) {

    $model = new models\Programmer();

    $programadores = $model->getAll('nome','ASC');

    $last = $model->get();

    $app->render('programmers/select.html', ['programadores'=>$programadores,'id'=>$last[0]['id']]);

});