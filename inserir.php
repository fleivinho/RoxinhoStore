<?php
include "conecta.php";

if (!empty($_POST["nome"]) && !empty($_POST["email"]) && !empty($_POST["senha"])) {
  $nome = mysqli_real_escape_string($conexao, $_POST["nome"]);
  $email = mysqli_real_escape_string($conexao, $_POST["email"]);
  $senha = mysqli_real_escape_string($conexao, $_POST["senha"]);

  $sql = "INSERT INTO usuarios(nome, email, senha, tipo) VALUES('$nome', '$email', '$senha', 'usuario')";

  if (mysqli_query($conexao, $sql)) {
    header("Location: login.php");
    exit;
  } else {
    echo "Erro: " . mysqli_error($conexao);
  }
} else {
  echo "Envie todos os dados para registro.";
}
?>
