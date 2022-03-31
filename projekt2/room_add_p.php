<?php
session_start();

if (isset($_SESSION['User'])) {
    require_once ("include/db_connect.php");
    $pdo = DB::connect();

    if (isset($_POST['name']) && isset($_POST['no'])) {
        $name = $_POST['name'];
        $no = $_POST['no'];
        $phone = $_POST['phone'];
        if (empty($name) || empty($no)) {
            header("Location: room_add.php?error=Vyplneni je potrebne");
            exit();
        }else {

            $stmt = $pdo->query("INSERT INTO room (no,name,phone) VALUES ('$no','$name','$phone')");

            header("Location: room_add.php?success=Mistnost přidana ");

        }
    }else  {
        header("Location: hesloform.php");
        exit();
    }






}else{
    header("Location: index.php");
    exit();
}