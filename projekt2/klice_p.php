<?php
session_start();
if(isset($_SESSION['User'])){
    require_once ("include/db_connect.php");
    $pdo = DB::connect();
    $empid = $_POST['empid'];

    $query = " DELETE FROM `key` WHERE employee=$empid";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    foreach($_POST['klic'] as $value){
        $query = " INSERT INTO `key` (employee,room)VALUE ($empid,$value)";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
    }
    header("Location: osoba.php?employee_id=$empid");

}else{
    header("location:index.php");
}