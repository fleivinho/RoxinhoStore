<?php
session_start();

if (!isset($_SESSION["id"])) {
  header("Location: login.php");
  exit;
}

include "conecta.php";
$sql = "SELECT * FROM produtos ORDER BY id DESC";
$resultado = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Roxinho Store</title>
  <link rel="stylesheet" href="navbar.css">
  <style>
    * {
      box-sizing: border-box;
      font-family: Arial, Helvetica, sans-serif;
    }

    body {
      margin: 0;
      background-color: #2c313c;
      color: #222;
    }

    .topo {
      color: white;
      text-align: center;
      padding: 30px 15px 10px;
    }

    .topo h1 {
      margin: 0;
      font-size: 34px;
    }

    .cards {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
      padding: 20px;
      min-height: 60vh;
    }

    .card {
      background-color: whitesmoke;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      width: 300px;
      text-align: center;
      display: flex;
      flex-direction: column;
    }

    .card .imagem {
      width: 100%;
      height: 190px;
      object-fit: cover;
      background-color: #ddd;
    }

    .card h2 {
      font-size: 20px;
      margin: 15px 12px 5px;
    }

    .desc {
      font-size: 14px;
      min-height: 50px;
      padding: 0 12px;
    }

    .price {
      color: purple;
      font-size: 22px;
      margin-top: auto;
    }

    .card button {
      border: none;
      outline: 0;
      padding: 16px;
      color: white;
      background-color: #6f00ff;
      text-align: center;
      cursor: pointer;
      width: 100%;
      font-size: 18px;
    }

    .card button:hover {
      opacity: 0.7;
    }

    .vazio {
      color: white;
      text-align: center;
      width: 100%;
      font-size: 20px;
    }

    @media screen and (max-width: 600px) {}
  </style>
</head>

<body>
  <?php
  $paginaAtual = "site";
  include "navbar.php";
  ?>

  <div class="topo">
    <h1>Roxinho Store</h1>
    <p>A loja número 1 da américa latina.</p>
  </div>

  <div class="cards" id="produtos">
    <?php if (mysqli_num_rows($resultado) > 0) { ?>
      <?php while ($produto = mysqli_fetch_assoc($resultado)) { ?>
        <div class="card">
          <img class="imagem" src="<?php echo htmlspecialchars($produto["imagem"]); ?>"
            alt="<?php echo htmlspecialchars($produto["nome"]); ?>">
          <h2><?php echo htmlspecialchars($produto["nome"]); ?></h2>
          <p class="desc"><?php echo htmlspecialchars($produto["descricao"]); ?></p>
          <p class="price">R$ <?php echo number_format($produto["preco"], 2, ",", "."); ?></p>
          <p>Vendas: <b><?php echo ($produto["vendas"]); ?></b></p>
            <a href="pagar.php?id=<?php echo $produto["id"]; ?>">
              <button>Comprar</button>
            </a>
        </div>
      <?php } ?>
    <?php } else { ?>
      <p class="vazio">Nenhum produto cadastrado.</p>
    <?php } ?>
  </div>

    <?php
      include "footer.php";
    ?>

</body>

</html>