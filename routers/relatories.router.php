<?php


$app->get('/relatorios/problemas', 'auth', function () use ($app) {

    $model = new models\Problem();

    for($i=0; $i<12; $i++){
        $relatorio[$i] = $model->countByMonth('2015',$i+1);
    }

    $app->render('relatories/problems_by_month.html', ['relatorio' => $relatorio]);

});

$app->get('/relatorios/topicos', 'auth', function () use ($app) {

    $model = new models\Problem();

    $relatorio= $model->costByProblem(1);

    return var_dump($relatorio);

    $app->render('relatories/problems_by_month.html', ['relatorio' => $relatorio]);

});
