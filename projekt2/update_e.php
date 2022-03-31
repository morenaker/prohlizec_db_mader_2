<?php
session_start();
if (isset($_SESSION['User'])) {
    require_once ("include/db_connect.php");
    $pdo = DB::connect();

    $user_id = $_GET['id'];

    $ID = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

    $query = "SELECT * FROM employee  WHERE  employee_id=:ID";
    $stmt2 = $pdo->prepare($query);
    $stmt2->execute(["ID" => $ID]);
    $emp_d = $stmt2->fetch();
    $name=$emp_d->name;
    $surname=$emp_d->surname;
    $job=$emp_d->job;
    $wage=$emp_d->wage;
    $room=$emp_d->room;
    $empid=$emp_d->employee_id;

    $stmt = $pdo->query("SELECT * FROM room ");

    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    </head>
    <body>
    <div class="container mb-5">
        <form action="update_e_p.php" method="post">
            <h2>Změna hodnot</h2>
            <?php if (isset($_GET['error'])) { ?>
                <p class="text-danger"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="text-success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <p>
                <label for="1" class="form-label" >Jmeno:</label>
                <input id="1" class="form-control" type="text" name="name" value="<?php echo $name; ?>" >
                <input type="hidden" name="empid" value="<?php echo $empid; ?>">
            </p>
            <p>
                <label for="2" class="form-label" >Prijmeni:</label>
                <input id="2" class="form-control" type="text" name="surname" value="<?php echo $surname; ?>" >
            </p>
            <p>
                <label for="3" class="form-label" >Prace:</label>
                <input id="3" class="form-control" type="text" name="job" value="<?php echo $job; ?>" >
            </p>
            <p>
                <label for="4" class="form-label" >Plat:</label>
                <input  id="4" class="form-control" type="number" name="wage" value="<?php echo $wage; ?>" >
            </p>
            <select class="form-select" aria-label="Default select example" name="room">

            <?php
            while($row=$stmt->fetch()){
                if($row->room_id==$room){
                    echo "<option value='$row->room_id' selected>$row->name</option>";
                }
                else{
                    echo "<option value='$row->room_id'>$row->name</option>";
                }

            }
            echo "<a href='osoba.php?employee_id=$empid'>Klíče</a>"
            ?>
        </select>
        </br>
            <button class="btn btn-primary" type="submit">Změnit</button>
            </br>
            <a href="prehled.php" class="ca">DOMU</a>
        </form>
    </div>
    </body>
    </html>

<?php
}else{
    header("Location: index.php");
    exit();
}
?>
