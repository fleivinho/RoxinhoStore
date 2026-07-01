<?php
if (!isset($paginaAtual)) {
  $paginaAtual = "";
}

$ehAdmin = isset($_SESSION["tipo"]) && $_SESSION["tipo"] == "administrador";
$usuarioNome = isset($_SESSION["nome"]) ? $_SESSION["nome"] : "";

if (!function_exists("navbarAtivo")) {
  function navbarAtivo($paginaAtual, $pagina)
  {
    return $paginaAtual == $pagina ? " active" : "";
  }
}
?>
<div class="navbar">
  <a class="marca" href="site.php">Roxinho Store</a>
  <div class="navitems">
    <a class="navlink<?php echo navbarAtivo($paginaAtual, "site"); ?>" href="site.php">Loja</a>
    <?php if ($ehAdmin) { ?>
      <a class="navlink<?php echo navbarAtivo($paginaAtual, "admin"); ?>" href="admin.php">Admin</a>
    <?php } ?>
    <a class="navlink<?php echo navbarAtivo($paginaAtual, "compra"); ?>" href="compra.php">Compras</a>
    <a class="navlink" href="logout.php"><?php echo htmlspecialchars($usuarioNome); ?> | Sair</a>
  </div>
</div>
