
<?php include 'header.php'; ?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST['user_name'];
    $userEmail = $_POST['user_email'];
    $userPassword = password_hash($_POST['user_password'], PASSWORD_BCRYPT);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $userName, $userEmail, $userPassword);

    if ($stmt->execute()) {
        //echo "New record created successfully";
        $redirect_url = isset($_GET['redirect']) ? $_GET['redirect'] : 'products.php';
        header('Location: ' . $redirect_url);
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Cadastro</h2>
        <form action="cadastro.php" method="POST">
            <div class="form-group">
                <label for="user_name">Nome</label>
                <input type="text" class="form-control" id="user_name" name="user_name" required>
            </div>
            <div class="form-group">
                <label for="user_email">Email</label>
                <input type="email" class="form-control" id="user_email" name="user_email" required>
            </div>
            <div class="form-group">
                <label for="user_password">Senha</label>
                <input type="password" class="form-control" id="user_password" name="user_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>