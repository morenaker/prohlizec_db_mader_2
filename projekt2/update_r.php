<?php
session_start();
if (isset($_SESSION['User'])) {
    require_once ("include/db_connect.php");
    $pdo = DB::connect();

    $user_id = $_GET['id'];

    $ID = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

    $query = "SELECT * FROM room  WHERE  room_id=:ID";
    $stmt = $pdo->prepare($query);
    $stmt->execute(["ID" => $ID]);
    $room_d = $stmt->fetch();
    $name=$room_d->name;
    $no=$room_d->no;
    $phone=$room_d->phone;
    $roomid=$room_d->room_id;
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
        <form action="update_r_p.php" method="post">
            <h2>Změna hodnot</h2>
            <?php if (isset($_GET['error'])) { ?>
                <p class="text-danger"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="text-success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <p>
                <label class="form-label" >Jmeno:</label>
                <input class="form-control" type="text" name="name" value="<?php echo $name; ?>" >
                <input type="hidden" name="roomid" value="<?php echo $roomid; ?>">
            </p>
            <p>
                <label class="form-label" >Telefon:</label>
                <input class="form-control" type="number" name="phone" value="<?php echo $phone; ?>" >
            </p>
            <p>
                <label class="form-label" >Cislo:</label>
                <input class="form-control" type="number" name="no" value="<?php echo $no; ?>" >
            </p>

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
