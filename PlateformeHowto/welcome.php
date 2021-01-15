<?php

include 'db.php';

$r = new db('howtosite');
$r->q("SELECT * FROM `user`");


