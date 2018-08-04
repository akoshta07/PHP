<?php
require_once "pdo.php";
 session_start();
?>
<?php 

if(isset($_SESSION['name'])){?>
    <html>
<head>
<title>Akash Koshta - Autos Database</title>
<link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" 
    crossorigin="anonymous">

<link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" 
    integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" 
    crossorigin="anonymous">

<link rel="stylesheet" 
    href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css">

<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>

<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
  integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
  crossorigin="anonymous"></script>
</head><body>
<div class="container">
<h2>Welcome to the Automobiles Database</h2>
<?php

if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}


if ( isset($_SESSION['success']) ) {
    echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
    unset($_SESSION['success']);
}

$stmt = $pdo->query("SELECT * FROM autos");
$empty = $stmt->fetch(PDO::FETCH_ASSOC);
if($empty != null){

echo('<table border="1">'."\n");

echo('<thead><tr>'."\n");
echo('<th>Make</th>');
echo('<th>Model</th>');
echo('<th>Year</th>');
echo('<th>Mileage</th>');
echo('<th>Action</th>');
echo('</tr></thead>');

while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    echo "<tr><td>";
    echo(htmlentities($row['make']));
    echo("</td><td>");
    echo(htmlentities($row['model']));
    echo("</td><td>");
    echo(htmlentities($row['year']));
    echo("</td><td>");
    echo(htmlentities($row['mileage']));
    echo("</td><td>");
    echo('<a href="edit.php?auto_id='.$row['auto_id'].'">Edit</a> / ');
    echo('<a href="delete.php?auto_id='.$row['auto_id'].'">Delete</a>');
    echo("</td></tr>\n");
}
}
else{
    echo('<p>No rows found</p>');
}
?>
</table>
<br/>
<a href="add.php">Add New Entry</a>
<br/>
<a href="logout.php">Logout</a>
</div>

<?php } 
?>


<?php
 if(!isset($_SESSION['name'])){
?>
<!DOCTYPE html>
<html>
<head>
<title>Akash Koshta - Autos Database</title>

<link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" 
    crossorigin="anonymous">

<link rel="stylesheet" 
    href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" 
    integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" 
    crossorigin="anonymous">

<link rel="stylesheet" 
    href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css">

<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>

<script
  src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
  integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
  crossorigin="anonymous"></script>

</head>
<body>
<div class="container">
<h2>Welcome to the Automobiles Database</h2>
<p><a href="login.php">Please log in</a></p>
<p>Attempt to <a href="add.php">Add New Entity</a> without logging in</p>
<?php
 }
?>