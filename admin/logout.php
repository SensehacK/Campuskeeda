<?php
session_start();
unset($_SESSION['curruser']);
session_destroy();
echo"<meta http-equiv=refresh content=\"0;url=index.php\">";
?>
