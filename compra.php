<?php
session_start();

if (!isset($_SESSION["id"])) {
  header("Location: login.php");
  exit;
}

include "conecta.php";

if ($_SESSION["tipo"] == "administrador") {
  $sql = "SELECT compras.*, usuarios.nome AS usuario_nome, produtos.nome AS produto_nome, produtos.imagem
          FROM compras
          INNER JOIN usuarios ON compras.usuario_id = usuarios.id
          INNER JOIN produtos ON compras.produto_id = produtos.id
          ORDER BY compras.id DESC";
} else {
  $usuario_id = (int) $_SESSION["id"];
  $sql = "SELECT compras.*, usuarios.nome AS usuario_nome, produtos.nome AS produto_nome, produtos.imagem
          FROM compras
          INNER JOIN usuarios ON compras.usuario_id = usuarios.id
          INNER JOIN produtos ON compras.produto_id = produtos.id
          WHERE compras.usuario_id = $usuario_id
          ORDER BY compras.id DESC";
}

$resultado = mysqli_query($conexao, $sql);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Compras</title>
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

    .conteudo {
      max-width: 1000px;
      margin: 0 auto;
      padding: 25px 15px;
    }

    h1 {
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      color: #222;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    th,
    td {
      padding: 10px;
      border-bottom: 1px solid #ddd;
      text-align: left;
      vertical-align: middle;
    }

    th {
      background-color: #6f00ff;
      color: white;
    }

    .foto {
      width: 70px;
      height: 55px;
      object-fit: cover;
      background-color: #ddd;
    }

    footer {
      background-color: #111;
      color: white;
      text-align: center;
      padding: 18px;
      margin-top: 20px;
    }

    @media screen and (max-width: 700px) {
      table,
      thead,
      tbody,
      th,
      td,
      tr {
        display: block;
      }

      thead {
        display: none;
      }

      tr {
        margin-bottom: 15px;
        border-bottom: 2px solid #ddd;
      }

      td {
        border-bottom: none;
      }
    }
  </style>
</head>

<body>
  <?php
  $paginaAtual = "compra";
  include "navbar.php";
  ?>

  <div class="conteudo">
    <h1><?php echo $_SESSION["tipo"] == "administrador" ? "Compras Realizadas" : "Minhas Compras"; ?></h1>
    <table>
      <thead>
        <tr>
          <th>Imagem</th>
          <th>Produto</th>
          <th>Cliente</th>
          <th>Preço</th>
          <th>Data</th>
        </tr>
      </thead>
      <tbody>
        <?php if (mysqli_num_rows($resultado) > 0) { ?>
          <?php while ($compra = mysqli_fetch_assoc($resultado)) { ?>
            <tr>
              <td><img class="foto" src="<?php echo htmlspecialchars($compra["imagem"]); ?>" alt="<?php echo htmlspecialchars($compra["produto_nome"]); ?>"></td>
              <td><?php echo htmlspecialchars($compra["produto_nome"]); ?></td>
              <td><?php echo htmlspecialchars($compra["usuario_nome"]); ?></td>
              <td>R$ <?php echo number_format($compra["preco"], 2, ",", "."); ?></td>
              <td><?php echo date("d/m/Y H:i", strtotime($compra["data_compra"])); ?></td>
            </tr>
          <?php } ?>
        <?php } else { ?>
          <tr>
            <td colspan="5">Nenhuma compra registrada.</td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>

 <?php
  include "footer.php";
?>
</body>

</html>
