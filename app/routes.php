<?php
// Routes

$app->get('/', App\Action\HomeAction::class)
    ->setName('homepage');

$app->get('/users', function () {
    $users = App\Model\Users::all();
    echo $users->toJson();
});

$app->run();
