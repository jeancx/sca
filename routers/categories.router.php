<?php

$app->get('/categorias', 'auth', function () use ($app) {

    $model = new models\Category();

    $categorias = $model->getAll();

    $app->render('categories/index.html', ['categorias'=>$categorias]);

});

$app->get('/categorias/novo', 'auth', function () use ($app) {

    $app->render('categories/form.html');

});

$app->post('/categorias/novo', 'auth', function () use ($app) {

    $data = $app->request()->post();

    $data['titulo'] = $data['titulo'];

    $category = new models\Category();

    $category->insert($data);

    $app->redirect($app->url.'/categorias');

});


$app->get('/categorias/:id/editar', 'auth', function ($id) use ($app) {

    $model = new models\Category();

    $categoria = $model->getId($id);

    $app->render('categories/form.html',['categoria'=>$categoria]);

});

$app->post('/categorias/:id/editar', 'auth', function ($id) use ($app) {

    $data = $app->request()->post();

    $data['id'] = $id;

    $category = new models\Category();

    $category->update($data);

    $app->redirect($app->url.'/categorias');

});

$app->get('/categorias/:id/delete', 'auth', function ($id) use ($app) {

    $model = new models\Category();

    $model->delete($id);

    $app->redirect($app->url.'/categorias');

});


$app->get('/categorias/modal/novo', 'auth', function () use ($app) {

    $app->render('categories/modal.html');

});

$app->post('/categorias/modal/novo', 'auth', function () use ($app) {

    $data = $app->request()->post();

    $category = new models\Category();

    $category->insert($data);

});

$app->get('/categorias/select', 'auth', function () use ($app) {

    $model = new models\Category();

    $categorias = $model->getAll('titulo','ASC');

    $last = $model->get();

    $app->render('categories/select.html', ['categorias'=>$categorias,'id'=>$last[0]['id']]);

});