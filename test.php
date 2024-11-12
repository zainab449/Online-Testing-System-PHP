<?php
session_start();
include("DatabaseModel.php");

if (!isset($_SESSION['username'])) {
    header("Location: index.html"); // Redirect to login page if not logged in
    exit();
}

$con = mysqli_connect("localhost", "root", "", "website") or die("Connection failed");

// Initialize variables
$qid = 0;
$marks = 0;

if (isset($_GET['btn'])) {
    $qid = $_GET['qid'];
    $marks = $_GET['marks'];
    $op = $_GET['op'];
    $answerkey = $_GET['answerkey'];

    // Check answer
    if ($op == $answerkey) {
        $marks += 5;
    }

    // Check if the quiz is finished
    if ($qid >= 5) { 
        // Process results
        $username = $_SESSION['username'];
        $result = DatabaseModel::getRegID($username);

        if (!$result || mysqli_num_rows($result) == 0) {
            die("Failed to retrieve registration ID.");
        }

        $row = mysqli_fetch_assoc($result);
        $reg_id = $row['reg_id'];
        $result_attempt = DatabaseModel::getAttempt($reg_id);
        $row_attempt = mysqli_fetch_assoc($result_attempt);
        $user_attempt = $row_attempt['max_attempt'] + 1;

        $current_date = date("Y-m-d H:i:s");
        $totalquestions = 5;
        $correctquestions = $marks / 5;
        $wrongquestions = $totalquestions - $correctquestions;
        $totalmarks = $totalquestions * 5;

        $insert_result = DatabaseModel::insertResult($reg_id, $user_attempt, $totalquestions, $correctquestions, $wrongquestions, $marks, $totalmarks, $current_date);

        if (!$insert_result) {
            die(mysqli_error($con));
        }

        // Display results
        echo("<a href='index.php'>Home</a>");
        echo("<div class='result'>");
        echo("<h3>Total Questions:  " . $totalquestions . "</h3>");
        echo("<h3>Total Marks:  " . ($totalmarks) . "</h3>");
        echo("<h3>Obtained Marks:  " . ($marks) . "</h3>");
        echo("<h3>Correct Questions:  " . ($correctquestions) . "</h3>");
        echo("<h3>Wrong Questions:  " . $wrongquestions . "</h3>");
        echo("</div>");
        exit();
    }
}

$randomQuestionIds = [];
while (count($randomQuestionIds) < 5) {
    $randNum = rand(1, 20);
    if (!in_array($randNum, $randomQuestionIds)) {
        $randomQuestionIds[] = $randNum;
    }
}

$currentQuestionId = $randomQuestionIds[$qid];
$result = DatabaseModel::getQuestion($currentQuestionId);

if ($row = mysqli_fetch_assoc($result)) {
    $answerkey = $row['answer_key'];
    echo("<div class='quiz-container'>");
    echo("<br> Marks: $marks");
    echo("<form action='test.php' method='get'>");
    echo("<h1>Question No " . ($qid + 1) . ": " . $row['question'] . "?</h1>");
    echo("<table>");

    $answers_result = DatabaseModel::getAnswer($currentQuestionId);
    while ($ansrow = mysqli_fetch_assoc($answers_result)) {
        echo("<tr><td><input type='radio' name='op' value='" . $ansrow['answer'] . "'>" . $ansrow['answer'] . "</td></tr>");
    }
    echo("</table>");

    // Increment question ID for next iteration
    $qid++;  
} else {
    die("Question not found.");
}

echo("<input type='hidden' name='marks' value='$marks'>
<input type='hidden' name='qid' value='$qid'>
<input type='hidden' name='answerkey' value='$answerkey'>
<input type='submit' class='btn' Value='Next' name='btn'>
</form>");
echo("</div>");
?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
    }
    .quiz-container {
        max-width: 600px;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
        color: #333;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: left;
    }
    .btn {
        margin-top: 20px;
        padding: 10px 15px;
        border: none;
        background-color: #4CAF50;
        color: white;
        font-size: 16px;
        cursor: pointer;
        border-radius: 5px;
    }
    .btn:hover {
        background-color: #45a049;
    }
    .result {
        margin-top: 20px;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #e7f3fe;
    }
</style>
