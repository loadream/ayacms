<?php
defined('IN_AYA') or exit('Access Denied');

$name=(string)$_GET['name'];

isset($ADDFIELD[$name]) or $name='text';

$names=thesenames(AYA_ROOT.'table/'.$name.'/');

include template($action,'admin');
