<?php
$dbconfig = include('config/db.php');

#CREATE CONSTANTS
define('DB_USER',$dbconfig["DB_USER"]);
echo $dbconfig["DB_USER"];
define('DB_PASS',$dbconfig["DB_PASS"]);
define('DB_HOST',$dbconfig["DB_HOST"]);
//define('DB_PORT','3306');
define('DB_NAME',$dbconfig["DB_NAME"]);

#CREATE CONNECTION

try
{
  $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS,);
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo"Connected Successfully";
}
  catch (PDOException $e)
  {
    echo "error: ".$e->getMessage();
  }
?>