<?php 

    include 'sessionPolice.php';
    session_destroy();
    # maybe can add an alert to inform user has logged out
    echo "<script>window.location.href='index.php'</script>";

?>
