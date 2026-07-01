<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Criar conta</title>
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

    .voltar {
      display: block;
      text-align: center;
      border-radius: 20px;
      background-color: white;
      color: black;
      padding: 10px;
      text-decoration: none;
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <div id="principal">
    <form action="inserir.php" method="POST">
      <div style="text-align:center;">
        <h1>Registre-se</h1>
        <p>Crie sua conta na loja</p>
      </div>
      <div class="caixa">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>
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
        <input class="botao" type="submit" value="Cadastrar">
      </div>
      <a class="voltar" href="login.php">Voltar para o login</a>
      <p style="color:white; text-align:center;">Acesso em <?php echo date("d/m/Y"); ?></p>
    </form>
  </div>
</body>

</html>
