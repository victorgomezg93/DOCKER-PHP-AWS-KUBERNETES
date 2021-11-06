
<?php
//echo phpinfo();
 $servername = "127.0.0.1";
 $username = "root";
 $password = "secret";
 $dbname = "dock";
 $port = "3306";
try{
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname",$username,$password);
    $conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo "Connected succesfully";
 } catch(PDOException $e){
    echo "Connection failed: " . $e -> getMessage();
 }