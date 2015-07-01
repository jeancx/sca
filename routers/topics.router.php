<?php

$app->get('/topicos', 'auth', function () use ($app) {

    $model = new models\Topic();

    $topicos = $model->getAll();

    $app->render('topics/index.html', ['topicos'=>$topicos]);

});

$app->get('/topicos/:id', 'auth', function ($id) use ($app) {

    $model = new models\Topic();

    $topicos = $model->getbyProblem($id);

    $app->render('topics/index.html', ['topicos'=>$topicos,'id'=>$id]);

});

$app->get('/topico/novo', 'auth', function () use ($app) {

    $problem = new models\Problem();
    $problemas = $problem->getAll();

    $programmer = new models\Programmer();
    $programadores = $programmer->getAll();

    $app->render('topics/form.html', ['problemas'=>$problemas,'programadores'=>$programadores]);

});


$app->get('/topico/novo/:id', 'auth', function ($id) use ($app) {

    $problem = new models\Problem();
    $problemas = $problem->getAll();

    $programmer = new models\Programmer();
    $programadores = $programmer->getAll();

    $app->render('topics/form.html', ['problemas'=>$problemas,'programadores'=>$programadores,'id'=>$id]);

});



$app->post('/topicos/novo', 'auth', function () use ($app) {

    $data = $app->request()->post();

    $data['tempo'] = (int) $data['tempo'];

    unset($data['_wysihtml5_mode']);

    $topic = new models\Topic();

    $topic->insert($data);

    $app->redirect($app->url.'/topicos');

});



$app->get('/topico/:id/editar', 'auth', function ($id) use ($app) {

    $problem = new models\Problem();
    $problemas = $problem->getAll();

    $programmer = new models\Programmer();
    $programadores = $programmer->getAll();

    $topic = new models\Topic();
    $topico = $topic->getId($id);

    $app->render('topics/form.html', ['problemas'=>$problemas,'programadores'=>$programadores,'topico'=>$topico]);

});

$app->post('/topico/:id/editar', 'auth', function ($id) use ($app) {

    $data = $app->request()->post();

    $data['id'] = $id;

    $data['tempo'] = (int) $data['tempo'];

    unset($data['problema_id']);
    unset($data['programador_id']);
    unset($data['titulo']);
    unset($data['descricao']);
    unset($data['_wysihtml5_mode']);

    $topic = new models\Topic();

    $topic->update($data);

    $app->redirect($app->url.'/topicos');

});