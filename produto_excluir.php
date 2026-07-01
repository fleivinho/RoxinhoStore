<?php
session_start();

if (!isset($_SESSION["id"]) || $_SESSION["tipo"] != "administrador") {
  header("Location: login.php");
  exit;
}

include "conecta.php";

if (!empty($_GET["id"])) {
  $id = (int) $_GET["id"];
  mysqli_query($conexao, "DELETE FROM compras WHERE produto_id = $id");
  mysqli_query($conexao, "DELETE FROM produtos WHERE id = $id");
}

header("Location: admin.php");
exit;
?>
