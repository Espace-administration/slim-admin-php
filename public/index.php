<?php

//__ gestion des erreurs
ini_set('display_errors','on');
error_reporting(E_ALL);

require __DIR__ . '/../bootstrap/app.php';

$app->run();
