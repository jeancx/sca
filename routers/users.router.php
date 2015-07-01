<?php

$app->get('/login', function () use ($app) {
    $app->render('login.html');
});

$app->post('/login', function () use ($app) {

    $data = $app->request()->post();

    $username = $data['username'];
    $password = $data['password'];

    $User = new models\User();

    if($User->getByLogin($username, $password)) {
        $app->redirect($app->url.'/');
    }else{
        $msg = 'Erro na Autentição';
        $app->render('login.html', ['msg'=>$msg]);
    }

});

$app->get('/usuarios', 'auth', function () use ($app) {

    $model = new models\User();

    $usuarios = $model->getAll();

    $app->render('users/index.html', ['usuarios'=>$usuarios]);

});

$app->get('/usuarios/novo', 'auth', function () use ($app) {

    $app->render('users/form.html');

});

$app->post('/usuarios/novo', 'auth', function () use ($app) {

    $data = $app->request()->post();

    unset($data['password_confirm']);

    $user = new models\User();

    $user->insert($data);

    $app->redirect($app->url.'/usuarios');

});

$app->get('/usuarios/:id/editar', 'auth', function ($id) use ($app) {

    $model = new models\User();

    $usuario = $model->getById($id);

    $app->render('users/form.html',['usuario'=>$usuario]);

});

$app->post('/usuarios/:id/editar', 'auth', function ($id) use ($app) {

    $data = $app->request()->post();

    $data['id'] = $id;

    unset($data['password_confirm']);

    $user = new models\User();

    $user->update($data);

    $app->redirect($app->url.'/usuarios');

});

$app->get('/sair', 'auth', function () use ($app) {

    unset($_SESSION['user']);
    $app->redirect($app->url.'/login');

});