
<?php
//echo phpinfo();
 $servername = "database";
 $username = "user";
 $password = "user";
 $dbname = "dock";
 $port = "3306";
try{
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname",$username,$password);
    $conn -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo "Connected succesfully";
    echo "\r\n";
    $jsondata = file_get_contents('data.json');
    $data = json_decode($jsondata, true);
    $check = $conn->prepare("SELECT COUNT(*) FROM tasks");
    $check->execute();
    $count = $check->fetchColumn();
    #print($count);
    if ($count > 0) {
    	print("database already populated");
	}
	else{
		foreach ($data as $value) {
   		#print($value['title']);
   		#print($value['person']);
   		$names = explode(" ", $value['person']);
   		$stmt = $conn->prepare("SELECT id FROM people WHERE name=?");
		$stmt->execute([$names[0]]);
		$id_name = $stmt->fetchColumn();
		print($id_name);
		print($value['title']);

		$sql = "INSERT INTO tasks (title, person_id) VALUES (?,?)";
		$stmt= $conn->prepare($sql);
		$stmt->execute([$value['title'], $id_name]);
		}
	}

 } catch(PDOException $e){
    echo "Connection failed: " . $e -> getMessage();
 }

//API

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

// all of our endpoints start with /person
// everything else results in a 404 Not Found
if ($uri[1] !== 'person') {
    header("HTTP/1.1 404 Not Found");
    exit();
}