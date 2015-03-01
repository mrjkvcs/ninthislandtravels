<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;
$capsule->addConnection(
    array(
        'driver'    => 'mysql',
        'host'      => 'localhost',
        'database'  => 'ninthislandtravels',
        'username'  => 'forge',
        'password'  => 'p06EI9p51gVfBrXk46o5',
        'charset'   => 'utf8',
        'collation' => 'utf8_unicode_ci',
        'prefix'    => '',
    )
);

$capsule->bootEloquent();
