<?php
session_start();

if (!isset($_SESSION["id"]) || $_SESSION["tipo"] != "administrador") {
  header("Location: login.php");
  exit;
}

include "conecta.php";

$editando = false;
$produto = array("id" => "", "nome" => "", "descricao" => "", "preco" => "", "imagem" => "");

if (!empty($_GET["editar"])) {
  $id = (int) $_GET["editar"];
  $sqlEditar = "SELECT * FROM produtos WHERE id = $id";
  $resultadoEditar = mysqli_query($conexao, $sqlEditar);

  if (mysqli_num_rows($resultadoEditar) > 0) {
    $produto = mysqli_fetch_assoc($resultadoEditar);
    $editando = true;
  }
}

$sql = "SELECT * FROM produtos ORDER BY id DESC";
$resultado = mysqli_query($conexao, $sql);
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
      background-color: #2c313c;
      color: white;
    }

    .conteudo {
      max-width: 1100px;
      margin: 0 auto;
      padding: 25px 15px;
    }

    h1 {
      text-align: center;
    }

    .painel {
      background-color: whitesmoke;
      color: #222;
      padding: 20px;
      margin-bottom: 25px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    label {
      font-weight: bold;
    }

    input,
    textarea {
      width: 100%;
      padding: 10px;
      margin: 6px 0 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 15px;
    }

    textarea {
      min-height: 80px;
      resize: vertical;
    }

    .botao {
      background-color: #6f00ff;
      color: white;
      border: none;
      cursor: pointer;
      border-radius: 6px;
      padding: 12px 16px;
      text-decoration: none;
      display: inline-block;
      font-size: 15px;
    }

    .cancelar {
      background-color: #555;
    }

    .excluir {
      background-color: #d22;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: white;
      color: #222;
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

    .acoes {
      white-space: nowrap;
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

      td {
        border-bottom: none;
      }

      tr {
        margin-bottom: 15px;
        border-bottom: 2px solid #ddd;
      }
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
      <h2><?php echo $editando ? "Alterar Produto" : "Cadastrar Produto"; ?></h2>
      <form action="produto_salvar.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($produto["id"]); ?>">

        <label for="nome">Nome</label>
        <input type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($produto["nome"]); ?>" required>

        <label for="descricao">Descrição</label>
        <textarea name="descricao" id="descricao" required><?php echo htmlspecialchars($produto["descricao"]); ?></textarea>

        <label for="preco">Preço</label>
        <input type="number" name="preco" id="preco" step="0.01" min="0" value="<?php echo htmlspecialchars($produto["preco"]); ?>" required>

        <label for="imagem">Imagem</label>
        <input type="text" name="imagem" id="imagem" value="<?php echo htmlspecialchars($produto["imagem"]); ?>" required>

        <input class="botao" type="submit" value="<?php echo $editando ? "Salvar alterações" : "Cadastrar produto"; ?>">
        <?php if ($editando) { ?>
          <a class="botao cancelar" href="admin.php">Cancelar</a>
        <?php } ?>
      </form>
    </div>

    <div class="painel">
      <h2>Produtos Cadastrados</h2>
      <table>
        <thead>
          <tr>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php if (mysqli_num_rows($resultado) > 0) { ?>
            <?php while ($item = mysqli_fetch_assoc($resultado)) { ?>
              <tr>
                <td><img class="foto" src="<?php echo htmlspecialchars($item["imagem"]); ?>" alt="<?php echo htmlspecialchars($item["nome"]); ?>"></td>
                <td><?php echo htmlspecialchars($item["nome"]); ?></td>
                <td><?php echo htmlspecialchars($item["descricao"]); ?></td>
                <td>R$ <?php echo number_format($item["preco"], 2, ",", "."); ?></td>
                <td class="acoes">
                  <a class="botao" href="admin.php?editar=<?php echo $item["id"]; ?>">Alterar</a>
                  <a class="botao excluir" href="produto_excluir.php?id=<?php echo $item["id"]; ?>" onclick="return confirm('Deseja excluir este produto?')">Excluir</a>
                </td>
              </tr>
            <?php } ?>
          <?php } else { ?>
            <tr>
              <td colspan="5">Nenhum produto cadastrado.</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <footer>
    Roxinho Store - <?php echo date("Y"); ?>
  </footer>
</body>

</html>
