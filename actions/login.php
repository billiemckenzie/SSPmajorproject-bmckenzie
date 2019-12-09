<?php
require_once($_SERVER["DOCUMENT_ROOT"] . "/conn.php");

$errors = [];

// If the the button action was login
if (isset($_POST["action"]) && $_POST["action"] == "login") :
    //get the users email and password
    //connect to users table
    //check if user exists and password matches
    //if not, send error
    //if correct, login and go to index

    if (
        (isset($_POST["email"]) && $_POST["email"] != "") && (isset($_POST["password"]) && $_POST["password"] != "")
    ) {
        $email = $_POST["email"];
        $password = md5($_POST["password"]);

        $query_users = "SELECT * 
                        FROM users 
                        WHERE email = '" . $email . "'
                         AND password = '" . $password . "'
                        LIMIT 1
                        ";
        $user_result = mysqli_query($conn, $query_users);
        //check is user is in database  
        print_r(mysqli_num_rows($user_result));

        if (mysqli_num_rows($user_result) > 0) {
            // User Found!

            //Get all the users rows from the database
            while ($user = mysqli_fetch_array($user_result)) {
                //print_r($user);
                session_destroy(); //destroy current session
                session_start(); // start fresh session

                $_SESSION["email"] = $user["email"];
                $_SESSION["role"] = $user["role"];
                $_SESSION["user_id"] = $user["id"];

                header("Location: http://" . $_SERVER["SERVER_NAME"]);
            }
        } else {
            $errors[] = "Email or Password Incorrect.";
        }
    } else {
        $errors[] = "Please Fill Out Username & Password";
    }

// IF ACTION IS SIGN UP
elseif (isset($_POST["action"]) && $_POST["action"] == "signup") :

    $first_name     = $_POST["first_name"];
    $last_name      = $_POST["last_name"];
    $email          = $_POST["email"];
    $password       = md5($_POST["password"]);
    $password2      = md5($_POST["password2"]);
    $address        = $_POST["address"];
    $address2       = $_POST["address2"];
    $city           = $_POST["city"];
    $province_id    = ( isset($_POST["province"]) ) ? $_POST["province"] : 0;
    $postal_code    = $_POST["postal_code"];

    $date_created   = date("Y-m-d H:i:s");

   

    $role = (isset($_POST["rolecheck"])) ? $_POST["rolecheck"] : 3;

    echo "<pre>";
    print_r($_SERVER);

    if ($password == $password2 && strlen($password) > 3) {
        //continue
        if (isset($_POST["human_check"])) {
            //continue
            if ($email != "" && $first_name != "" && $last_name != "") {
                //I MADE IT!!!
                
                $new_user_query = "INSERT INTO users 
                                   (first_name, last_name, email, password, address, address2, city, province_id, postal_code, role, date_created) 
                                   VALUES ('$first_name', '$last_name', '$email', '$password', '$address', '$address2', '$city', $province_id, '$postal_code', $role, '$date_created')";

                if ( !mysqli_query($conn, $new_user_query) ) {
                    echo mysqli_error($conn);
                } else {
                    //log user in, and go to home page
                    $user_id = mysqli_insert_id($conn);
                    session_destroy();
                    session_start();

                    $_SESSION["user_id"] = $user_id;
                    $_SESSION["role"]    = $role;
                    $_SESSION["email"]   = $email;

                    header("Location: http://" . $_SERVER["SERVER_NAME"]);

                }
                //END I MADE IT!!!
            } else {
                $errors[] = "Please fill out required fields";
            }
        } else {
            $errors[] = "You must be a human";
        }
    } else {
        $errors[] = "Passwords do not match";
    }

// IF LOG OUT BUTTON CLICKED
elseif (isset($_REQUEST["action"]) && $_REQUEST["action"] == "logout") :
    session_destroy();
    header("Location: http://" . $_SERVER["SERVER_NAME"] . "?" . $query);

endif;

if (!empty($errors)) {
    $query = http_build_query(array("errors" => $errors));
    header("Location: " . strtok ($_SERVER["HTTP_REFERER"], "?") . "?" . $query);
}
