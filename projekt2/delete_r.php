<?php
session_start();
if(isset($_SESSION['User']))
{
    require_once ("include/db_connect.php");
    $pdo = DB::connect();

    $ID = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

    $query = " DELETE FROM `key` WHERE room=:ID";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":ID",$ID);
    $stmt->execute();

    $query = " UPDATE employee SET room=NULL WHERE room=:ID";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":ID",$ID);
    $stmt->execute();

    $query = " DELETE FROM room WHERE room_id=:ID";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":ID",$ID);
    $stmt->execute();

    header("Location: room.php?success=Mistnost odebrana ");

}
else
{
    header("location:index.php");

}
