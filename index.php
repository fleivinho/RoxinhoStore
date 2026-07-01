<?php
session_start();

if (isset($_SESSION["id"])) {
  header("Location: site.php");
} else {
  header("Location: login.php");
}

exit;
?>
