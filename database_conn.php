<?php
$link = new mysqli('localhost', 'unn_w19000898', 'teK*xf?EfnC3?K7%rWMTX#}h', 'unn_w19000898');

// Check connection
if($link->connect_error) {
  echo "<h2>Error occurred</h2> <p>Connection failed: ".$dbConn->connect_error."</p>\n";
  exit;
}
?>
