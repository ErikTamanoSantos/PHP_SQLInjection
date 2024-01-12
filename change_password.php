<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <h1>Canviar Contrasenya</h1>
        <label for="cur_pas">Contrasenya actual: </label>
        <input type="password" name="cur_pas" id="cur_pas"><br>
        <label for="new_pas">Contrasenya nova: </label>
        <input type="password" name="new_pas" id="new_pas"><br>
        <input type="submit" value="Confirmar"><br>
        <a href="dashboard.php">Tornar</a>
    </form>
    <?php
    session_start();
    if (isset($_POST["cur_pas"]) and isset($_POST["new_pas"])) {
        try {
            $hostname = "localhost";
            $dbname = "php_login";
            $username = "root";
            $pw = "Thyr10N191103!--";
            $pdo = new PDO("mysql:host=$hostname;dbname=$dbname", "$username", "$pw");
        } catch (PDOException $e) {
            echo "Failed to get DB handle: ". $e->getMessage();
            exit;
        }

        $username = $_SESSION["username"];
        $cur_pas = $_POST["cur_pas"];
        $new_pas = $_POST["new_pas"];
        if (str_contains($username, ";") or str_contains($username, "--") or str_contains($username, "/*") or str_contains($username, "*/") or str_contains($password, ";") or str_contains($password, "--") or str_contains($password, "/*") or str_contains($password, "*/")) {
            echo "<p>Contrasenya incorrecta</p>";
        } else {
            $query = $pdo -> prepare("SELECT * FROM users WHERE username = ? AND password = SHA2(?, 512) ;");
            $query->bindParam(1, $username);
            $query->bindParam(2, $cur_pas);
            $query -> execute();

            $row = $query -> fetch();
            if ($row) {
                $query = $pdo -> prepare("UPDATE users SET password = SHA2(?, 512) WHERE username = ?;");
                $query->bindParam(1, $new_pas);
                $query->bindParam(2, $username);
                $query -> execute();
                echo "<p>Contrasenya canviada correctament</p>";
            } else {
                echo "<p>Contrasenya incorrecta.</p>";
            }
        }
    }
    ?>
</body>
</html>