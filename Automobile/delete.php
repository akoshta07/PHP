<?php 
 require_once "pdo.php";
 session_start();
?>
<?php
if(isset($_SESSION['name'])){

if ( isset($_POST['delete']) && isset($_POST['auto_id']) ) {
    $sql = "DELETE FROM autos WHERE auto_id = :auto_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':auto_id' => $_POST['auto_id']));
    $_SESSION['success'] = 'Record deleted';
    header( 'Location: index.php' ) ;
    return;
}


$stmt = $pdo->prepare("SELECT make, auto_id FROM autos where auto_id = :auto_id");
$stmt->execute(array(":auto_id" => $_GET['auto_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for user_id';
    header( 'Location: index.php' ) ;
    return;
}
}
?>
<?php
 if(isset($_SESSION['name'])){
?>
<!DOCTYPE html>
<html>
<head>
<title>Akash Koshta - Autos Database</title>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

</head>
<body>
<div class="container">
<h1>DELETE Automobile</h1>

<p>Confirm: Deleting <?= htmlentities($row['make']) ?></p>

<form method="post">
<input type="hidden" name="auto_id" value="<?= $row['auto_id'] ?>">
<input type="submit" value="Delete" name="delete">
<a href="index.php">Cancel</a>
</form>

<?php 
}
else{
    die('ACCESS DENIED');
}
?>