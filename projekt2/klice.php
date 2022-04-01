<?php
session_start();
if(isset($_SESSION['User']))
{
    require_once ("include/db_connect.php");
    $pdo = DB::connect();

    $state = "OK";
    $employeeId = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
    if ($employeeId === null) {
        http_response_code(400); //bad request
        $state = "BadRequest";
    } else {
        $stmt = $pdo->query("SELECT * FROM room ");
//        $query2 = "SELECT * FROM room AS r INNER JOIN `key` AS k ON(r.room_id=k.room) WHERE 	employee=:employeeId";
        $query2 = "SELECT * FROM room AS r JOIN `key` AS k ON(r.room_id=k.room) WHERE 	employee=:employeeId";

        $stmt2 = $pdo->prepare($query2);
        $stmt2->execute(["employeeId" => $employeeId]);
        if ($stmt2->rowCount() == 0) {
            http_response_code(404);
            $state = "NotFound";
        }
    }
}
else
{
    header("location:index.php");

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<body class="container">

<?php

    $maklice = array();
    echo "<form action='klice_p.php' method='post'>";
    while ($row = $stmt2->fetch()) {
        array_push($maklice,$row->room_id);
    };
    $kontrola=0;
    $length=count($maklice)-1;
    while($row=$stmt->fetch()){

        for ($i=0;$i<=$length;$i++){
            if($row->room_id==$maklice[$i]){
                $kontrola++;
                echo"<input type='checkbox' id='$row->room_id' value='$row->room_id' name='klic[]' checked >
                <label for='$row->room_id'>$row->name</label><br>";
            }
        }
        if($kontrola==0){
            echo"<input id='$row->room_id' type='checkbox' value='$row->room_id' name='klic[]' >
            <label for='$row->room_id' >$row->name</label><br>";
        }
        else{
            $kontrola=0;
        }
    }
/*    <input type="hidden" name="empid" value="<?php echo $e; ?>">*/
    echo"<input type='hidden' name='empid' value='$employeeId'>";
    echo'<button class="btn btn-primary" type="submit">Aktualizovat</button>
    </form>            <a href="prehled.php" class="ca">DOMU</a>
';



?>
</body>
</html>
