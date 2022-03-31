<?php
require_once ("include/db_connect.php");
$pdo = DB::connect();

session_start();
if(isset($_POST['Login']))
{
    $psw=$_POST['Password'];
    $hpsw = hash("sha256", $psw);
    if(empty($_POST['UName']) || empty($_POST['Password']))
    {
        header("location:index.php?Empty= Prosím vyplňte všechny políčka! ");
    }
    else
    {
        $stmt = $pdo->query("SELECT * FROM employee where login='".$_POST['UName']."' and password='$hpsw'");
        if($stmt->rowCount()==1)
        {
            $_SESSION['User']=$_POST['UName'];
            $data = $stmt->fetch();
            $jead=$data->admin;
            $jmeno=$data->name;
            $_SESSION['jmeno']=$jmeno;
            $_SESSION['jeadm']=$jead;
            header("location:prehled.php");

        }
        else
        {
            header("location:index.php?Invalid= Spatne Jmeno nebo heslo");
        }
    }
}
else
{
    echo 'Not Working Now Guys';
}

?>