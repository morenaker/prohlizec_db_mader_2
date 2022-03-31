<!DOCTYPE html>
<html lang="en">

<head>
    <title>Přidat Slovo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>

<body>
<div class="container mb-5">
    <h1>Login</h1>
    <form action="process.php" method="post">

        <p>
            <label class="form-label" for="jmeno">Jméno:</label>
            <input class="form-control" type="text" name="UName" >
        </p>

        <p>
            <label class="form-label" for="heslo">Heslo:</label>
            <input class="form-control" type="password" name="Password">
        </p>

        <input class="btn btn-primary" type="submit" name="Login" value="Login">
    </form>
    <?php
    if(@$_GET['Empty']==true)
    {
        ?>
        <div class="text-danger"><?php echo $_GET['Empty'] ?></div>
        <?php
    }
    ?>

    <?php
    if(@$_GET['Invalid']==true)
    {
        ?>
        <div class="text-danger "><?php echo $_GET['Invalid'] ?></div>
        <?php
    }
    ?>
</div>
</body>

</html>
