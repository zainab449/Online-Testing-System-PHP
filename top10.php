<?php

include("DatabaseModel.php");

$con = mysqli_connect("localhost", "root", "", "website") or die("Connection fail");

$result = DatabaseModel::top10();

echo("<html>
<head>
    <title>Top 10 Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        center {
            max-width: 800px;
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
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
<center>
<h1>Top 10 Results</h1>
<table>
<tr>
    <th>Serial No</th>
    <th>Name</th>
    <th>Score</th>
</tr>");

$serial = 1;
while ($row = mysqli_fetch_assoc($result)) 
{
    $rid = $row['reg_id'];
    
    $username_result = DatabaseModel::getusername($rid);
    $username_row = mysqli_fetch_assoc($username_result);
    $username = $username_row['username'];

    echo ("<tr>");
    echo ("<td>".$serial."</td>");
    echo ("<td>".$username."</td>");
    echo ("<td>".$row['result_obtain_marks']."</td>");
    echo ("</tr>");
    $serial++;
}

echo("</table>
</center>
</body>
</html>");
?>
