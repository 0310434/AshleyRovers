<?php


include("auth.php"); //include auth.php file on all secure pages ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome Home</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<p>Welcome <?php echo $_SESSION['username']; ?>!</p>
<p><a href="../Management/View.php">Admin</a></p>
<p><a href="../players.php">Players Page</a></p>
<a href="logout.php">Logout</a>



</div>
</body>
</html>
