<?php
include_once('db.php');

$db = getDbConnection();


$phone = $_POST['phone'];

$phone_no = "'". $phone . "'";
$name = "'". $phone . "'";
$db = $db->query("insert into phone(phone_no, name) values(" . $phone_no . ",". $name. ");");

