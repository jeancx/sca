<?php

// GET index route
$app->get('/', 'auth', function () use ($app) {

    $problem = new models\Problem();
    $topic = new models\Topic();
    $client = new models\Client();
    $programmer = new models\Programmer();

    $count['problemas'] = $problem->count();
    $count['topicos'] = $topic->count();
    $count['clientes'] = $client->count();
    $count['programadores'] = $programmer->count();

    $problemas = $problem->get(10);
    $topicos = $topic->get(10);

    $app->render('index.html',['count'=>$count,'problemas'=>$problemas,'topicos'=>$topicos]);

});