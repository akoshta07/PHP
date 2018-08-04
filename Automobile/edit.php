<?php
session_start();
 require_once "pdo.php";

if(isset($_SESSION['name'])){
    if (isset($_POST['logout'])){
        header("Location:index.php");
        return;
    }
    if(isset($_POST['year']) && isset($_POST['mileage']) && isset($_POST['make']) && isset($_POST['model'])){
    
        if(strlen($_POST['make'])<1 || strlen($_POST['model'])<1){
            $_SESSION['fail']="All fields are required";
            header('Location:edit.php?auto_id='.$_GET['auto_id']);
            return;
        }

        else if(!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])){
            $_SESSION['fail']="Mileage and year must be numeric";
            header('Location:edit.php?auto_id='.$_GET['auto_id']);
            return;
        } 
        else{
        $query = "UPDATE autos SET make = :mk, model = :md, year =:yr, mileage=:mi 
        WHERE auto_id = :auto_id";
        $stmt = $pdo ->prepare($query);
        $stmt->execute(array(
            ':mk'=>$_POST['make'],
            ':md'=>$_POST['model'],
            ':yr'=>$_POST['year'],
            ':mi'=>$_POST['mileage'],
            ':auto_id'=>$_POST['auto_id'])
        );
        $_SESSION['success']="Record inserted";
        header('Location:index.php');
    }
    

    }
} 
?>


<?php
if(isset($_SESSION['name'])){

    $stmt = $pdo->prepare("SELECT * FROM autos where auto_id = :auto_id");
$stmt->execute(array(":auto_id" => $_GET['auto_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for user_id';
    header( 'Location: index.php' ) ;
    return;
}
$a = htmlentities($row['make']);
$b = htmlentities($row['model']);
$c = htmlentities($row['year']);
$d = htmlentities($row['mileage']);
$auto_id = $row['auto_id'];
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
<h1>Editing Automobile</h1>

<?php
// Note triple not equals and think how badly double
// not equals would work here...
if (isset($_SESSION['fail']) ) {
    // Look closely at the use of single and double quotes
    echo('<p style="color: red;">'.htmlentities($_SESSION['fail'])."</p>\n");
    unset($_SESSION['fail']);
}
?>

<form method="post">
<p>Make:
<input type="text" name="make" size="60" value="<?= $a ?>"/></p>
<p>Model:
<input type="text" name="model" value="<?= $b ?>"/></p>
<p>Year:
<input type="text" name="year" value="<?= $c ?>"/></p>
<p>Mileage:
<input type="text" name="mileage" value="<?= $d ?>"/></p>
<input type="hidden" name="auto_id" value="<?= $auto_id ?>"/></p>
<input type="submit" value="Save">
<input type="submit" name="logout" value="Cancel">
</form>

<?php
}
else{
    die('ACCESS DENIED');
}
?>