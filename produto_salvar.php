<?php
session_start();

if (!isset($_SESSION["id"]) || $_SESSION["tipo"] != "administrador") {
  header("Location: login.php");
  exit;
}

include "conecta.php";

if (!empty($_POST["nome"]) && !empty($_POST["descricao"]) && isset($_POST["preco"]) && !empty($_POST["imagem"])) {
  $id = (int) $_POST["id"];
  $nome = mysqli_real_escape_string($conexao, $_POST["nome"]);
  $descricao = mysqli_real_escape_string($conexao, $_POST["descricao"]);
  $preco = (float) str_replace(",", ".", $_POST["preco"]);
  $imagem = mysqli_real_escape_string($conexao, $_POST["imagem"]);
  $temTamanho = mysqli_num_rows(mysqli_query($conexao, "SHOW COLUMNS FROM produtos LIKE 'tamanho'")) > 0;
  $temQtd = mysqli_num_rows(mysqli_query($conexao, "SHOW COLUMNS FROM produtos LIKE 'qtd'")) > 0;

  if ($id > 0) {
    $sql = "UPDATE produtos SET nome = '$nome', descricao = '$descricao', preco = $preco, imagem = '$imagem' WHERE id = $id";
  } else {
    $campos = "nome, descricao, preco, imagem";
    $valores = "'$nome', '$descricao', $preco, '$imagem'";

    if ($temTamanho) {
      $campos .= ", tamanho";
      $valores .= ", ''";
    }

    if ($temQtd) {
      $campos .= ", qtd";
      $valores .= ", 0";
    }

    $sql = "INSERT INTO produtos($campos) VALUES($valores)";
  }

  mysqli_query($conexao, $sql);
}

header("Location: admin.php");
exit;
?>
