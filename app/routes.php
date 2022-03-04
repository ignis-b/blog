<?php
// Routes

$app->get('/', App\Controllers\HomeAction::class)
    ->setName('homepage');

$app->get('/users', function () {
    $users = App\Models\Users::all();
    echo $users->toJson();
});

$app->run();
