<?php
session_start();
include "conecta.php";

$erro = "";

if (!empty($_POST["email"]) && !empty($_POST["senha"])) {
  $email = mysqli_real_escape_string($conexao, $_POST["email"]);
  $senha = mysqli_real_escape_string($conexao, $_POST["senha"]);

  $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
  $resultado = mysqli_query($conexao, $sql);

  if (mysqli_num_rows($resultado) > 0) {
    $usuario = mysqli_fetch_assoc($resultado);
    $_SESSION["id"] = $usuario["id"];
    $_SESSION["nome"] = $usuario["nome"];
    $_SESSION["email"] = $usuario["email"];
    $_SESSION["tipo"] = $usuario["tipo"];

    if ($usuario["tipo"] == "administrador") {
      header("Location: admin.php");
    } else {
      header("Location: site.php");
    }
    exit;
  } else {
    $erro = "E-mail ou senha inválidos";
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <style>
    * {
      box-sizing: border-box;
      font-family: Arial, Helvetica, sans-serif;
    }

    body {
      color: white;
      margin: 0;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      background-color: #111;
    }

    #principal {
      width: 330px;
      padding: 24px;
      background-color: #1d1d1d;
      border-radius: 20px;
    }

    .caixa {
      padding-bottom: 15px;
    }

    input {
      border-radius: 20px;
      width: 100%;
      padding: 10px;
      border: none;
      margin-top: 5px;
    }

    h1 {
      text-align: center;
      margin-bottom: 5px;
    }

    .botao {
      width: 100%;
      color: white;
      background: #6f00ff;
      cursor: pointer;
    }

    .criar {
      display: block;
      text-align: center;
      border-radius: 20px;
      background-color: white;
      color: black;
      padding: 10px;
      text-decoration: none;
      margin-top: 10px;
    }

    .erro {
      color: #ff7070;
      text-align: center;
    }
  </style>
</head>

<body>
  <div id="principal">
    <form action="login.php" method="POST">
      <div style="text-align:center;">
        <h1>Conecte-se</h1>
        <p>Entre na Roxinho Store</p>
      </div>
      <div class="caixa">
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" required>
      </div>
      <div class="caixa">
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
      </div>
      <div>
        <input class="botao" type="submit" value="Entrar">
      </div>
    </form>
    <a class="criar" href="criarconta.php">Criar nova conta</a>
    <?php if ($erro != "") { ?>
      <p class="erro"><?php echo $erro; ?></p>
    <?php } ?>
    <p style="color:white; text-align:center;">Acesso em <?php echo date("d/m/Y"); ?></p>
  </div>
</body>

</html>
