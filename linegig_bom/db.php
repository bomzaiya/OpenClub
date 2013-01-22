<?php
function getDbConnection() {
  $db = @new mysqli("localhost", "bom", "bom", "bom");
  if (mysqli_connect_errno()) {
   echo "Connect Database Error";
    exit();
  }
  $db->query("SET NAMES UTF8");
  return $db;
}


