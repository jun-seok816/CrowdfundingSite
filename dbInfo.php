<?php
  $db = new PDO("mysql:host=localhost;port=3306;dbname=junseok816","junseok816","tlsrn815");
  
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // $db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
 ?>
