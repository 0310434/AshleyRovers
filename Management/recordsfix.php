<?php
/*
Allows the user to both create new records and edit existing records
*/

// connect to the database
include '../connection.php';


include 'auth.php';



// creates the new/edit record form
// form  used multiple times created function
function renderForm($dates = '', $fixture ='',$venue='',$Result_KO_Time= '', $error = '', $ids = '')
{ ?>

<html>
<head>
<title>
<?php if ($ids != '') { echo "Edit Record"; } else { echo "New Record"; } ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1><?php if ($ids != '') { echo "Edit Record"; } else { echo "New Record"; } ?></h1>
<?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error
. "</div>";
} ?>

<form action="" method="post">
<div>
<?php if ($ids != '') { ?>
<input type="hidden" name="ids" value="<?php echo $ids; ?>" />
<p>ID: <?php echo $ids; ?></p>
<?php } ?>

<strong>Date: *</strong> <input type="text" name="dates"
value="<?php echo $dates; ?>"/><br/>
<strong>Fixture: *</strong> <input type="text" name="fixture"
value="<?php echo $fixture; ?>"/><br/>
<strong>Venue: *</strong> <input type="text" name="venue"
value="<?php echo $venue; ?>"/><br/>
<strong>Result/KO Time: *</strong> <input type="text" name="Result_KO_Time"
value="<?php echo $Result_KO_Time; ?>"/>
<p>* required</p>
<input type="submit" name="submit" value="Submit" />
</div>
</form>
</body>
</html>

<?php }



/*

EDIT RECORD

*/
// if the 'id' variable is set in the URL, we know that we need to edit a record
if (isset($_GET['ids']))
{
// if the form's submit button is clicked, we need to process the form
if (isset($_POST['submit']))
{
// make sure the 'id' in the URL is valid
    if (is_numeric($_POST['ids']))
{
// get variables from the URL/form
$ids = $_POST['ids'];
$dates = htmlentities($_POST['dates'], ENT_QUOTES);
$fixture= htmlentities($_POST['fixture'], ENT_QUOTES);
$venue = htmlentities($_POST['venue'], ENT_QUOTES);
$Result_KO_Time = htmlentities($_POST['Result_KO_Time'], ENT_QUOTES);
// check boxes not left empty
if ($dates == '' || $fixture == '' || $venue== '' || $Result_KO_Time=='')
{
// if they are empty, show an error message and display the form
$error = 'ERROR: Please fill in all required fields!';
renderForm($dates, $fixture,$venue,$Result_KO_Time, $error, $ids);
}
else
{
// if everything is fine, update the record in the database
if ($stmt = $dbcon->prepare("UPDATE fixtures SET dates = ?, fixture = ?,venue = ?,Result_KO_Time = ?
WHERE ids=?"))
{
$stmt->bind_param("ssssi", $dates, $fixture,$venue,$Result_KO_Time, $ids);
$stmt->execute();
$stmt->close();
}
// show an error message if the query has an error
else
{
echo "ERROR: could not prepare SQL statement.";
}

// redirect the user once the form is updated
header("Location: view.php");
}
}
// if the 'id' variable is not valid, show an error message
else
{
echo "Error!";
}
}
// if the form hasn't been submitted yet, get the info from the database and show the form
else
{
// make sure the 'id' value is valid
if (is_numeric($_GET['ids']) && $_GET['ids'] > 0)
{
// get 'id' from URL
$ids = $_GET['ids'];

// get the record from the database
if($stmt = $dbcon->prepare("SELECT * FROM fixtures WHERE ids=?"))
{
$stmt->bind_param("i", $ids);
$stmt->execute();

$stmt->bind_result($ids, $dates, $fixture,$venue,$Result_KO_Time);
$stmt->fetch();

// show the form
renderForm($dates, $fixture,$venue,$Result_KO_Time, $ids);

$stmt->close();
}
// show an error if the query has an error
else
{
echo "Error: could not prepare SQL statement";
}
}
// if the 'id' value is not valid, redirect the user back to the view.php page
else
{
header("Location: view.php");
}
}
}



/*

NEW RECORD

*/
// if the 'id' variable is not set in the URL, we must be creating a new record
else
{
// if the form's submit button is clicked, we need to process the form
if (isset($_POST['submit']))
{
// get the form data
$dates = htmlentities($_POST['dates'], ENT_QUOTES);
$fixture= htmlentities($_POST['fixture'], ENT_QUOTES);
$venue = htmlentities($_POST['venue'], ENT_QUOTES);
$Result_KO_Time = htmlentities($_POST['Result_KO_Time'], ENT_QUOTES);
// check that firstname and lastname are both not empty
if ($dates == '' || $fixture == '' || $venue== '' )
{
// if they are empty, show an error message and display the form
$error = 'ERROR: Please fill in all required fields!';
renderForm($dates, $fixture,$venue,$Result_KO_Time, $error);
}
else
{
// insert the new record into the database
if ($stmt = $dbcon->prepare("INSERT fixtures (dates, fixture,venue,Result_KO_Time) VALUES (?,?,?,?)"))
{
$stmt->bind_param("ssss", $dates, $fixture,$venue,$Result_KO_Time);
$stmt->execute();
$stmt->close();
}
// show an error if the query has an error
else
{
echo "ERROR: Could not prepare SQL statement.";
}

// redirect the user
header("Location: view.php");
}

}
// if the form hasn't been submitted yet, show the form
else
{
renderForm();
}
}

// close the mysqli connection
$dbcon->close();
?>