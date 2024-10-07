<?php

    if( !isset( $_SESSION['admin_id'] ) ) include( 'login.php' );
    else include('orders.php');
    //  exit( header('Location: home.php') );
?>
