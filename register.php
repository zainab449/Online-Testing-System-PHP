<?php

include("DatabaseModel.php");

$con = mysqli_connect("localhost", "root", "", "website") or die("Connection fail");

$user = $_POST['user'];
$pass = $_POST['pass'];
$userfname = $_POST['userfname'];
$usergender = $_POST['usergender'];
$usermobileno = $_POST['usermobileno'];
$usercnic = $_POST['usercnic'];
$useremail = $_POST['useremail'];

$result = DatabaseModel::usernameCheck($user);
$rows = mysqli_num_rows($result);

echo '<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .message {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #333;
        }
        a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #0056b3;
        }
      </style>';

if ($rows > 0) {
    echo "<div class='message'><h1>Username Already Exists.</h1></div>";
} else {
    $result = DatabaseModel::insertRegistration($user, $userfname, $usergender, $usermobileno, $usercnic, $useremail, $pass);
    
    if ($result) {
        echo "<div class='message'><h1>Account Created With: $user</h1> <a href='http://localhost/testonline/login.html'>Login</a></div>";
    }
}
?>
