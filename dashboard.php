<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php session_start(); ?>
    <h1>Dashboard</h1>
    <h4>Benvolgut, <?php echo $_SESSION["username"] ?></h4>
    <ul>
        <li><a href="add_user.php">Afegir usuari</a></li>
        <li><a href="change_password.php">Canviar contrasenya</a></li>
        <li><a href="segur.php">Tancar sessió</a></li>
    </ul>
</body>
</html>