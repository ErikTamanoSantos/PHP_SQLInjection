<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <h1>Login</h1>
        <label for="username">Username: </label>
        <input type="text" name="username" id="username"><br>
        <label for="password">Password: </label>
        <input type="password" name="password" id="password"><br>
        <input type="submit" value="Login"><br>
    </form>

    <?php 
    if (isset($_POST["username"])) {
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

        $username = $_POST["username"];
        $password = $_POST["password"];
        if (str_contains($username, ";") or str_contains($username, "--") or str_contains($username, "/*") or str_contains($username, "*/") or str_contains($password, ";") or str_contains($password, "--") or str_contains($password, "/*") or str_contains($password, "*/")) {
            echo "<p>Login incorrecte</p>";
        } else {
            $query = $pdo -> prepare("SELECT * FROM users WHERE username = ? AND password = SHA2(?, 512) ;");
            $query->bindParam(1, $username);
            $query->bindParam(2, $password);
            $query -> execute();

            $row = $query -> fetch();
            if ($row) {
                echo "<p>Welcome, ". $row["username"] ."!</p>";
            } else {
                echo "<p>Login incorrecte</p>";
            }
        }
    }

    // User 'erik', Password '123'
    ?>
</body>
</html>