<?php
session_start();

if (!isset($_SESSION["id"])) {
  header("Location: login.php");
  exit;
}

include "conecta.php";

$id = 0;
$finalizado = false;

if (!empty($_GET["id"])) {
  $id = (int) $_GET["id"];
}

if (!empty($_POST["produto_id"])) {
  $id = (int) $_POST["produto_id"];
  $usuario_id = (int) $_SESSION["id"];
  $sqlProduto = "SELECT * FROM produtos WHERE id = $id";
  $resultadoProduto = mysqli_query($conexao, $sqlProduto);

  if (mysqli_num_rows($resultadoProduto) > 0) {
    $produtoCompra = mysqli_fetch_assoc($resultadoProduto);
    $preco = (float) $produtoCompra["preco"];
    mysqli_query($conexao, "INSERT INTO compras(usuario_id, produto_id, preco, data_compra) VALUES($usuario_id, $id, $preco, NOW())");
   
    mysqli_query($conexao, "
      UPDATE produtos
      SET vendas = vendas + 1
      WHERE id = $id
    ");

    $finalizado = true;
  }
}

$sql = "SELECT * FROM produtos WHERE id = $id";
$resultado = mysqli_query($conexao, $sql);

if ($id <= 0 || mysqli_num_rows($resultado) == 0) {
  header("Location: site.php");
  exit;
}

$produto = mysqli_fetch_assoc($resultado);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pagamento</title>
  <link rel="stylesheet" href="navbar.css">
  <style>
    * {
      box-sizing: border-box;
      font-family: Arial, Helvetica, sans-serif;
    }

    body {
      margin: 0;
      background-color: #2c313c;
      color: white;
    }

    .box {
      width: 360px;
      max-width: 92%;
      margin: 45px auto;
      padding: 22px;
      text-align: center;
      background-color: whitesmoke;
      color: #222;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .produto {
      width: 230px;
      max-width: 100%;
      height: 170px;
      object-fit: cover;
      border-radius: 10px;
      background-color: #ddd;
    }

    .pix {
      width: 180px;
      margin-top: 10px;
      border-radius: 10px;
    }

    .preco {
      color: purple;
      font-size: 24px;
    }

    button,
    .botao {
      border: none;
      padding: 14px;
      color: white;
      background-color: #6f00ff;
      text-align: center;
      cursor: pointer;
      width: 100%;
      font-size: 17px;
      text-decoration: none;
      display: block;
      margin-top: 10px;
    }

    .voltar {
      background-color: #555;
    }

    .sucesso {
      color: green;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <?php
  $paginaAtual = "site";
  include "navbar.php";
  ?>

  <div class="box">
    <h1><?php echo htmlspecialchars($produto["nome"]); ?></h1>
    <img class="produto" src="<?php echo htmlspecialchars($produto["imagem"]); ?>"
      alt="<?php echo htmlspecialchars($produto["nome"]); ?>">
    <p><?php echo htmlspecialchars($produto["descricao"]); ?></p>
    <p class="preco">R$ <?php echo number_format($produto["preco"], 2, ",", "."); ?></p>

    <?php if ($finalizado) { ?>
      <p class="sucesso">Compra registrada com sucesso.</p>
    <?php } else { ?>
      <h2>Pagamento PIX</h2>
      <img class="pix" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRM5JAVC0_zJa7U5KLUh-GH_F__ddzHLDmx_w&s"
        alt="PIX">
      <p>Escaneie para pagar e finalize a compra.</p>
      <form action="pagar.php?id=<?php echo $produto["id"]; ?>" method="POST">
        <input type="hidden" name="produto_id" value="<?php echo $produto["id"]; ?>">
        <button type="submit">Finalizar compra</button>
      </form>
    <?php } ?>

    <a class="botao voltar" href="site.php">Voltar para a loja</a>
  </div>
</body>

</html>