<!doctype html>
<html lang="en">
<?php
session_start();

if (isset($_SESSION['User'])) {
    require_once ("include/db_connect.php");
    $pdo = DB::connect();

    if (isset($_POST['name']) && isset($_POST['no'])&& isset($_POST['phone'])) {
        $name = $_POST['name'];
        $no = $_POST['no'];
        $phone = $_POST['phone'];
        $roomid = $_POST['roomid'];
        if (empty($name) || empty($no) || empty($phone)) {
            header("Location: update_r.php?id=$roomid");
            exit();
        }else {

            $stmt = $pdo->query("UPDATE room SET name='$name',no='$no',phone='$phone' WHERE room_id='$roomid'");

            header("Location: room.php?success=Data změněna dobře'$name' ");

        }
    }else  {
        header("Location: lidi.php");
        exit();
    }






}else{
    header("Location: index.php");
    exit();
}
