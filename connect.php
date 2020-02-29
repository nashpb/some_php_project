<?php
$servername = "localhost";
$username = "admin";
$password = "pass";
$dbname = "salon";

// creating connection
$conn = new mysqli($servername, $username, $password, $dbname);

// checking connection
if ($conn -> connect_error){
	die("Connection failed : ".$conn->connect_error);
}
echo "Connected successfully \n";

$sql = "select * from admin";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "| id: " . $row["id"]. " | username: " . $row["username"]. " | password: " . $row["password"]. "\n";
    }
} else {
    echo "0 results";
}

$conn->close();

?>