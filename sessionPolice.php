<?php
session_start();

if (isset($_SESSION['valid_user'])){
    #echo "logged in as ".$_SESSION['valid_user'];
}

else {
    #echo "not logged in".$_SESSION['valid_user'];
    echo "<script>window.location.href='login.php'</script>";

}

?>