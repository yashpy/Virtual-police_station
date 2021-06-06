<?php
    session_start();

    if(isset($_SESSION['email'])){
        unset($_SESSION['email']);
        unset($_SESSION['post']);
        session_destroy();
    }


    echo '<script>
    window.location="index.html";
    </script>';
 ?>
