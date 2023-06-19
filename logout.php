<?php
    // anytime if we start use session we need to call session_start()
    session_start();
    // destroy the session
    session_destroy();
    header("Location: index.php");
    exit;
?>