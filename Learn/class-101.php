<?php

require_once __DIR__. "/user_input.php";
//
//$a = new arsenal();
//$a->build();
//$a->save_arsenal();

$a = arsenal::load_arsenal();

print_r($a);
