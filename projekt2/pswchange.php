<?php
session_start();

if (isset($_SESSION['User'])) {

    require_once ("include/db_connect.php");
    $pdo = DB::connect();


    if (isset($_POST['op']) && isset($_POST['np'])
        && isset($_POST['c_np'])) {

        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $op = validate($_POST['op']);
        $np = validate($_POST['np']);
        $c_np = validate($_POST['c_np']);

        if(empty($op)){
            header("Location: hesloform.php?error=Old Password is required");
            exit();
        }else if(empty($np)){
            header("Location: hesloform.php?error=New Password is required");
            exit();
        }else if($np !== $c_np){
            header("Location: hesloform.php?error=The confirmation password  does not match");
            exit();
        }else {
            // hashing the password
            $op =hash("sha256", $op);
            $np = hash("sha256", $np);
            $user = $_SESSION['User'];

            $sql = "SELECT password FROM employee WHERE login='$user' AND password='$op'";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) === 1){

                $sql_2 = "UPDATE employee SET password='$np' WHERE login='$user'";
                mysqli_query($con, $sql_2);
                header("Location: hesloform.php?success=Your password has been changed successfully");

            }else {
                header("Location: hesloform.php?error=Incorrect password");
            }

        }


    }else{
        header("Location: hesloform.php");
        exit();
    }

}else{
    header("Location: index.php");
    exit();
}