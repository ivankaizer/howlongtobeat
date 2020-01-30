<?php

use ivankayzer\HowLongToBeat\HowLongToBeat;

require_once 'vendor/autoload.php';

$hl2b = new HowLongToBeat();

$list = $hl2b->search('Witcher 3');

var_dump($list);

// search
// get