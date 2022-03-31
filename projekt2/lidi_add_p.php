<?php
session_start();

if (isset($_SESSION['User'])) {
    require_once ("include/db_connect.php");
    $pdo = DB::connect();

    if (isset($_POST['name']) && isset($_POST['surname'])&& isset($_POST['job'])&&isset($_POST['wage'])&&isset($_POST['room'])&&isset($_POST['login'])&&isset($_POST['password'])) {
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $job = $_POST['job'];
        $wage = $_POST['wage'];
        $login = $_POST['login'];
        $password = $_POST['password'];
        $hpsw = hash("sha256", $password);
        $room=$_POST['room'];


        if (empty($name) || empty($surname) || empty($job) || empty($wage)|| empty($room)|| empty($login)|| empty($password)||$room==0) {
            header("Location: lidi_add.php?error=Vyplneni je potrebne");
            exit();
        }else {
            $stmt = $pdo->query("INSERT INTO employee (name,surname,job,wage,room,login,password) VALUES ('$name','$surname','$job','$wage','$room','$login','$hpsw')");


            header("Location: lidi.php?success=Clovek pridan");

        }
    }else  {
        header("Location: hesloform.php");
        exit();
    }






}else{
    header("Location: index.php");
    exit();
}