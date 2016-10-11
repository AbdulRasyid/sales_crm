<?php

ob_start();
  session_start();
  session_destroy();

  header('location:index.php?notif=4');
  
  //echo "<center>Anda telah sukses keluar sistem <b>[LOGOUT]<b>";
?>
