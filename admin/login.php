<?php
include 'header.php';

if (isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])) {
    header('Location: orders.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM admins WHERE admin_email = '$usuario' AND admin_password = '$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['admin_email'] = $row['admin_email'];
        $_SESSION['admin_name'] = $row['admin_name'];
        $_SESSION['admin_id'] = $row['admin_id'];
        header('Location: orders.php');
    } else {
        $error = 'Usuário ou senha inválidos';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/dashboard/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
    <title>Login</title>
</head>

<body>

    <div class="content">
        <div class="row justify-content-center mt-5">
            <div class="col-sm-12 col-md-6 col-lg-3">
                <h2>Login</h2>
                <form action="login.php" method="post">
                    <label for="usuario">Usuário:</label>
                    <input class="form-control" type="text" id="usuario" name="usuario" required><br><br>
                    <label for="senha">Senha:</label>
                    <input class="form-control" type="password" id="senha" name="senha" required><br><br>
                    <span class="text-danger"><?php if(!is_null($error)) echo $error; ?></span><br><br>
                    <button class="btn btn-success" type="submit">Entrar</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>