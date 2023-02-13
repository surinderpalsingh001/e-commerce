<?php
#CREATE CONSTANTS
define('DB_USER','root');
define('DB_PASS',"");
define('DB_HOST','127.0.0.1');
//define('DB_PORT','3306');
define('DB_NAME','useradmindb');

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