<?php

//retrieve input data from POST request payload. The data is found in the $_POST variable

//for now, we expect the following variables: name, color

$name = $_POST["name"];
$color = $_POST["color"];
echo 'Hello ' . $name . '!<br> Your favourite color is '. $color . '<br><br>';

//Right, this should work. Now, we want to push the values to our database.

//First, lets look at our credentials
$servername = "localhost"; //if we host our php file at the same url as the database, we can use localhost. Most database providers restrict access to local anyway.
$username = "id16324360_phpadmin";
$password = "fr0st-php#Ex?t";
$database = "id16324360_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "<br>Connected successfully<br>";

//now, lets add our new data to the database
// we called the table "test". the table holds 4 columns: id, name, color, date. We only want provide name and color, the id and date should be set automatically.

$sql = "INSERT INTO test (name, color) VALUES ('".$name."', '".$color."')";

if ($conn->query($sql) === TRUE) {
  echo "<br>SUCCESS: New record added successfully";
} else {
  echo "<br>Error: " . $sql . "<br>" . $conn->error;
}

//close the connection when we are done.
$conn->close();
echo "<br>end of php script reached.<br><br>"

?>

<html>
<body>
<button><a href="./">go back</a></button>
</body>
</html>
