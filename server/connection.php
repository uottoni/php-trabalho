<?php
    // Configurações do banco de dados
    $servername = "192.168.0.99";
    $username = "ulisses";
    $password = "testeteste";
    $dbname = "project_db";
    // Criar conexão

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    

    // Verificar conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

    // echo "Conexão bem-sucedida!";
    ?>