<?php

require 'resources/db_config.php';

$conn = connect();

session_start();

//check if a form is posted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //register process
    if (isset($_POST['register'])) {

        //get data from the form
        $fname = $_POST['fname'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        
        //hashes the password
        $password = md5($_POST['password']);

        $bday = $_POST['year'].'-'.$_POST['month'].'-'.$_POST['day'];

        //check for duplicates
        $query = mysqli_query($conn, "SELECT email, username FROM users WHERE email = '$email' OR username = '$username'");

        if ($query) {
            if (mysqli_num_rows($query) > 0) {
                $row = mysqli_fetch_assoc($query);

                if ($username == $row['username']) {
                    //username already exists
                    $_SESSION['registration_err'] = 1;

                    header("location:signup.php");
                    return;
                }

                if ($email == $row['email']) {
                    //email alerady exists
                    $_SESSION['registration_err'] = 2;

                    header("location:signup.php");
                    return;
                }
            }
        }

        //Insert data to database
        $query = mysqli_query($conn, "INSERT INTO users(full_name, email, username, password, birth_date) VALUES ('$fname', '$email', '$username', '$password', '$bday')");

        if ($query) {
            $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
            $row = mysqli_fetch_assoc($query);
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            
            header("location:home.php");
        }
    }

    //login process
    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);

        //select the email and password from database
        $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' AND password = '$password'");

        //check if the query has rows
        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);

            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['BadLogin'] = null;

            header("location:home.php");
        } else {
            $_SESSION['BadLogin'] = 1;
            header("location:index.php");
        }
    }
}