<?php

 
include('connection.php');
include("../login/auth.php"); //include auth.php file on all secure pages 
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="style.css" type="text/css">


<title>Players Page</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="container">
    <header class="col-md-12">
    <div class= "headerimages">
<img id="pitchImage" src="img/pitch.png" alt="Pitch Image" >
<img id="clubbadgeImage" src="img/logo.png" alt="Club Badge"  >
<h1>Ashley Rovers AFC</h1>
</div>
     <script>
function joinfunction() {
    window.open("login/logout.php");
}
</script>

</header>
<nav class="col-md-12 navbar navbar-expand-sm nav">
<div class="container-fluid">    
    <ul class="navbar-nav" >
       <li class="nav-item"><a class="nav-link" href="index.php">Home Page</a></li>
        <li class="nav-item"><a class="nav-link" href="FixturesResults.php">Fixtures Results</a></li>
        <li class="nav-item"><a class="nav-link" href="upload/Image.html">Images</a></li>
    </ul>
    <button type="button" class="btn btn-default" onclick="joinfunction()">Logout</button>
</div>
</nav>
<div class='row'>
        <section class="col-md-6">
<h7>Players Availability</h7>

<?php
// connect to the database
// get the records from the database
if ($result = $dbcon->query("SELECT * FROM players ORDER BY id"))
{
// display records if there are records to display
if ($result->num_rows > 0)
{
// display records in a table
echo "<table class='tv'>";

// set table headers
echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Availability</th><th></th></tr>";

while ($row = $result->fetch_object())
{
// set up a row for each record
echo "<tr>";
echo "<td>" . $row->id . "</td>";
echo "<td>" . $row->firstname . "</td>";
echo "<td>" . $row->lastname . "</td>";
echo "<td>" . $row->Available. "</td>";
echo "<td><a href='records.php?id=" . $row->id . "'>Edit</a></td>";
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

<a href="records.php">Add New Player</a>

</section>
<section class="col-md-6">
<h8>Fixture</h8>

<?php
// connect to the database
include 'connection.php';

// get the records from the database
if ($result = $dbcon->query("SELECT * FROM Fixtures WHERE id=(select MAX(id) FROM Fixtures)"))

{
// display records if there are records to display
if ($result->num_rows > 0)
{
// display records in a table
echo "<table class='te'>";

// set table headers
echo "<tr><th>Date</th><th>Fixture</th><th>Venue</th><th>Result/KO Time</th></tr>";

while ($row = $result->fetch_object())
{
// set up a row for each record
echo "<tr>";
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

<p> <br><b>INSTRUCTIONS </b> <br> Please click the <b>Edit</b> of the table on 
the left hand side and Select <b>1</b> if you are available for the fixture above or 
select <b> 0</b> if you are not available </p>


</section>

</div>


</body>
</html>



</body>
</html>
