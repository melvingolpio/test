<?php

$host = 'us-cluster-east-01.k8s.cleardb.net';
$user = 'b045ef9e80a154';
$pass = 'de9cac97';
$dbname = 'heroku_8c20245ae7e92fd';

$conn = new mysqli($host, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT status FROM parking_slots ORDER BY slot_number ASC";
$result = $conn->query($sql);


$statuses = [];

if ($result->num_rows > 0) {
   
    while ($row = $result->fetch_assoc()) {
        $statuses[] = $row['status'];
    }
} else {
 
    echo json_encode(["error" => "No data found"]);
    exit();
}

// Output the response as JSON
echo json_encode($statuses);

// Close the database connection
$conn->close();
?>
