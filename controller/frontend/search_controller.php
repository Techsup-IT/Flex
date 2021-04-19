<?php

$users=$db->run("SELECT * from `employee` where `department` != 5")->fetchAll();

