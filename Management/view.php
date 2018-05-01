<?php
session_start();
?>


<html>
<head>
<title>Admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="../style.css" type="text/css">
</head>
<body>
<div class="container">
    <header class="col-md-12">
    <div class= "headerimages">
<img id="pitchImage" src="../img/pitch.png" alt="Pitch Image" >
<img id="clubbadgeImage" src="../img/logo.png" alt="Club Badge"  >
<h1>Ashley Rovers AFC</h1>
</div>
     <script>
function joinfunction() {
    window.open("../login/logout.php");
}
</script>

</header>
<nav class="col-md-12 navbar navbar-expand-sm nav">
<div class="container-fluid">    
    <ul class="navbar-nav" >
        <li class="nav-item"><a class="nav-link" href="../index.php">Home Page</a></li>
        <li class="nav-item"><a class="nav-link" href="../FixturesResults.php">Fixtures Results</a></li>
        <li class="nav-item"><a class="nav-link" href="../upload/Image.html">Images</a></li>
    </ul>
    <button type="button" class="btn btn-default" onclick="joinfunction()">Logout</button>
</div>
</nav>
 <?php 
$type = NULL;
/* Checks for the login status */
if (isset($_SESSION['logged-in']) && (($_SESSION['logged-in'] == 'admin'))) {
    echo "<div id='login'>Logged-in as {$_SESSION['logged-in']}";
    echo "<form name='logout' id='logout' action='login.php' method='post'>";
    echo "<input type='submit' name='logout' value='Logout' class='button'></form></div><br/>";

    include "../connection.php";
?> 

<div class='row'>
        <section class="col-md-4">
<h9>Players</h9>

<?php
// connect to the database
include 'connection.php';
include 'auth.php';
// get the records from the database
if ($result = $dbcon->query("SELECT * FROM players ORDER BY id"))
{
// display records if there are records to display
if ($result->num_rows > 0)
{
// display records in a table
echo "<table class='tf'>";

// set table headers
echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Availability</th><th></th><th></th></tr>";

while ($row = $result->fetch_object())
{
// set up a row for each record
echo "<tr>";
echo "<td>" . $row->id . "</td>";
echo "<td>" . $row->firstname . "</td>";
echo "<td>" . $row->lastname . "</td>";
echo "<td>" . $row->Available. "</td>";
echo "<td><a href='records.php?id=" . $row->id . "'>Edit</a></td>";
echo "<td><a href='delete.php?id=" . $row->id . "'>Delete</a></td>";
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
<section class="col-md-8">
<h10>Fixtures</h10>

<?php
// connect to the database
include '../connection.php';
include 'auth.php';
// get the records from the database
if ($result = $dbcon->query("SELECT * FROM fixtures ORDER BY ids"))
{
// display records if there are records to display
if ($result->num_rows > 0)
{
// display records in a table
echo "<table class='tz'>";

// set table headers
echo "<tr><th>#</th><th>Date</th><th>Fixture</th><th>Venue</th><th>Result/KO Time</th><th></th><th></th></tr>";

while ($row = $result->fetch_object())
{
// set up a row for each record
echo "<tr>";
echo "<td>" . $row->ids. "</td>";
echo "<td>" . $row->dates . "</td>";
echo "<td>" . $row->fixture . "</td>";
echo "<td>" . $row->venue. "</td>";
echo "<td>" . $row->Result_KO_Time. "</td>";
echo "<td><a href='recordsfix.php?ids=" . $row->ids . "'>Edit</a></td>";
echo "<td><a href='deletefix.php?ids=" . $row->ids . "'>Delete</a></td>";
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

<a class="fixture" href="recordsfix.php">Add New Fixture</a>

</section>

</div>
</body>
<?php /* If user is not logged-in */
} else {
    echo "<div id='login'><form name='login' id='login' action='login.php' method='post'>";
    echo "Please enter Management password to continue:<br/>";
    echo "<input name='password' type='password' placeholder='Enter Password'><br/>";
    echo "<input type='submit' name='submit' class='button'></form><br/>";
    echo " admin password is admin</div><br/>";
}?>



</html>