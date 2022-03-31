<?php
session_start();

if (isset($_SESSION['User'])) {

    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Change Password</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    </head>
    <body>
    <div class="container mb-5">
    <form action="pswchange.php" method="post">
        <h2>Change Password</h2>
        <?php if (isset($_GET['error'])) { ?>
            <p class="text-danger"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
            <p class="text-success"><?php echo $_GET['success']; ?></p>
        <?php } ?>

        <p>
            <label class="form-label" >Zadej staré heslo:</label>
            <input class="form-control" type="password" name="op" placeholder="Staré Heslo" >
        </p>
        <p>
            <label class="form-label" >Zadej nové heslo:</label>
            <input class="form-control" type="password" name="np" placeholder="Nové Heslo" >
        </p>
        <p>
            <label class="form-label" >Znovu Nové Heslo:</label>
            <input class="form-control" type="password" name="c_np" placeholder="Znovu Nové Heslo" >
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