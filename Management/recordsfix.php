<?php
/*
Allows the user to both create new records and edit existing records
*/

// connect to the database
include '../connection.php';


include 'auth.php';



// creates the new/edit record form
// form  used multiple times created function
function renderForm($dates = '', $fixture ='',$venue='',$Result_KO_Time= '', $error = '', $id = '')
{ ?>

<html>
<head>
<title>
<?php if ($id != '') { echo "Edit Record"; } else { echo "New Record"; } ?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1><?php if ($id != '') { echo "Edit Record"; } else { echo "New Record"; } ?></h1>
<?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error
. "</div>";
} ?>

<form action="" method="post">
<div>
<?php if ($id != '') { ?>
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<p>ID: <?php echo $id; ?></p>
<?php } ?>

<strong>Date: *</strong> <input type="text" name="firstname"
value="<?php echo $dates; ?>"/><br/>
<strong>Fixture: *</strong> <input type="text" name="lastname"
value="<?php echo $fixture; ?>"/><br/>
<strong>Venue: *</strong> <input type="text" name="Available"
value="<?php echo $venue; ?>"/><br/>
<strong>Result/KO Time: *</strong> <input type="text" name="Available"
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
if (isset($_GET['id']))
{
// if the form's submit button is clicked, we need to process the form
if (isset($_POST['submit']))
{
// make sure the 'id' in the URL is valid
if (is_numeric($_POST['id']))
{
// get variables from the URL/form
$id = $_POST['id'];
$dates = htmlentities($_POST['dates'], ENT_QUOTES);
$fixture= htmlentities($_POST['fixture'], ENT_QUOTES);
$venue = htmlentities($_POST['venue'], ENT_QUOTES);
$Result_KO_Time = htmlentities($_POST['Result_KO_Time'], ENT_QUOTES);
// check that firstname and lastname are both not empty
if ($dates == '' || $fixture == '' || $venue== '' )
{
// if they are empty, show an error message and display the form
$error = 'ERROR: Please fill in all required fields!';
renderForm($dates, $fixture,$venue,$Result_KO_Time, $error, $id);
}
else
{
// if everything is fine, update the record in the database
if ($stmt = $dbcon->prepare("UPDATE Fixtures SET dates = ?, fixture = ?,venue = ?,Result_KO_Time = ?
WHERE id=?"))
{
$stmt->bind_param("ssssi", $dates, $fixture,$venue,$Result_KO_Time, $id);
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
if (is_numeric($_GET['id']) && $_GET['id'] > 0)
{
// get 'id' from URL
$id = $_GET['id'];

// get the record from the database
if($stmt = $dbcon->prepare("SELECT * FROM Fixtures WHERE id=?"))
{
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->bind_result($id, $dates, $fixture,$venue,$Result_KO_Time);
$stmt->fetch();

// show the form
renderForm($dates, $fixture,$venue,$Result_KO_Time, $id);

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
if ($stmt = $dbcon->prepare("INSERT Fixtures (dates, fixture,venue,Result_KO_Time) VALUES (?,?,?,?)"))
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