<?php

// connect to the database
include '../connection.php';
include 'auth.php';
// confirm that the 'id' variable has been set
if (isset($_GET['ids']) && is_numeric($_GET['ids']))
{
// get the 'id' variable from the URL
$id = $_GET['ids'];

// delete record from database
if ($stmt = $dbcon->prepare("DELETE FROM fixtures WHERE ids = ? LIMIT 1"))
{
$stmt->bind_param("i",$ids);
$stmt->execute();
$stmt->close();
}
else
{
echo "ERROR: could not prepare SQL statement.";
}
$dbcon->close();

// redirect user after delete is successful
header("Location: view.php");
}
else
// if the 'id' variable isn't set, redirect the user
{
header("Location: view.php");
}

?>
