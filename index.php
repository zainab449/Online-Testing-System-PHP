<?php
session_start();

if(!isset($_SESSION['username'])) {
    header("Location: http://localhost/testonline/login.html");
    exit;
}
?>
<html>
<head>
    <title>Online Testing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .navbar {
            background-color: #688eb4; 
        
}

.navbar .nav-link {
    color: #ffffff; 
    font-size: 2rem;
}

.navbar .nav-link:hover {
    color: #cce0ff; 
}

.navbar .navbar-brand {
    color: #ffffff;
    margin-left: 40px;
    font-size: 2rem;
    font-weight:600;

}

.navbar .navbar-toggler-icon {
    margin-right: 40px;
    font-size: 0.5rem;
    background-color: #ffffff; 
}

.breadcrumb {
    background-color: #f8f9fa; 
    padding: 10px 15px; 
    border-radius: 5px; 
    margin-bottom: 20px; 
}

.breadcrumb-item {
    display: inline; 
    font-size: 1.5rem; 
    align-items:center;
    justify-content:center;
}

.breadcrumb-item + .breadcrumb-item::before {
    
    padding: 0 10px; 
    color: #6c757d; 
    text-align:center;
    align-items:center;
    justify-content:center;
}

.breadcrumb-item a {
    text-decoration: none;
    color: #007bff;
    text-align:center;
}

.breadcrumb-item a:hover {
    text-decoration: underline;
    color: #0056b3; 
}

.breadcrumb-item.active {
    color: #6c757d; 
}
h1{
    text-align:center;
}
.btn{
    width: 90px;

}
.button-container{
    text-align:center;
   margin-top:30px;
   height:50px;
   width: 100%;
}




.login-btn {
    background-color: #28a745;
    color: white;
    font-size: 2rem;
}

.login-btn:hover {
    background-color: #218838;
}

    </style>
</head>
<body >

    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light"> -->
    <nav class="navbar navbar-expand-lg navbar-bg-dark">
            <!-- <a class="navbar-brand" href="#"> -->
                <!-- Dark color background -->
        <div class="container-fluid">
          <a class="navbar-brand" href="#">SkillCheck</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class=" navbar-brand id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Services</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact us</a>
              </li>
           
            </ul>
          </div>
        </div>
      </nav>
      
      <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
    <li class="breadcrumb-item"><a href="top3.php">Top 3</a></li>
    <li class="breadcrumb-item"><a href="top10.php">Top 10</a></li>
    <li class="breadcrumb-item"><a href="result.php">Result</a></li>
    <li class="breadcrumb-item"><a href="logout.php">LogOut</a></li>
  </ol>
</nav>

<h1>Welcome to Your Online Test!</h1>

    
<form action="http://localhost/testonline/test.php" method="get" class="login-form">
                <input type="hidden" name="op" value="null">
                <input type="hidden" name="answerkey" value="">
                <input type="hidden" name="qid" value="0">
                <input type="hidden" name="marks" value="0">
            
                <div class="button-container">
                <input type="submit" value="Start" name="event" class="btn login-btn">
                </div>
            </form>
</body>
</html>