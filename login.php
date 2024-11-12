<?php
session_start();
include("DatabaseModel.php");

$con = mysqli_connect("localhost", "root", "", "website") or die("Connection fail");

if (isset($_POST['user'])) {
    $user = $_POST['user'];
} else {
    $user = '';
}

if (isset($_POST['pass'])) {
    $pass = $_POST['pass'];
} else {
    $pass = '';
}

$result = DatabaseModel::getRegistration($user);
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
            color: #d9534f;
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

if ($rows == 1) {
    $row = mysqli_fetch_assoc($result);
    if ($pass == $row['user_pass']) {
        $_SESSION['username'] = $user;
        header("Location: http://localhost/testonline/index.php");
        exit;
    } else {
        echo "<div class='message'><h1>Username and Password do not match.</h1></div>";
    }
} else {
    echo "<div class='message'><h1>Username not found. Please register.</h1><a href='http://localhost/testonline/register.html'>Register</a></div>";
    exit;
}
?>
