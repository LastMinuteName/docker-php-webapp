<?php
    session_destroy();
    header('Location: '.$uri.'/index.php/');
?>