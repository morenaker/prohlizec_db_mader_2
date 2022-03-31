<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prohlížeč databáze</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<?php
session_start();

if(isset($_SESSION['User']))
{
    echo'<div class="container">
            <h1>Prohlížeč databáze:  ' . $_SESSION['jmeno'].'</h1>
            <ul class="list-group">
                <li class="list-group-item"><a href="lidi.php">Seznam zaměstnanců</a></li>
                <li class="list-group-item"><a href="room.php">Seznam místností</a></li>
            </ul>
        </div>';

    echo '  <div class="position-absolute top-0 end-0"><a class="float-right" href="logout.php?logout">Logout</a></div>';
    echo '  <div class="position-absolute bottom-0 end-0"><a class="float-right" href="hesloform.php">Změna hesla</a></div>';


}
else
{
    header("location:index.php");
}
?>

    </body>
</html>