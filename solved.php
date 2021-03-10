<?php
if (isset($_COOKIE["login_name"])){
    $login_name = $_COOKIE["login_name"];
}
if (isset($_COOKIE["user_id"])){
    $id = $_COOKIE["user_id"];
}

//lets verify the name and id before we proceed to make the db request
if (is_null($login_name) or is_null($id)) {
    //login_name or id not found. abort and go back to login page
    header("Location: ./index.html");
    die();
}

/* to access this page, the user must have solved the riddle. lets get the database record and check if that is the case. */


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

// find the users db record

//check if the user is already present in our database. We look for entries with the corresponding name:
$sql = " SELECT * FROM user WHERE id=".$id; // * means we retrieve all columns from the table where the id corresponds to the one entered

$result = $conn->query($sql); // lets process it

if ($result->num_rows > 0) {  //checks if there is at least one record to display
  // output data of each row
  while($row = $result->fetch_assoc()) {
    //we found an entry for the user
    $login_name = $row["login_name"];
    $id = $row["id"];
    $solved = $row["riddle_solved"];  // we expect a bool here, stating whether the riddle has been solved successfully. (0/false = not solved, 1/true = solved)

    //check whether riddle was solved
    if ($solved) {
        //riddle solved, we may proceed
    }else {
        //riddle not solved, display some error content
        echo "Not so fast, adventurer! You need to solve the riddle first!";
        die();
    }
  }

} else {  // no record with the given name found
  //something went really wrong. lets abort everything and go back to index page.
  echo "Sauron has compromised our database and now something went horribly wrong. We apologize, adventurer.";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FroDoe - Frost Dummy applicatiOn for Event registration</title>

    <link rel="stylesheet" href="/src/css/index.css">
    <link rel="stylesheet" href="/src/css/common.css">
</head>
<body>
<div class="wrapper-full-height" id="wrapper">
    <div class="index-page">
        <div class="index-page-container">
            <!-- some fancy content to show off ;-) -->
            <div class="index-additional-box">
                <div class="additonal-content-container centered">
                    <div class="label frodo-label"><span class="v2">Fro</span><span class="v3">Doe</span></div>
                    <div class="frodo-label label-subtext"><span class="v1">Frost Dummy applicatiOn for Event registration</span></div>
                    <div class="img-container">
                        <img src="src/img/frodo_light.jpg"/>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="index-content">
                <div class="index-content-inner centered">
                    <div class="index-form-container">
                        <div class="index-form-greeter">
                            <div class="greeter-label">You are right, <?php echo $login_name; ?></div>
                            <div class="greeter-content">Well done. You are invited.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>