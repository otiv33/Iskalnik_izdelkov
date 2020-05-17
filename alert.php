<?php
function alert($msg) {
      echo "<script type='text/javascript'>alert('$msg');</script>";
  }

  function consoleLog($msg) {
    echo "<script type='text/javascript'>Console.log('$msg');</script>";
}
?>