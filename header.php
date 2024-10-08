<?php include 'server/connection.php';
    $error='';
    //verificar se a sessão está ativa
    if(session_id() == '' || !isset($_SESSION) || session_status() === PHP_SESSION_NONE) {
        // session isn't started
        session_start();
    }


    //if( !isset( $_SESSION ) ) session_start();
    
?>
