
<html>
<head>
<title>Fixtures</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="style.css" type="text/css">
</head>
<body>
<div class="container">
    <header class="col-md-12">
    <div class= "headerimages">
<img id="pitchImage" src="img/pitch.png" alt="Pitch Image" >
<img id="clubbadgeImage" src="img/logo.png" alt="Club Badge"  >
<h1>Ashley Rovers AFC</h1>
</div>
    
</header>
<nav class="col-md-12 navbar navbar-expand-sm nav">
<div class="container-fluid">    
    <ul class="navbar-nav" >
        <li class="nav-item"><a class="nav-link" href="index.php">Home Page</a></li>
        <li class="nav-item"><a class="nav-link" href="upload/image.html">Images</a></li>
    </ul>
</div>
</nav>
  
<section class="col-md-12">
<h3>Fixtures and Results</h3>

<?php
// connect to the database
include 'connection.php';

// get the records from the database
if ($result = $dbcon->query("SELECT * FROM Fixtures ORDER BY id"))
{
// display records if there are records to display
if ($result->num_rows > 0)
{
// display records in a table
echo "<table class='tz'>";

// set table headers
echo "<tr><th>#</th><th>Date</th><th>Fixture</th><th>Venue</th><th>Result/KO Time</th></tr>";

while ($row = $result->fetch_object())
{
// set up a row for each record
echo "<tr>";
echo "<td>" . $row->id. "</td>";
echo "<td>" . $row->dates . "</td>";
echo "<td>" . $row->fixture . "</td>";
echo "<td>" . $row->venue. "</td>";
echo "<td>" . $row->Result_KO_Time. "</td>";
echo "</tr>";
}

echo "</table>";
}
// if there are no records in the database, display an alert message
else
{
echo "No results to display!";
}
}
// show an error if there is an issue with the database query
else
{
echo "Error: " . $dbcon->error;
}

// close database connection
$dbcon->close();

?>


</section>

</div>
</body>




</html>