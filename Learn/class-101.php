<?php

require_once __DIR__. "/making_classes.php";
//
//$a = new arsenal();
//$a->build();
//$a->save_arsenal();

$a = arsenal::loadArsenal();

print_r($a);
