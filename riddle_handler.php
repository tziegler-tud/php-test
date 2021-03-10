<?php
//lets recall our session cookies
if (isset($_COOKIE["login_name"]) and isset($_COOKIE["user_id"])){
    $login_name = $_COOKIE["login_name"];
    $id = $_COOKIE["user_id"];
}
else {
    //login_name or id not found. abort and go back to login page
    header("Location: ./index.html");
    die();
}

//lets verify the name and id before we proceed to make the db request
if (is_null($login_name) or is_null($id)) {
    //login_name or id not found. abort and go back to login page
    header("Location: ./index.html");
    die();
}

//retrieve input data from POST request payload. The data is found in the $_POST variable
//for now, we expect the following variables: riddle
$riddle = $_POST["riddle"];

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


// lets check if the solution is correct.
/*
Note: This script is executed server-side. Thus, we can do the check here without it beeing compromised. However, we should definitely not make this file public.
Still, this is in no way secure and should only be used for testing purposes.
*/

//riddle was 2+3
if ($riddle == 5) {
    //correct answer. set flag and continue to the final page
    $sql = "UPDATE user SET riddle_solved = 1 WHERE ID=".$id;
    if ($conn->query($sql) === TRUE) {
        header("Location: ./solved.php");
        die();
    } else {
        // something went wrong :-(
        $message = "Error: " . $sql . "<br>" . $conn->error;
        echo "<script type='text/javascript'>alert(".$message.");</script>";
    }
} else {
    //solution is wrong, print some error and let the user retry
    $message = "Leider nein.";
    echo "<html>
    <script type='text/javascript'>
    if (confirm('Leider falsch. Nochmal probieren?')) {
      // go to riddle
      window.location.href = './riddle.php';
    } else {
      // go back to login
      window.location.href = './index.html';
    }
    </script></html>";
    die();
}

//close the connection when we are done.
$conn->close();
?>