<?php
session_start();

if (!isset($_SESSION["id"]) || $_SESSION["tipo"] != "administrador") {
  header("Location: login.php");
  exit;
}

include "conecta.php";

$editando = false;
$produto = [
  "id" => "",
  "nome" => "",
  "descricao" => "",
  "preco" => "",
  "imagem" => ""
];

if (!empty($_GET["editar"])) {
  $id = (int) $_GET["editar"];
  $resultadoEditar = mysqli_query($conexao, "SELECT * FROM produtos WHERE id = $id");

  if ($dados = mysqli_fetch_assoc($resultadoEditar)) {
    $produto = $dados;
    $editando = true;
  }
}

$resultado = mysqli_query($conexao, "SELECT * FROM produtos ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administração</title>
  <link rel="stylesheet" href="navbar.css">

  <style>
    * {
      box-sizing: border-box;
      font-family: Arial, Helvetica, sans-serif;
    }

    body {
      margin: 0;
      background: #2c313c;
      color: #fff;
    }

    .conteudo {
      max-width: 1100px;
      margin: auto;
      padding: 20px;
    }

    h1 {
      text-align: center;
    }

    .painel {
      background: #fff;
      color: #222;
      padding: 20px;
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
    }

    input,
    textarea {
      width: 100%;
      padding: 10px;
      margin: 5px 0 15px;
    }

    textarea {
      resize: vertical;
      min-height: 80px;
    }

    .botao {
      background: #6f00ff;
      color: white;
      border: 0;
      padding: 10px 15px;
      text-decoration: none;
      cursor: pointer;
    }

    .cancelar {
      background: #666;
    }

    .excluir {
      background: #d22;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      color: #222;
    }

    th,
    td {
      padding: 10px;
      border-bottom: 1px solid #ddd;
    }

    th {
      background: #6f00ff;
      color: white;
    }

    .foto {
      width: 70px;
      height: 55px;
      object-fit: cover;
    }

    footer {
      text-align: center;
      padding: 20px;
      background: #111;
      color: #fff;
    }
  </style>
</head>

<body>

  <?php
  $paginaAtual = "admin";
  include "navbar.php";
  ?>

  <div class="conteudo">

    <h1>Área Administrativa</h1>

    <div class="painel">

      <h2><?= $editando ? "Alterar Produto" : "Cadastrar Produto" ?></h2>

      <form action="produto_salvar.php" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?= $produto["id"] ?>">

        <label>Nome</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($produto["nome"]) ?>" required>

        <label>Descrição</label>
        <textarea name="descricao" required><?= htmlspecialchars($produto["descricao"]) ?></textarea>

        <label>Preço</label>
        <input type="number" name="preco" step="0.01" min="0" value="<?= htmlspecialchars($produto["preco"]) ?>"
          required>

        <label>Imagem</label>

        <?php if ($editando && $produto["imagem"] != "") { ?>
          <img src="<?= htmlspecialchars($produto["imagem"]) ?>" class="foto"><br><br>
        <?php } ?>

        <input type="file" name="imagem" accept="image/*">

        <input class="botao" type="submit" value="<?= $editando ? "Salvar alterações" : "Cadastrar produto" ?>">

        <?php if ($editando) { ?>
          <a class="botao cancelar" href="admin.php">Cancelar</a>
        <?php } ?>

      </form>

    </div>

    <div class="painel">
      <h2>Produtos Cadastrados</h2>
      <table>
        <tr>
          <th>Imagem</th>
          <th>Nome</th>
          <th>Descrição</th>
          <th>Preço</th>
          <th>Ações</th>
        </tr>

        <?php while ($item = mysqli_fetch_assoc($resultado)) { ?>

          <tr>

            <td>
              <img class="foto" src="<?= htmlspecialchars($item["imagem"]) ?>" alt="">
            </td>

            <td><?= htmlspecialchars($item["nome"]) ?></td>

            <td><?= htmlspecialchars($item["descricao"]) ?></td>

            <td>R$ <?= number_format($item["preco"], 2, ",", ".") ?></td>

            <td>
              <a class="" href="admin.php?editar=<?= $item["id"] ?>">Alterar</a>
                
              <a class="" href="produto_excluir.php?id=<?= $item["id"] ?>"
                onclick="return confirm('Deseja excluir este produto?')">
                Excluir
              </a>
          
            </td>
    
          </tr>

        <?php } ?>

      </table>

    </div>

  </div>

  <?php
  include "footer.php";
  ?>

</body>

</html>