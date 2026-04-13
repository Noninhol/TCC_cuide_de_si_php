<?php
session_start();

$conectar = mysqli_connect("localhost", "root", "", "loginv01");

if (mysqli_connect_errno()) {
    die("Falha na conexão: " . mysqli_connect_error());
}

if (!isset($_SESSION['cpf'])) {
    die("Usuário não logado.");
}

$cpfCliente = $_SESSION['cpf'];

/*quando o usuário clica para finalizar um item do carrinho*/
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['finalizar'])) {
    $idcar = $_POST['finalizar'];

    /*busca o idV do vendedor do cliente*/
    $sqlVendedor = "SELECT idV FROM cliente WHERE cpf = ?";
    $stmt = mysqli_prepare($conectar, $sqlVendedor);
    mysqli_stmt_bind_param($stmt, "s", $cpfCliente);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $idV);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if (!$idV) {
        die("Vendedor não encontrado para este cliente.");
    }

    /*verifica disponibilidade do produto antes de finalizar*/
    $sqlDisp = "SELECT produto.disponibilidade 
                FROM carrinho 
                JOIN produto ON carrinho.Codei = produto.Codei 
                WHERE carrinho.idcar = ?";
    $stmt = mysqli_prepare($conectar, $sqlDisp);
    mysqli_stmt_bind_param($stmt, "i", $idcar);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $disponibilidade);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    if (!$disponibilidade) {
        echo "<p style='color: red;'>Produto indisponível, não pode finalizar.</p>";
        exit;
    }

    /*Insere o pedido*/
    $sqlPedido = "INSERT INTO pedido (idcar, idV, dataPedido) VALUES (?, ?, NOW())";
    $stmt = mysqli_prepare($conectar, $sqlPedido);
    mysqli_stmt_bind_param($stmt, "ii", $idcar, $idV);
    if (mysqli_stmt_execute($stmt)) {
        /* Atualiza carrinho para finalizar o pedido*/
        $sqlUpdate = "UPDATE carrinho SET finalizar = NOW() WHERE idcar = ?";
        $stmt2 = mysqli_prepare($conectar, $sqlUpdate);
        mysqli_stmt_bind_param($stmt2, "i", $idcar);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);

        echo "<center><p style='color: green;'><strong>Pedido finalizado com sucesso!</strong></p></center>";
    } else {
        echo "<p style='color: red;'>Erro ao criar pedido: " . mysqli_error($conectar) . "</p>";
    }
    mysqli_stmt_close($stmt);
}

/* Mostrar mensagem de pedido finalizado pelo revendedor */
$sql = "SELECT pedido.idpedido, produto.nomep, pedido.status, pedido.notificado
        FROM pedido 
        JOIN carrinho ON pedido.idcar = carrinho.idcar 
        JOIN produto ON carrinho.Codei = produto.Codei 
        WHERE carrinho.cpf = ?";

$stmt = mysqli_prepare($conectar, $sql);
mysqli_stmt_bind_param($stmt, "s", $cpfCliente);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

/* Lista os produtos do carrinho */
$sqlLista = "SELECT carrinho.*, produto.nomep, produto.valor, produto.img, produto.disponibilidade
             FROM carrinho
             JOIN produto ON carrinho.Codei = produto.Codei
             WHERE carrinho.finalizar IS NULL
               AND carrinho.cpf = ?";

$stmt = mysqli_prepare($conectar, $sqlLista);
mysqli_stmt_bind_param($stmt, "s", $cpfCliente);
mysqli_stmt_execute($stmt);
$resultadoCarrinho = mysqli_stmt_get_result($stmt);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrinho</title>
  <link rel="stylesheet" href="principal.css?v=<?php echo time();?>"> 
  <link rel="stylesheet" href="quinternario.css?v=<?php echo time();?>">
  <link rel="stylesheet" href="terciario.css?v=<?php echo time();?>">
</head>
<body>
<div id="aim">
  <center>
    <br>
    <a href="teste.php"><h1>Cuide de Sí</h1></a>
    <h2>Cuide de Si — Sua beleza, seu negócio, seu momento.</h2>
    <strong><a href="pag5_inic_cli.php">← Voltar</a></strong>
    <h2>Veja seus produtos <br> Aqui no seu carrinho</h2>
  </center>
</div>

<div id="imii">
  <div class="listap">
    <?php while ($produtos = mysqli_fetch_assoc($resultadoCarrinho)) { ?>
      <div class="itens">
        <img src="<?= htmlspecialchars($produtos['img']); ?>" alt="Imagem">
        <ul>
          <li><strong>N de consumo:</strong> <?= htmlspecialchars($produtos['idcar']); ?></li>
          <li><strong>ID produto:</strong> <?= htmlspecialchars($produtos['Codei']); ?></li>
          <li><strong>Disponibilidade:</strong> <?= $produtos['disponibilidade'] ? 'Disponível' : 'INDISPONÍVEL'; ?></li>
          <li><strong>Nome:</strong> <?= htmlspecialchars($produtos['nomep']); ?></li>
          <li><strong>Preço:</strong> R$ <?= number_format($produtos['valor'], 2, ',', '.'); ?></li>
        </ul>
        <?php if ($produtos['disponibilidade']) { ?>
          <form method="POST" action="">
            <input type="hidden" name="finalizar" value="<?= $produtos['idcar']; ?>">
            <button type="submit" name="carrinho" class="cs-btn botao">
              <span>Finalizar</span>
            </button>
          </form>
        <?php } else { ?>
          <p style="color: red;">Indisponível</p>
        <?php } ?>
      </div>
    <?php } ?>
  </div>
<?php
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['status'] == 1 && $row['notificado'] == 0) {
        echo "  <div='aim'> 
        <div id='mensagem'>

        <div class='mensagem'>     
        <h2>SOBRE SEU PEDIDO</h2>
                <br>
                <p style='color: green;'>Seu pedido <strong>" . 
                htmlspecialchars($row['nomep']) . 
                "<br></strong> foi finalizado pelo revendedor.</p>
                </div>
               
              <script>
                setTimeout(() => {
                  document.getElementById('mensagem').style.display = 'none';
                }, 15000);
              </script> 
              </div></div>";

        /*marcar a nnotificado*/
        $sqlUpdate = "UPDATE pedido SET notificado = 1 WHERE idpedido = ?";
        $stmt2 = mysqli_prepare($conectar, $sqlUpdate);
        mysqli_stmt_bind_param($stmt2, "i", $row['idpedido']);
        mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);
    }
}
?>

</div>

</body>
</html>
