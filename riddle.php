<?php
$login_name = $_COOKIE["login_name"];
$id = $_COOKIE["user_id"];

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
                            <div class="greeter-label">Greetings, <?php echo $login_name ?> !</div>
                            <div class="greeter-content">Please solve the riddle.</div>
                        </div>
                        <div class="index-form-greeter">
                            <div class="greeter-content greeter-bottom-text">Wie viel ist 2 + 3 ?</div>
                        </div>
                        <div class="index-form-content">
                            <!-- the HTML form element is the container for our inputs.
                            We specify method="POST", meaning we will send a post request to the url given by the "action" property.  -->
                            <!-- action="./registration_handler.php" points to a php file in the same directory as this file. The php file will handle the POST request. -->
                            <form class="index-form" id="index-form01" action="./riddle_handler.php" method="POST">

                                <!-- form contains input elements and associated labels -->
                                <label class="form-label" id="label1" for="some_input1">Lösung</label>
                                <input class="form-input" type="text" id="some_input1" name="riddle" aria-labelledby="label1" required>

                                <!-- clicking the button will fire the forms action -->
                                <button class="form-submit submit-button">
                                    <span class="icon icon-send">login</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>