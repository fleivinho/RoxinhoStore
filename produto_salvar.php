<?php
session_start();

if (!isset($_SESSION["id"]) || $_SESSION["tipo"] != "administrador") {
  header("Location: login.php");
  exit;
}

include "conecta.php";

if (
  !empty($_POST["nome"]) &&
  !empty($_POST["descricao"]) &&
  isset($_POST["preco"])
) {
  $id = (int) $_POST["id"];
  $nome = mysqli_real_escape_string($conexao, $_POST["nome"]);
  $descricao = mysqli_real_escape_string($conexao, $_POST["descricao"]);
  $preco = (float) str_replace(",", ".", $_POST["preco"]);
  $imagem = $_FILES["imagem"];

  if (isset($imagem) && $imagem != null && $_FILES["imagem"]["error"] == 0) {

    $pasta = "uploads/";

    if (!is_dir($pasta)) {
      mkdir($pasta, 0755, true);
    }

    $extensao = strtolower(pathinfo($_FILES["imagem"]["name"], PATHINFO_EXTENSION));

    $permitidas = ["jpg", "jpeg", "png", "gif", "webp"];

    if (in_array($extensao, $permitidas)) {

      $nomeArquivo = uniqid() . "." . $extensao;
      $caminho = $pasta . $nomeArquivo;

      if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $caminho)) {
        $imagem = mysqli_real_escape_string($conexao, $caminho);
      }
    }
  }

  $temTamanho = mysqli_num_rows(mysqli_query($conexao, "SHOW COLUMNS FROM produtos LIKE 'tamanho'")) > 0;
  $temQtd = mysqli_num_rows(mysqli_query($conexao, "SHOW COLUMNS FROM produtos LIKE 'qtd'")) > 0;

  if ($id > 0) {
    $sql = "UPDATE produtos SET nome = '$nome', descricao = '$descricao', preco = $preco, imagem = '$imagem' WHERE id = $id";
  } else {
    $campos = "nome, descricao, preco, imagem";
    $valores = "'$nome', '$descricao', $preco, '$imagem'";


    $sql = "INSERT INTO produtos($campos) VALUES($valores)";
  }

  mysqli_query($conexao, $sql);
}

header("Location: admin.php");
exit;
?>