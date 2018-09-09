<?php
use LSYS\MongoDB;

include __DIR__."/Bootstarp.php";

$db=(\LSYS\MongoDB\DI::get()->mongodb())->getDatabase();

$insertOneResult = $db->test->insertOne([
		'username' => 'admin',
		'email' => 'admin@example.com',
		'name' => 'Admin User',
]);
$data=$db->test->find([	'username' => 'admin',
		'email' => 'admin@example.com',]);
print_r(current($data->toArray())->name);exit;
