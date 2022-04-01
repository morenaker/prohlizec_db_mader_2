<!doctype html>
<html lang="en">
<?php
session_start();

if (isset($_SESSION['User'])) {
    require_once ("include/db_connect.php");
    $pdo = DB::connect();

    if (isset($_POST['name']) && isset($_POST['surname'])&& isset($_POST['job'])&&isset($_POST['wage'])) {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $job = $_POST['job'];
        $wage = $_POST['wage'];
        $empid = $_POST['empid'];
        $room=$_POST['room'];
        if (empty($name) || empty($surname) || empty($job) || empty($wage)|| $room==0) {
            header("Location: update_e.php?id=$empid");
            exit();
        }else {
            $stmt = $pdo->query("UPDATE employee SET name='$name',surname='$surname',job='$job',wage='$wage', room='$room' WHERE employee_id='$empid'");


            header("Location: lidi.php?success=Data změněna dobře'$room' ");

        }
    }else  {
        header("Location:lidi.php");
        exit();
    }






}else{
    header("Location: index.php");
    exit();
}
