<?php

use ivankayzer\HowLongToBeat\HowLongToBeat;

require_once 'vendor/autoload.php';

$hl2b = new HowLongToBeat();

$list = $hl2b->get(1468);
var_dump($list);

// 1468
