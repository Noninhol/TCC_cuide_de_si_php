<?php
session_start();

if (!isset($_SESSION['idV'])) {
    echo "Você precisa estar logado para acessar esta página.";
    exit();
}

$idV = $_SESSION['idV'];

$conectar = mysqli_connect("localhost", "root", "", "loginv01");

if (!$conectar) {
    die("Erro na conexão: " . mysqli_connect_error());
}

if (isset($_POST['deletar'])) {
    $idpedido = $_POST['deletar'];
    $sqlLista = "DELETE FROM pedido WHERE idpedido = ?";
    $stmt = mysqli_prepare($conectar, $sqlLista);
    mysqli_stmt_bind_param($stmt, "i", $idpedido);
    if (mysqli_stmt_execute($stmt)) {
        echo "<center><p style='color: green;'><strong>Pedido deletado!</strong></p></center>";
    } else {
        echo "<center><p style='color: red;'>Erro ao deletar!</p></center>";
    }
    mysqli_stmt_close($stmt);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['status'])) {
    foreach ($_POST['status'] as $idpedido => $valor) {
        $novoStatus = $valor == '1' ? 1 : 0;
        $sqlUpdate = "UPDATE pedido SET status = ? WHERE idpedido = ?";
        $stmt = mysqli_prepare($conectar, $sqlUpdate);
        mysqli_stmt_bind_param($stmt, "ii", $novoStatus, $idpedido);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    echo "<center><p style='color: green;'><strong>Status atualizado!<strong></p></center>";
}

// Consulta para exibir os pedidos do revendedor logado
$sqlLista = "SELECT 
            p.idpedido,
            p.dataPedido,
            COALESCE(cl.nome, 'Cliente não identificado') AS nome_cliente,
            pr.nomep AS produto,
            pr.valor,
            p.status
        FROM pedido p
        LEFT JOIN carrinho c ON p.idcar = c.idcar
        LEFT JOIN cliente cl ON c.cpf = cl.cpf
        LEFT JOIN produto pr ON c.Codei = pr.Codei
        WHERE p.idV = ?";

$stmt = mysqli_prepare($conectar, $sqlLista);
mysqli_stmt_bind_param($stmt, "i", $idV);
mysqli_stmt_execute($stmt);
$resultadoPedido = mysqli_stmt_get_result($stmt);

if (!$resultadoPedido) {
    die("Erro na consulta: " . mysqli_error($conectar));
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="principal.css?v=<?php echo time();?>"> 
<link rel="stylesheet" href="quinternario.css?v=<?php echo time();?>">
<link rel="stylesheet" href="terciario.css?v=<?php echo time();?>">
</head>
<body>
<style>
    table {
    border-collapse: collapse;
    width: 80%;
    margin: auto;
}
th, td {
   background:rgba(255, 139, 166, 0.36);
    padding: 8px;
    text-align: center;
}
th {
 background-color:rgba(249, 244, 197, 0.99);
}
</style>
<div id="imii">
    <center>
        <br>
        <a href="teste.php"><h1>Cuide de Sí</h1></a>
        <h2>Cuide de Si — Sua beleza, seu negócio, seu momento.</h2>
        <strong><a href="pag5_inic_rev.php">← Voltar</a></strong>
        <h2>Veja seus pedido </h2>
    </center>
<center>
<br>
<br>
    <form method="POST">
    <table>
        <tr>
            <th><strong>ID Pedido</strong></th>
            <th><strong>Data</stong></th>
            <th><strong>Cliente</strong></th>
            <th><strong>Produto</strong></th>
            <th><strong>Valor</strong></th>
            <th><strong>Status</strong></th>
        </tr>
        <?php while ($pedido = mysqli_fetch_assoc($resultadoPedido)) { ?>
            <tr>
                <td><h4><?= htmlspecialchars($pedido['idpedido']) ?></h4></td>
                <td><h4><?= htmlspecialchars($pedido['dataPedido']) ?></h4></td>
                <td><h4><?= htmlspecialchars($pedido['nome_cliente']) ?></h4></td>
                <td><h4><?= htmlspecialchars($pedido['produto']) ?></h4></td>
                <td><h4>R$ <?= number_format($pedido['valor'], 2, ',', '.') ?></h4></td>
                <td>
                    <input type="checkbox" name="status[<?= $pedido['idpedido'] ?>]" value="1" <?= $pedido['status'] == 1 ? 'checked' : '' ?>>
                </td>
                <td>  <button type="submit" class="cs-btn botao" name="deletar" value="<?= $pedido['idpedido'] ?>"><span>Deletar</span></button>
                    </td>
                </tr>
            <?php } ?>
        </table>
        <br>
        <button class="cs-btn botao" type="submit" name="atualizar"><span>Atualizar Status</span></button>
    </form>
    </div>
</body>
</html>

