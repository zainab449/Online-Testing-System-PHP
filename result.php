<?php

include("DatabaseModel.php");

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$con = $GLOBALS["con"]; 

$username = $_SESSION['username'];

$result_reg_id = DatabaseModel::getRegID($username);
$row_reg_id = mysqli_fetch_assoc($result_reg_id);
$reg_id = $row_reg_id['reg_id'];

$result_result = DatabaseModel::getResult($reg_id);

echo("<html>
<head>
    <title>User Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
        }
        p {
            font-size: 16px;
            color: #555;
            margin: 5px 0;
        }
    </style>
</head>
<body>
<div class='container'>");

while ($row_result = mysqli_fetch_assoc($result_result)) {
    $attempt = htmlspecialchars($row_result["result_user_attempt"]);
    $total_question = htmlspecialchars($row_result["result_total_question"]);
    $correct_question = htmlspecialchars($row_result["result_correct_question"]);
    $wrong_question = htmlspecialchars($row_result["result_wrong_question"]);
    $obtain_marks = htmlspecialchars($row_result["result_obtain_marks"]);

    echo "<h2>Attempt: $attempt</h2>";
    echo "<p>Total questions: $total_question</p>";
    echo "<p>Correct questions: $correct_question</p>";
    echo "<p>Wrong questions: $wrong_question</p>";
    echo "<p>Obtain Marks: $obtain_marks</p>";
}

echo("</div>
</body>
</html>");
?>
