<?php
session_start();

if(isset($_SESSION['User']))
{
    require_once ("include/db_connect.php");
    $pdo = DB::connect();


    if(isset($_GET['order'])){
        $order=$_GET['order'];
    }else{
        $order='name';
    }
    if(isset($_GET['sort'])){
        $sort=$_GET['sort'];
    }else{
        $sort='ASC';
    }
    $stmt = $pdo->query("SELECT * FROM employee ORDER BY $order $sort");

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
    <title>Seznam lidí</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script>
    function ConfirmDelete()
    {
        return confirm("Are you sure you want to delete?");
    }

</script>
</head>
<body><div class="container">

    <?php if (isset($_GET['error'])) { ?>
        <p class="text-danger"><?php echo $_GET['error']; ?></p>
    <?php } ?>

    <?php if (isset($_GET['success'])) { ?>
        <p class="text-success"><?php echo $_GET['success']; ?></p>
    <?php } ?>
<?php 
$query = 'SELECT * FROM room WHERE room_id=?';
$stmt2 = $pdo->prepare($query);

$sort=='DESC'? $sort='ASC':$sort='DESC';

echo "<h1>Seznam zaměstnanců</h1>";
if($_SESSION['jeadm']==1){
    echo "<a href='lidi_add.php'class='btn btn-success '>Přidat</a></td>";

}

if($stmt->rowCount()==0){
    echo "databaze neobsahuje zadna data";
}
else{
    echo "<table class='table table-straped'>";
    echo "<thead><tr>
    <a href='prehled.php'><span class='glyphicon glyphicon-home'></span></a>
    <th><a href= '?order=name&&sort=$sort'>Jmeno</a></th>
    <th><a href= '?order=name&&sort=$sort'>Místnost</a></th>
    <th><a href= '?order=name&&sort=$sort'>Telefon</a></th>
    <th><a href= '?order=job&&sort=$sort'>Pozice</a></th>
    <th><a>Akce</a></th>
    </tr></thead>";

    echo "<tbody>";
    while($row=$stmt->fetch()){
        $stmt2->execute([$row->room]);
        $room = $stmt2->fetch();
        echo "<tr>";
        echo "<td><a href='osoba.php?employee_id={$row->employee_id}'>{$row->name} {$row->surname}</a></td>";
        echo "<td>".($room->name ?? "&mdash;")."</td>";
        echo "<td>".($room->phone ?? "&mdash;")."</td>";
        echo "<td>{$row->job}</td>";
        if($_SESSION['jeadm']==1){
            echo "<td><a href='update_e.php?id={$row->employee_id}'class='btn btn-success' >Update</a>";
            echo "<a href='delete_e.php?id={$row->employee_id}'class='btn btn-danger'"."onclick='return confirm(".'"Opravdu chces vymazat?"'.")'"." >Delete</a></td>";
        }else{
            echo "<td>nejsi admin</td>";
        }

        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
}

?>
</body>
</html>