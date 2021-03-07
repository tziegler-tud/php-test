<?php
/*
    Now, we want to retrieve entries from our db and display them.
*/


//First, we need to connect to the database.
$servername = "localhost"; //if we host our php file at the same url as the database, we can use localhost. Most database providers restrict access to local anyway.
$username = "id16324360_phpadmin"; // database username
$password = "fr0st-php#Ex?t"; // database password
$database = "id16324360_db"; //name of the database

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Status: Connection failed: " . $conn->connect_error);
  $connection_status_msg = "Status: Connection failed: " . $conn->connect_error;
}
$connection_status_msg = "Status: Connected successfully";

// we called the table "test". We will retrieve all records and then print them out one by one in our table

$sql = " SELECT * FROM test"; // * means we retrieve all columns from the table

$result = $conn->query($sql);

//we now have the results stored and can read them line by line. But before we continue, we create some nice html markup to display the results.
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FroDoe - Frost Dummy applicatiOn for Event registration</title>

    <link rel="shortcut icon" type="image/x-icon" href="static/icons/favicon.ico">
    <link rel="stylesheet" href="/src/css/results.css">
    <link rel="stylesheet" href="/src/css/common.css">
</head>
<body>
<div class="wrapper-full-height" id="wrapper">
    <div class="results-page">
        <div class="results-page-container">
            <!-- some fancy content to show off ;-) -->
            <div class="results-additional-box">
                <div class="additonal-content-container centered">
                    <div class="label frodo-label"><span class="v2">Fro</span><span class="v3">Doe</span></div>
                    <div class="frodo-label label-subtext"><span class="v1">Connection status: <?php echo $connection_status_msg;?></span></div>
                    <div class="img-container">
                        <img src="src/img/gandalf_light.jpg"/>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="results-content">
                <div class="results-content-inner centered">
                    <div class="results-table-container">
                        <div class="results-table-greeter">
                            <div class="greeter-label">Database entries:</div>
                            <div class="greeter-content">Lets see what has been entered:</div>
                        </div>

                        <div class="results-table-content">
                            <table class="results-table">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Lieblingsfarbe</th>
                                    <th>Eingetragen am:</th>
                                </tr>


<?php
//with the html in place, we can now read the results and append them to the html by using echo

if ($result->num_rows > 0) {  //checks if there is at least one record to display
  // output data of each row
  while($row = $result->fetch_assoc()) {

    //we continue our html table from above
    echo "<tr>";
    echo "<td>". $row["id"]. "</td>";
    echo "<td>". $row["name"]. "</td>";
    echo "<td>". $row["color"]. "</td>";
    echo "<td>". $row["date"]. "</td>";
    echo "</tr>";
  }
} else {  // no results found, show some error message
  $message = "Keine Einträge gefunden";
  echo "<script type='text/javascript'>alert(".$message.");</script>";
}
//all done! close the connection
$conn->close();

//now, lets finish our html markup
?>
                            </table>
                        </div>
                        <div class="results-table-greeter">
                            <div class="greeter-content greeter-bottom-text"><a class="signup-link" href="./">go back</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
