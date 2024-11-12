<?php

$GLOBALS["con"]=mysqli_connect("localhost","root","","website");

class DatabaseModel 
{
    public static function getRegistration($user)
    {
        $query = "SELECT username, user_pass FROM login WHERE username='$user'";
        return mysqli_query($GLOBALS["con"], $query);
    }

    public static function usernameCheck($user)
    {
        $query = "SELECT username FROM login WHERE username='$user'";
        return mysqli_query($GLOBALS["con"], $query);
    }

    public static function insertRegistration($user,$userfname,$usergender,$usermobileno,$usercnic,$useremail,$pass)
    {
        $query= "INSERT INTO login (username, user_fname, user_gender, user_mobileno, user_cnic, user_email, user_pass) VALUES ('$user', '$userfname', '$usergender', '$usermobileno', '$usercnic', '$useremail', '$pass')";
        return mysqli_query($GLOBALS["con"], $query);
    }

    public static function getRegID($username)
    {
        $query_reg_id = "SELECT reg_id FROM login WHERE username = '$username'";
        return mysqli_query($GLOBALS["con"], $query_reg_id);
    }

    public static function getResult($reg_id)
    {
        $query_result = "SELECT * FROM announce WHERE reg_id = '$reg_id'";
        return mysqli_query($GLOBALS["con"], $query_result);
    }

    public static function getAttempt($reg_id)
    {
        $query_attempt = "SELECT MAX(result_user_attempt) AS max_attempt FROM announce WHERE reg_id = '$reg_id'";
        return mysqli_query($GLOBALS["con"], $query_attempt);
    }

    public static function insertResult($reg_id,$user_attempt,$totalquestion,$correctquestion,$wrongquestion,$marks,$totalmarks,$current_date)
    {
        $query = "INSERT INTO announce (reg_id, result_user_attempt, result_total_question, result_correct_question, result_wrong_question, result_obtain_marks, result_total_marks, result_test_date, result_status) 
                  VALUES ('$reg_id', '$user_attempt', '$totalquestion', '$correctquestion', '$wrongquestion', '$marks', '$totalmarks', '$current_date', 'Completed')";
        return mysqli_query($GLOBALS["con"], $query);
    }

    public static function getQuestion($currentQuestionId)
    {
        $query = "SELECT * FROM questions WHERE question_id='$currentQuestionId'";
        return mysqli_query($GLOBALS["con"], $query);
    }

    public static function getAnswer($currentQuestionId)
    {
        $query = "SELECT * FROM answers WHERE question_id='$currentQuestionId'";
        return mysqli_query($GLOBALS["con"], $query);
    }

    public static function top3()
    {
        $query = "SELECT * FROM announce ORDER BY result_obtain_marks DESC LIMIT 3";
        return mysqli_query($GLOBALS["con"], $query);
    }

    public static function getusername($rid)
    {
        $username_query = "SELECT username FROM login WHERE reg_id = '$rid'";
        return mysqli_query($GLOBALS["con"], $username_query);
    }

    public static function top10()
    {
        $query = "SELECT * FROM announce ORDER BY result_obtain_marks DESC LIMIT 10";
        return mysqli_query($GLOBALS["con"], $query);
    }
}


?>
